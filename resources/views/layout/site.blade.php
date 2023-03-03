<!DOCTYPE html>
<html lang="en">

<head>
    <!--required meta tags-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--twitter og-->
    <meta name="twitter:site" content="@themetags" />
    <meta name="twitter:creator" content="@themetags" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Hostim - Hosting Service Provider HTML Template" />
    <meta name="twitter:description" content="Hosting Services HTML Template, software technology, agency & business Bootstrap 5 Html template. It is best and famous hosting services company website template." />
    <meta name="twitter:image" content="#" />

    <!--facebook og-->
    <meta property="og:url" content="#" />
    <meta name="twitter:title" content="cash deposit" />
    <meta property="og:description" content="Cash Deposit" />
    <meta property="og:image" content="#" />
    <meta property="og:image:secure_url" content="#" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="600" />

    <!--meta-->
    <meta name="description" content="Cash Deposit - Deposite Services HTML Template, software technology, agency & business Bootstrap 5 Html template. It is best and famous hosting services company website template." />
    <meta name="author" content="ThemeTags" />

    <!--favicon icon-->
    <link rel="icon" href="{{asset('assets/frontend/img/favicon.png')}}" type="image/png" sizes="16x16" />

    <!--title-->
    <title>Cash Deposit</title>

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;500;600;700&amp;family=Urbanist:wght@600;700&amp;display=swap" rel="stylesheet">

    <!--build:css-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/main.css')}}" />
    <!-- endbuild -->

    <!--custom css-->
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom.css')}}" />

    @yield('stylesheet')

</head>

<body>

<!--dark light switcher-->
<button class="dark-light-switcher" id="theme-switch">
    <span class="light-sun"><i class="fa-solid fa-sun"></i></span>
    <span class="dark-moon"><i class="fa-solid fa-moon"></i></span>
</button>

<!--body overlay -->
<div class="body-overlay"></div>
<!--scrolltop button -->
<button class="scrolltop-btn"><i class="fa-solid fa-angle-up"></i></button>

<!--preloader start-->
<div class="loader-wrap">
    <div class="preloader">
        <div id="handle-preloader" class="handle-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="H" class="letters-loading">C</span>
                    <span data-text-preloader="O" class="letters-loading">A</span>
                    <span data-text-preloader="S" class="letters-loading">S</span>
                    <span data-text-preloader="T" class="letters-loading">H</span>
                    <span data-text-preloader="I" class="letters-loading">D</span>
                    <span data-text-preloader="M" class="letters-loading">E</span>
                    <span data-text-preloader="M" class="letters-loading">P</span>
                    <span data-text-preloader="M" class="letters-loading">O</span>
                    <span data-text-preloader="M" class="letters-loading">S</span>
                    <span data-text-preloader="M" class="letters-loading">I</span>
                    <span data-text-preloader="M" class="letters-loading">T</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--preloader end-->
<!--main content wrapper start-->
<div class="main-wrapper">

    <!--header area start-->
    <header class="header-two position-relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-5">
                    <div class="logo-wrapper">
                        <a href="index.html"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo"></a>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6 d-none d-lg-block">
                    <div class="nav-wrapper">
                        <nav>
                            <ul>
                                <li class="has-submenu"><a href="#">Home</a>
                                </li>
                                <li><a href="affiliate.html">Affiliate</a></li>
                                <li><a href="">About</a></li>
                                <li><a href="terms.html">Terms & Conditions</a></li>
                                <li class="has-submenu has-megamenu-list"><a href="#">Pages</a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-7">
                    <div class="header-right-btn d-flex align-items-center justify-content-end">
                        <a href="{{route('login')}}" class="template-btn hm2-primary-btn rounded-pill btn-small d-none d-sm-block">Login</a>

                        <a href="#" class="mobile-menu-toggle d-lg-none text-white ms-3"><i class="fa-solid fa-bars-staggered"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header area end-->

    <!--mobile menu start-->
    <div class="mobile-menu position-fixed bg-white deep-shadow">
        <button class="close-menu position-absolute"><i class="fa-solid fa-xmark"></i></button>
        <a href="index.html" class="logo-wrapper"><img style="background-color: springgreen; padding: 5px;border-radius: 5px" src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo logo-black"></a>
        <a href="index.html" class="logo-wrapper"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo logo-white"></a>
        <nav class="mobile-menu-wrapper mt-40">
            <ul>
                <li class="has-submenu"><a href="{{route('home')}}">Home</a>
                </li>
                <li><a href="{{route('login')}}">Login</a></li>
                <li><a href="domain.html">Domain</a></li>
            </ul>
        </nav>

        <div class="contact-info mt-60">
            <h4 class="mb-20">Contact Info</h4>
            <p>Chicago 12, Melborne City, USA</p>
            <p>+88 01682648101</p>
            <p>info@example.com</p>
            <div class="contact-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </div>
    <!--mobile menu end-->


