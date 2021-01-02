<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>OnCall Service</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/home.png" rel="icon">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">
    <style>
        .fal, .far, .fas {
            font-family: "Font Awesome 5 Pro"!important;
        }
    </style>
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" >
    <div class="container-fluid d-flex align-items-center">

        <a href="{{ route('homepage') }}" class="logo mr-auto"><img src="{{ asset('assets/img/logo.png') }}" alt="" class="img-fluid"></a>
        <!-- Uncomment below if you prefer to use text as a logo -->
        <!-- <h1 class="logo mr-auto"><a href="index.html">Butterfly</a></h1> -->
        <div class="nav1">
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a href="{{ route('homepage') }}">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#contact">Contact</a></li>

                    <li class="call_btn"><a href="">Call Now</a></li>

                </ul>
            </nav><!-- .nav-menu -->

        </div>

    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <!---
          <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
              <h1>Creating websites that make you stop & stare</h1>
              <h2>Accusantium quam, aliquam ultricies eget tempor id, aliquam eget nibh et. Maecen aliquam, risus at semper. Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum.</h2>
              <div><a href="#about" class="btn-get-started scrollto">Get Started</a></div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img">
              <img src="assets/img/hero-img.png" class="img-fluid" alt="">
            </div>
          </div>-->
    </div>

</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">

            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 icon-boxes d-flex flex-column  py-5 px-lg-5 ">
                    <div class="about-sec-1">

                        <h1>About Us</h1>
                        <hr>
                        <p>{{ !empty($aboutUs->data)? $aboutUs->data['details']: '' }}</p>
                        <h3>There is no task too small or too large!</h3>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section><!-- End About Section -->



    @if(!empty($services) && count($services) > 0)
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Services</h2>

            </div>
            <div class="row">
                @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon" style="font-size: 3em; color: #F89635;">
                                    <i class="{{ $service->service_icon }}"></i>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">{{ $service->service_title }}</a></h4>
                                    <p class="description">{{ $service->service_details }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="bt_1">
                        <a href="#">Request Form E-Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->
    @endif

    <section id="statement">
        <div class="content-box-lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tech-statement" class="text-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($testimonials) && count($testimonials) > 0)
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="head_testimonials">
                        <h1>Testimonials</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1"></div>

                <div class="col-md-10">

                    <div class="owl-carousel testimonials-carousel">

                        @foreach($testimonials as $testimonial)
                        <div class="testimonial-item">
                            <img src="{{ asset('assets/img/left-quotes-sign.png') }}" class="testimonial-img" alt="">
                            <p class="text-capitalize">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                {{ $testimonial->testimonial_details }}
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <h3 class="text-capitalize">{{ $testimonial->client_name }}</h3>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    @endif
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title contact_head">
                <h1>Contact Us</h1>
            </div>
            <div class="row contact_information">
                <div class="col-md-3 border_1">
                    <div class="address ">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['address'] : '' }}</p>
                    </div>
                </div>
                <div class="col-md-3 border_1">
                    <div class="address ">
                        <i class="fas fa-envelope"></i>
                        <p class="email_p">{{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['email'] : '' }}</p>
                    </div>
                </div>
                <div class="col-md-3 border_1">
                    <div class="address ">
                        <i class="fas fa-phone-alt"></i>
                        <p>{{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['phone_no'] : '' }} <br>
                            Fax #: {{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['fax_no'] : '' }}
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="address">
                        <i class="fas fa-clock"></i>
                        <p>
                            <strong>{{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['open_date'] : '' }}</strong>
                            <br>{{ (!empty($contactUs) && !empty($contactUs->data)) ? $contactUs->data['open_time'] : '' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row form_section">
                <div class="col-md-12 mt-5 mt-lg-0">
                    <form action="{{ route('contact_us.store') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="first_name" required class="form-control" id="name" placeholder="First Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"  />
                                <div class="validate"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="email" name="email" class="form-control" id="email" required placeholder="Email" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="number" class="form-control" name="phone_no" required id="phone_no" placeholder="Phone" data-rule="minlen:10"  data-msg="Please enter a valid phone no" />
                                <div class="validate"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Type your message here..."></textarea>
                            <div class="validate"></div>
                        </div>
                        <div class="mb-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->

    <div id="map_1">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  no-gutters">
                    <div>
                        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8560.700816386598!2d-74.26308800896143!3d40.65931883384367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3b28e715225f5%3A0x6c6db828e9c9b9e0!2s401%20E%202nd%20Ave%2C%20Roselle%2C%20NJ%2007203%2C%20USA!5e0!3m2!1sen!2sbd!4v1609373238341!5m2!1sen!2sbd" width="100%" height="400px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="container ">
        <div class="copyright">
            &copy; Copyright <strong><span>OnCall</span></strong>. All Rights Reserved
        </div>

    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
<script src="https://kit.fontawesome.com/c36b26934c.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('assets/vendor/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
