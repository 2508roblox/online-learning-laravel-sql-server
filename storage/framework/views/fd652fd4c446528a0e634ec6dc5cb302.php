<?php $__env->startSection('content'); ?>





    <!-- breabcrumb Area Start-->
    <section class="breadcrumb-area" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Courses</a></li>

                        <li class="breadcrumb-item active" aria-current="page"><?php echo e($category[0]->Name); ?></li>
                    </ul>
                    <h2><?php echo e($category[0]->Name); ?> Course</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- breabcrumb Area End -->

    <section class="enllor-courses-area pd-top-120 pd-bottom-140">
        <div class="container">

<?php $__currentLoopData = $structuredCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoryID => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="section-title">
            <h2><?php echo e($subcategory['SubcategoryName']); ?></h2>
        </div>
    </div>
    <div class="col-lg-12">
        <ul class="edl-nav nav nav-pills">
            <?php $__currentLoopData = $subcategory['Topics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicID => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                    <button class="nav-link <?php echo e($loop->first ? 'active' : ''); ?>" id="pills-<?php echo e($topicID); ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo e($topicID); ?>"><?php echo e($topic['TopicName']); ?></button>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <div class="tab-content">
            <?php $__currentLoopData = $subcategory['Topics']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topicID => $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade <?php echo e($loop->first ? 'show active' : ''); ?>" id="pills-<?php echo e($topicID); ?>">
                    <div class="course-slider owl-carousel">
                        <?php $__currentLoopData = $topic['Courses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="#" class="cat cat-blue"><?php echo e($course->Level); ?></a>
                                    <a href="<?php echo e(route('course.preview', ['id' => $course->CourseID])); ?>">
                                        <img src="<?php echo e(asset('storage/'. $course->ImageURL)); ?>" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="<?php echo e(route('course.preview', ['id' => $course->CourseID])); ?>"><?php echo e($course->CourseTitle); ?></a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="<?php echo e(asset('client/img/author/' . $course->InstructorID . '.png')); ?>" alt="img">
                                            <a href="<?php echo e(route('instructor.show', ['id' =>  $course->InstructorID ])); ?>">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i> <?php echo e($course->Rating); ?></span> (<?php echo e($course->EnrolledLearner); ?>)
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <a href="#">Development</a>
                                            </div>
                                            <div class="col-6 text-end">
                                                <div class="price">$<?php echo e($course->Price); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/category.blade.php ENDPATH**/ ?>