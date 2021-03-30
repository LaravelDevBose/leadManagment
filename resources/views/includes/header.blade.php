<header id="header" >
    <div class="container-fluid d-flex align-items-center header-pa">

        <a href="{{ route('homepage') }}" class="logo mr-auto"><img src="{{ asset('public/assets/img/logo.png') }}" alt="" class="img-fluid"></a>
        <!-- Uncomment below if you prefer to use text as a logo -->
        <!-- <h1 class="logo mr-auto"><a href="index.html">Butterfly</a></h1> -->
        <div class="nav1">
            <nav class="nav-menu d-none d-lg-block d-md-block">
                <ul>
                    <li class="active"><a href="{{ route('homepage') }}">Home</a></li>
                    <li><a href="{{ route('homepage') }}#about">About</a></li>
                    <li><a href="{{ route('homepage') }}#services">Services</a></li>
                    <li><a href="{{ route('homepage') }}#testimonials">Testimonials</a></li>
                    <li><a href="{{ route('homepage') }}#contact">Contact</a></li>

                    <li class="call_btn"><a href="">Call Now</a></li>

                </ul>
            </nav><!-- .nav-menu -->

        </div>

    </div>
</header>
