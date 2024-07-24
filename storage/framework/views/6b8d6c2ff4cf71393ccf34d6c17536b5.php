<?php
     $categories = Illuminate\Support\Facades\DB::select('EXEC GetCategoriesWithCourseCountByTopic');
?>
<header class="navbar-area">
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-target="#themefie_main_menu"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a class="main-logo" href="<?php echo e(route('home')); ?>"><img src="<?php echo e(asset('client/img/logo.png')); ?>" alt="img"></a>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <ul>
                    <li><a class="search header-search" href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="themefie_main_menu">
                <div class="single-input-wrap">
                        <form action="<?php echo e(route('courses.index')); ?>" method="GET" class="single-input-wrap">
                            <input type="text" name="search" placeholder="Search your best courses" value="<?php echo e($searchParam ?? ''); ?>">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                </div>
                <ul class="navbar-nav menu-open text-end">


                    <li>
                        <a href="<?php echo e(route('instructor.introduction')); ?>">Become an Instructor</a>

                    </li>
                </ul>
            </div>
            <div class="nav-right-part nav-right-part-desktop">
                <ul>
                    <?php if(auth()->guard()->check()): ?>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="<?php echo e(Auth::user()->ProfilePicture ?? asset('default-avatar.png')); ?>" alt="Avatar" class="rounded-circle" width="30" height="30">
                            <?php echo e(Auth::user()->FullName ?? "User"); ?>

                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('my.learning')); ?>">
                                My Learning
                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>">
                                Edit Profile
                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('purchase.history')); ?>">
                                Purchase History
                            </a>
                            <hr>
                            <a class="dropdown-item" href=" ">
                                Settings
                            </a>
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form>
                        </div>
                    </li>
                <?php else: ?>
                    <li><a href="#"><i class="fa fa-shopping-basket"></i></a></li>
                    <li><a href="<?php echo e(route('login')); ?>">Log In</a></li>
                    <li>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-base-light">
                            Sign Up
                        </a>
                    </li>

                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </nav>
</header>
<div class="category-responsive d-xl-none d-block">
    <div class="container">
        <div class="category-slider owl-carousel">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item">
                <a href="<?php echo e(route('category.show', ['id' => $category->CategoryID])); ?>"><?php echo e($category->CategoryName); ?></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
</div>
<div class="category-navbar navbar-area d-xl-block d-none">
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav menu-open">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li  >
                                <a href="<?php echo e(route('category.show', ['id' => $category->CategoryID])); ?>"><?php echo e($category->CategoryName); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </div>
        </div>
    </nav>
</div>
<?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/inc/header.blade.php ENDPATH**/ ?>