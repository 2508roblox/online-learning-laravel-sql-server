<div class="dashboard-left-menu">
    <a href="" class="logo"><img src="<?php echo e(asset('instructor/img/logo.png')); ?>"  alt="img"></a>
    <ul>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('instructor.dashboard')); ?>"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('instructor.profile')); ?>"><i class="fa fa-user"></i> My Profile</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('instructor.courses')); ?>"><i class="fas fa-graduation-cap"></i>My Courses</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('instructor.courses.create')); ?>"><i class="fa fa-rocket"></i>Create Course</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('instructor.profile.edit')); ?>"><i class="fas fa-cog"></i>Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="<?php echo e(route('logout')); ?>"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </li>
    </ul>

</div>
<?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/inc/sidebar.blade.php ENDPATH**/ ?>