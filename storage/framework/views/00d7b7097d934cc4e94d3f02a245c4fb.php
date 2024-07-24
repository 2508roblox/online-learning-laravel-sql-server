<?php $__env->startSection('content'); ?>

    <!-- breabcrumb Area Start-->
    <section class="breadcrumb-area" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Learning</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- breabcrumb Area End -->

    <section class="enllor-courses-area pd-top-120 pd-bottom-140">
        <div class="container">
            <div class="row mb-4" style="align-items: flex-end">
                <div class="col-lg-4">
                    <div class="widget widget-select-inner">
                        <p class="widget-title">Category</p>
                        <div class="input-group mb-3">
                            <select class="form-select" id="categoryFilter" style="
                            height: 42px;
                        ">
                                <option value="all">All</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->CategoryID); ?>"><?php echo e($category->CategoryName); ?> (<?php echo e($category->CourseCount); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <button   style="
                            height: 42px;
                             line-height: 100%;
                        " class="btn btn-outline-secondary" type="button" id="clearCategoryFilter">Clear</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="widget widget-select-inner">
                        <p class="widget-title">Level</p>
                        <div class="input-group mb-3">
                            <select class="form-select" id="levelFilter" style="
                            height: 42px;
                        ">
                                <option value="all">All</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="expert">Expert</option>
                            </select>
                            <button  style="
                            height: 42px;
                             line-height: 100%;
                        " class="btn btn-outline-secondary" type="button" id="clearLevelFilter">Clear</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single-input-wrap">
                        <form action="<?php echo e(route('courses.index')); ?>" method="GET" class="single-input-wrap">
                            <input type="text" name="search" class="form-control" placeholder="Search your best courses" value="<?php echo e($searchParam ?? ''); ?>">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row" id="course-list">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-xl-3 col-md-6 course-item" data-category="category-<?php echo e($course->CategoryID); ?>" data-level="level-<?php echo e(strtolower($course->Level)); ?>">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="#" class="cat cat-blue"><?php echo e($course->Level); ?></a>
                                    <a href="<?php echo e(route('course.preview', ['id' => $course->CourseID])); ?>">
                                        <img src="<?php echo e(asset('storage/' . $course->ImageURL)); ?>" alt="img">

                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="<?php echo e(route('course.preview', ['id' => $course->CourseID])); ?>"><?php echo e($course->Title); ?></a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="<?php echo e(asset('client/img/author/1.png')); ?>" alt="Instructor Image">
                                            <a href="#"><?php echo e($course->InstructorName); ?></a>
                                        </div>
                                        <div class="user-rating">
                                            <span>
                                                <?php for($i = 0; $i < floor($course->Rating); $i++): ?>
                                                    <i class="fa fa-star"></i>
                                                <?php endfor; ?>
                                                <?php if($course->Rating - floor($course->Rating) > 0): ?>
                                                    <i class="fa fa-star-half-alt"></i>
                                                <?php endif; ?>
                                                (<?php echo e($course->EnrolledLearner); ?>)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="price-wrap">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <a href="#"><?php echo e($course->CategoryName); ?></a>
                                            </div>
                                            <div  class="col-6 text-end">
                                                <a   href="<?php echo e(route('learning.course', ['course_id' => $course->CourseID])); ?>" class="btn btn-primary">Start</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('categoryFilter');
            const levelFilter = document.getElementById('levelFilter');
            const clearCategoryFilter = document.getElementById('clearCategoryFilter');
            const clearLevelFilter = document.getElementById('clearLevelFilter');
            const courseItems = document.querySelectorAll('.course-item');

            categoryFilter.addEventListener('change', filterCourses);
            levelFilter.addEventListener('change', filterCourses);
            clearCategoryFilter.addEventListener('click', clearCategory);
            clearLevelFilter.addEventListener('click', clearLevel);

            function filterCourses() {
                const selectedCategory = categoryFilter.value;
                const selectedLevel = levelFilter.value;

                courseItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    const itemLevel = item.getAttribute('data-level');

                    const matchesCategory = selectedCategory === 'all' || itemCategory.includes(selectedCategory);
                    const matchesLevel = selectedLevel === 'all' || itemLevel.includes(selectedLevel);

                    if (matchesCategory && matchesLevel) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            function clearCategory() {
                categoryFilter.value = 'all';
                filterCourses();
            }

            function clearLevel() {
                levelFilter.value = 'all';
                filterCourses();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/my_learning.blade.php ENDPATH**/ ?>