<footer class="footer-area fruits-footer">
    <div class="food-footer-bottom pt-80 pb-70 black-bg-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="footer-widget">
                        <div class="food-about">
                            <p>Online Shop</p>
                            <div class="food-about-info">
                                <div class="food-info-wrapper">
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="pe-7s-map-marker"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>WY2646 Accra Kumasi Road, Pokuasi</p>
                                        </div>
                                    </div>
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="pe-7s-call"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>+233 302 978 999</p>
                                        </div>
                                    </div>
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="pe-7s-chat"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>
                                                <a href="mail:transmissionc@yahoo.com">transmissionc@yahoo.com</a> <br>
                                                <a href="mail:transmissionc@yahoo.com">transmissionc@yahoo.com</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2">
                    <div class="footer-widget mt-50">
                        <h3 class="footer-widget-title-6">Options</h3>
                        <div class="food-widget-content">
                            <ul>
                                <li><a href="{{ route('cart.index') }}"><img
                                            src="{{ asset('frontend/img/icon-img/41.png') }}" alt="hhhhhh"> Cart</a></li>
                                <li>
                                    <a href="{{ route('user.dashboard') }}"><img src="{{ asset('frontend/img/icon-img/41.png') }}" alt="">
                                        My Account</a>
                                </li>
                                @guest
                                    @if (route('register'))
                                        <li>
                                            <a href="{{ route('register') }}">
                                                <img src="{{ asset('frontend/img/icon-img/41.png') }}" alt="">
                                                Register
                                            </a>
                                        </li>
                                    @endif
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="footer-widget mt-50">
                        <h3 class="footer-widget-title-6">Information</h3>
                        <div class="food-widget-content">
                            <ul>
                                <li>
                                    <a href="{{ route('contact.index') }}">
                                        <img src="{{ asset('frontend/img/icon-img/41.png') }}" alt="">
                                        About
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contact.index') }}">
                                        <img src="{{ asset('frontend/img/icon-img/41.png') }}" alt="">
                                        Contact
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('page.show', 'privacy-policy') }}">
                                        <img src="{{ asset('frontend/img/icon-img/41.png') }}" alt="">
                                        Privacy Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-middle black-bg-2 pt-35 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="footer-services-wrapper mb-30">
                        <div class="footer-services-icon">
                            <i class="pe-7s-car"></i>
                        </div>
                        <div class="footer-services-content">
                            <h3>Nationwide Delivery</h3>
                            <p>Delivery in at your doorstep</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="footer-services-wrapper mb-30">
                        <div class="footer-services-icon">
                            <i class="pe-7s-shield"></i>
                        </div>
                        <div class="footer-services-content">
                            <h3>Money Guarantee</h3>
                            <p>Money return</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="footer-services-wrapper mb-30">
                        <div class="footer-services-icon">
                            <i class="pe-7s-headphones"></i>
                        </div>
                        <div class="footer-services-content">
                            <h3>Online Support</h3>
                            <p>We are at your service</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <img src="{{ asset('frontend/img/icon-img/new3.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="food-copyright black-bg-6 ptb-30">
        <div class="container text-center">
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                Created by
                <a href="https://classichult.com" target="_blank" class="text-primary">classichult.com</a>
            </p>
        </div>
    </div>
</footer>