@yield('content')



    <!-- Footer Area -->
    <footer class="hm2-footer pt-250 mt--150" data-background="assets/img/shapes/map-bg.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Hostim Hosting</h5>
                        <ul class="footer-nav">
                            <li><a href="pricing.html">Pricing Plans</a></li>
                            <li><a href="features.html">Hostim Features</a></li>
                            <li><a href="#">Add-Ons</a></li>
                            <li><a href="#">Cloudflare Integration</a></li>
                            <li><a href="#">APM Tool</a></li>
                            <li><a href="#">Dev Hostim</a></li>
                            <li><a href="contact-2.html">Hostim Support</a></li>
                            <li><a href="#">Free Migration</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Company Links</h5>
                        <ul class="footer-nav">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Clients & Case Studies</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                            <li><a href="testimonials.html">Kinsta Reviews</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Why Us</a></li>
                            <li><a href="#">Affiliate Program</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Resources Links</h5>
                        <ul class="footer-nav">
                            <li><a href="#">All Resources</a></li>
                            <li><a href="blog-grids.html">Blog</a></li>
                            <li><a href="#">Knowledge Base</a></li>
                            <li><a href="contact.html">Help Center</a></li>
                            <li><a href="#">Feature Updates</a></li>
                            <li><a href="#">Agency Directory</a></li>
                            <li><a href="#">Affiliate Academy</a></li>
                            <li><a href="#">System Status</a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="footer-widget footer-nav-widget">
                        <h5 class="widget-title position-relative text-white mb-5">Products & Solution</h5>
                        <ul class="footer-nav">
                            <li><a href="wp-hosting.html">Managed WordPress Hosting</a></li>
                            <li><a href="shared-hosting.html">Shared Hosting</a></li>
                            <li><a href="vps-hosting.html">VPS Hosting</a></li>
                            <li><a href="index-3.html">Game Hosting</a></li>
                            <li><a href="#">WooCommerce Hosting</a></li>
                            <li><a href="#">Multisite Hosting</a></li>
                            <li><a href="#">Secure Hosting</a></li>
                            <li><a href="#">Hosting for Publishers</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="hm2-footer-copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-6 order-2 order-lg-1">
                        <div class="copyright-txt mt-3 mt-lg-0">
                            <p class="mb-0 text-white">&copy; 2023 All rights reserved Cash Deposit</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 order-1 order-lg-2">
                        <div class="footer-logo text-start text-lg-center">
                            <a href="index.html"><img src="{{asset('assets/frontend/img/logo-white.png')}}" alt="logo" class="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 order-3">
                        <div class="footer-social text-start text-lg-end mt-3 mt-lg-0">
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-dribbble"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->



</div>
<!-- main content wrapper ends -->


<!--build:js-->
<script src="{{asset('assets/frontend/js/vendors/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/popper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/easing.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/swiper.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/massonry.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/bootstrap-slider.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/magnific-popup.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/waypoints.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/counterup.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/isotop.pkgd.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/vendors/countdown.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/app.js')}}"></script>

@yield('script')
<!--endbuild-->
</body>

</html>
