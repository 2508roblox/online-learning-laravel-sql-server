<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edufie - Online Courses Html Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="<?php echo e(asset('instructor/img/fevicon.png')); ?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/magnific.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/nice-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/owl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/slick-slide.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('instructor/css/responsive.css')); ?>">


    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>
<body class='sc51'>
    <!-- preloader area start -->

    <!-- preloader area end -->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- search popup area start -->

    <!-- //. search Popup -->

    <?php echo $__env->make('instructor.inc.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>
    <!-- about Area End -->
    <?php echo $__env->make('inc.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- footer area start -->

    <!-- footer area end -->

    <!-- back-to-top end -->
    <div class="back-to-top">
        <span class="back-top"><i class="fas fa-angle-double-up"></i></span>
    </div>



<!-- all plugins here -->
<script src="<?php echo e(asset('instructor/js/jquery.3.6.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/imageloded.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/counterup.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/waypoint.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/magnific.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/fontawesome.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/ripple.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/owl.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/slick-slider.min.js')); ?>"></script>
<script src="<?php echo e(asset('instructor/js/wow.min.js')); ?>"></script>
<!-- main js  -->
<script src="<?php echo e(asset('instructor/js/main.js')); ?>"></script>
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
<?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/inc/layout.blade.php ENDPATH**/ ?>