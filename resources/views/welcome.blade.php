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

    <!-- =======================================================
    * Template Name: Butterfly - v2.2.0
    * Template URL: https://bootstrapmade.com/butterfly-free-bootstrap-theme/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
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
                        <p>On Call Title Services is not your average Title and Tag agency! We are an experienced Title and Tag provider specialized in all motor vehicle needs for businesses and drivers. Our title clerks provide the highest quality customer service experience by providing an efficient experience that will save you time and the hassle with your motor vehicle needs on-site and in all 50 states.</p>
                        <h3>There is no task too small or too large!</h3>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section><!-- End About Section -->



    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container">
            <div class="section-title">
                <h2>Services</h2>

            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/title.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Title and Registration</a></h4>
                                    <p class="description">We shorten the client's process in obtaining titles and registrations in the USA. </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/home.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Lien Corrections</a></h4>
                                    <p class="description">Incorrect lien noted? <br>Show us the title and we can get it corrected. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/online-voting.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Notary Services</a></h4>
                                    <p class="description">We specialize in on-demand notary on all legal documents. (On site) </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay="0.1s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/domain-registration.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Registration Renewal</a></h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/checkmark.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Title Corrections</a></h4>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/correction-pen.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Printing Services</a></h4>
                                    <p class="description">On Site </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/duplicate.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Duplicate Registration</a></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/duplicate.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Duplicate Title</a></h4>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="icon">
                                    <img src="{{ asset('assets/img/card.png') }}">
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="text_box">
                                    <h4 class="title"><a href="">Passport Photos</a></h4>
                                    <p class="description">On Site </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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

                        <div class="testimonial-item">
                            <img src="{{ asset('assets/img/left-quotes-sign.png') }}" class="testimonial-img" alt="">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                This company provides great service, thet are efficient, very helpful and their prices are very competitive. We highly recommend them.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <h3>Sanchez Motors LLC</h3>
                        </div>

                        <div class="testimonial-item">
                            <img src="{{ asset('assets/img/left-quotes-sign.png') }}" class="testimonial-img" alt="">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Leesha and her team are excellent! They are very professional and their turn-around time for services is incredible, especially with COVID19 happening. I can't thank her and her team enough. Our dealership will continue to use her services
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <h3>Karen Germanov</h3>
                        </div>

                        <div class="testimonial-item">
                            <img src="{{ asset('assets/img/left-quotes-sign.png') }}" class="testimonial-img" alt="">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                This company provides great service, thet are efficient, very helpful and their prices are very competitive. We highly recommend them.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <h3>Paul Winkowski</h3>
                        </div>

                        <div class="testimonial-item">
                            <img src="{{ asset('assets/img/left-quotes-sign.png') }}" class="testimonial-img" alt="">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>It was a great business experience. I was out of town & on call was able to be very prompt on helping me with getting my duplicate title. Great communication I would recommend on call to anyone!!! thanks to be my agent leesha from on call
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <h3>Shaunda, Jordan</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->


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
                        <p>401-B East 2nd Ave Roselle NJ 07203</p>
                    </div>
                </div>
                <div class="col-md-3 border_1">
                    <div class="address ">
                        <i class="fas fa-envelope"></i>
                        <p class="email_p">info@oncalltitleservices.com</p>
                    </div>
                </div>
                <div class="col-md-3 border_1">
                    <div class="address ">
                        <i class="fas fa-phone-alt"></i>
                        <p>908.271.6668 <br>
                            Fax #: 908.259.5299
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="address">
                        <i class="fas fa-clock"></i>
                        <p>
                            <strong>Tuesday - Friday </strong> <br>10 AM - 5 PM EST
                        </p>
                    </div>
                </div>
            </div>

            <div class="row form_section">
                <div class="col-md-12 mt-5 mt-lg-0">
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="First Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Last Name" data-rule="email" data-msg="Please enter a valid email" />
                                <div class="validate"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 form-group">
                                <input type="email" name="name" class="form-control" id="name" placeholder="Email" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Phone" data-rule="email" data-msg="Please enter a valid email" />
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
