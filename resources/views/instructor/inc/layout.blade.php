<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edufie - Online Courses Html Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('instructor/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('instructor/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('instructor/css/responsive.css') }}">


    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>
<body class='sc51'>
    <!-- preloader area start -->

    <!-- preloader area end -->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- search popup area start -->

    <!-- //. search Popup -->

    @include('instructor.inc.header')

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
<script src="{{ asset('instructor/js/jquery.3.6.min.js') }}"></script>
<script src="{{ asset('instructor/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('instructor/js/imageloded.min.js') }}"></script>
<script src="{{ asset('instructor/js/counterup.js') }}"></script>
<script src="{{ asset('instructor/js/waypoint.js') }}"></script>
<script src="{{ asset('instructor/js/magnific.min.js') }}"></script>
<script src="{{ asset('instructor/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('instructor/js/nice-select.min.js') }}"></script>
<script src="{{ asset('instructor/js/fontawesome.min.js') }}"></script>
<script src="{{ asset('instructor/js/ripple.js') }}"></script>
<script src="{{ asset('instructor/js/owl.min.js') }}"></script>
<script src="{{ asset('instructor/js/slick-slider.min.js') }}"></script>
<script src="{{ asset('instructor/js/wow.min.js') }}"></script>
<!-- main js  -->
<script src="{{ asset('instructor/js/main.js') }}"></script>
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
