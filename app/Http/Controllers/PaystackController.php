<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderTransaction;
use App\Models\User;
use App\Notifications\Backend\User\OrderCreatedNotification;
use App\Notifications\Frontend\User\OrderThanksNotification;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;
use Unicodeveloper\Paystack\Paystack;
//use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;
use PDF;


class PaystackController extends Controller
{
    public function initialize(Request $request){

        DB::beginTransaction();
        try {
            $order = (new OrderService())->createOrder($request->except(['_token', 'submit']));

            $paystack = new Paystack();

            $paymentData = [
                'first_name' => $order->user->first_name,
                'label' => 'Order Payment',
                'amount' => $order->total * 100,
                'reference' => $order->ref_id,
                'email' => "kofibusy@gmail.com",
                'currency' => "GHS",
                'orderID' => $order->ref_id,
                'channels' => ['mobile_money', 'ussd', 'card'],
                'callback_url' => route('checkout.paystack.verify'),
            ];
            DB::commit();
            try{
                return $paystack->getAuthorizationUrl($paymentData)->redirectNow();
            }catch(\Exception $exception) {
                toast(
                    'Payment failed, contact support team',
                    "error"
                );
            }
        } catch (Exception $exception){
            DB::rollBack();
            toast(
                'Order placement failed, please try again later or contact support team',
                "error"
            );
        }
    }

    public function handleGatewayCallback(){
        $paystack = new Paystack();
        $verifiedPaymentResponse = $paystack->getPaymentData();
        $responseData = $verifiedPaymentResponse['data'];

        $order = Order::query()
            ->where('ref_id', $responseData['reference'])
            ->first();
        $amount = $responseData['amount']/100;
        // verify amount
        if ($order->currency != 'GHS' || $order->total != $amount || $order->order_status == Order::PAID){
            throw new \Exception("An error occurred, please contact customer support");
        }
        // update transaction
        $order->transactions()->create([
            'transaction_status' => OrderTransaction::PAID
        ]);

        if (session()->has('coupon')) {
            $coupon = Coupon::whereCode(session()->get('coupon')['code'])->first();
            $coupon->increment('used_times');
        }

        session()->forget([
            'coupon',
            'saved_user_address_id',
            'saved_shipping_company_id',
            'saved_payment_method_id',
            'shipping'
        ]);

        Cart::instance('default')->destroy();

        // Notification to admins.
        User::role(['admin', 'supervisor'])->each(function ($admin, $key) use ($order) {
            $admin->notify(new OrderCreatedNotification($order));
        });

        // Send email with PDF invoice
        $user = User::find($order->user_id);
        $data = $order->toArray();
        $data['currency_symbol'] = $order->currency == 'GHS' ? '₵' : $order->currency;
        $data['user'] = $user;
        $data['payment_channel'] = $responseData['authorization']['bank'];
        $data['products'] = $order->products;

        $pdf = PDF::loadView('layouts.invoice', $data);
        $saved_file = public_path('pdf/' . $data['ref_id'] . '.pdf');
        $pdf->save($saved_file);

        try {
            $user->notify(new OrderThanksNotification($order, $saved_file));
        } catch (Exception $exception){}

        toast('Your payment was successful with reference code: ' . $order->ref_id, 'success');
        return redirect()->route('home');

    }
}
