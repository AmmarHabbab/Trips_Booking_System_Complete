<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>BOOKING TRAVEL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <form action="/change-language" method="get">
                            <select class="form-control changeLang" name="lang">
                                <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>العربية
                                </option>
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English
                                </option>
                            </select>
                        </form>
                        @if (Auth::check())
                            <form action="/logout" method="POST">
                                @csrf
                                <p><input type="submit" style="border: none;background:none;color:rgb(3, 177, 3);"
                                        value="{{__('messages.Logout')}}"></p>
                            </form>
                            <p class="px-3">|</p>
                            <p><a href="/dashboard">{{ __('messages.Dashboard') }}</a></p>
                        @else
                            <p><a href="/login">{{ __('messages.Login') }}</a></p>
                            <p class="px-3">|</p>
                            <p><a href="/register">{{ __('messages.Register') }}</a></p>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">Trips</span>ASPU</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0" style="font-size:13px;">

                        <a href="/trips" class="nav-item nav-link">{{ __('messages.Trips') }}</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active"
                                data-toggle="dropdown">{{ __('messages.Trips') }}</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                    <a href="/trips/show/يومية" class="dropdown-item">{{__('messages.Daily')}}</a>
                                    <a href="/trips/show/اسبوعية" class="dropdown-item">{{__('messages.Weekly')}}</a>
                                    <a href="/trips/show/شهرية" class="dropdown-item">{{__('messages.Monthly')}}</a>
                                    <a href="/trips/show/موسمية" class="dropdown-item">{{__('messages.Seasonal')}}</a>
                                    <a href="/trips/show/سنوية" class="dropdown-item">{{__('messages.Yearly')}}</a>
                                    <a href="/trips/showstatus/حجز_مغلق" class="dropdown-item">{{__('messages.Booking Closed')}}</a>
                                    <a href="/trips/showstatus/الأن" class="dropdown-item">{{__('messages.Now')}}</a>
                                    <a href="/trips/showstatus/منتهية" class="dropdown-item">{{__('messages.Over')}}</a>
                                    <a href="/trips/showstatus/ملغية" class="dropdown-item">{{__('messages.Canceled')}}</a>
                            </div>
                        </div>
                        <a href="/posts" class="nav-item nav-link">{{ __('messages.All Posts') }}</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active"
                                data-toggle="dropdown">{{ __('messages.Categories') }}</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                
                                @foreach ($categories as $category)
                                    <a href="/categories/{{ $category->translate('en')->name }}"
                                        class="dropdown-item">{{ $category->translate()->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <a href="/album" class="nav-item nav-link"">{{ __('messages.Albums') }}</a>
                        <a href="/translater" class="nav-item nav-link"">{{ __('messages.Our Translaters') }}</a>
                        <a href="/rates" class="nav-item nav-link"">{{ __('messages.Rates') }}</a>
                        <a href="/about" class="nav-item nav-link">{{ __('messages.About') }}</a>

                    
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle active"
                                data-toggle="dropdown">{{ __('messages.Help Us') }}</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="/survies/" class="dropdown-item ">{{ __('messages.Survies') }}</a>
                                <a href="/suggestions/create" class="dropdown-item">{{ __('messages.Suggest') }}</a>
                                <a href="/rates/create" class="dropdown-item">{{ __('messages.Rates') }}</a>
                            </div>

                        </div>
                    </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    @yield('content')


    {{-- <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">TRAVEL</span>ER</h1>
                </a>
                <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed
                    vero lorem dolor dolor</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i
                            class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i
                            class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i
                            class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i
                            class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;"
                            placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->
--}}


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>
 

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/lib/tempusdominus/js/moment.min.js"></script>
    <script src="/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/mail/jqBootstrapValidation.min.js"></script>
    <script src="/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.querySelector('.changeLang');
            selectElement.addEventListener('change', function() {
                this.parentNode.submit();
            });
        });
    </script>
</body>

</html>
