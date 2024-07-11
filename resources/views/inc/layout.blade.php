<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edufie - Online Courses Html Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('client/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">


    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>
<body class='sc5'>
    <!-- preloader area start -->

    <!-- preloader area end -->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- search popup area start -->
    <div class="search-popup" id="search-popup">
        <form action="home.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- //. search Popup -->

    @include('inc.header')

    @yield('content')
    <!-- about Area End -->
    @include('inc.footer')
    <!-- footer area start -->

    <!-- footer area end -->

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>



<!-- all plugins here -->
<script src="{{ asset('client/js/jquery.3.6.min.js') }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/js/imageloded.min.js') }}"></script>
<script src="{{ asset('client/js/counterup.js') }}"></script>
<script src="{{ asset('client/js/waypoint.js') }}"></script>
<script src="{{ asset('client/js/magnific.min.js') }}"></script>
<script src="{{ asset('client/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('client/js/nice-select.min.js') }}"></script>
<script src="{{ asset('client/js/fontawesome.min.js') }}"></script>
<script src="{{ asset('client/js/ripple.js') }}"></script>
<script src="{{ asset('client/js/owl.min.js') }}"></script>
<script src="{{ asset('client/js/slick-slider.min.js') }}"></script>
<script src="{{ asset('client/js/wow.min.js') }}"></script>
<!-- main js  -->
<script src="{{ asset('client/js/main.js') }}"></script>
<script>
    $(document).ready(function(){
    $('.course-slider').owlCarousel({
        loop:false,
        autoplay:true,
        autoplayTimeout:1000,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
});

</script>
</body>
</html>
