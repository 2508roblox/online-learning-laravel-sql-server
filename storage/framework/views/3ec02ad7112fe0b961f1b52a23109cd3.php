<?php $__env->startSection('content'); ?>




  <!-- breabcrumb Area Start-->
  <section class="breadcrumb-area" style="background-color: #F9FAFD;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 align-self-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Courses</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Category</li>
                </ul>
                <h2>Course Category</h2>
            </div>
        </div>
    </div>
</section>
<!-- breabcrumb Area End -->

<!-- trending courses Area Start-->
<section class="trending-courses-area pd-top-135 pd-bottom-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dmne-sidebar">
                    <div class="widget widget-select-inner">
                        <h4 class="widget-title">Category</h4>
                        <ul>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1" data-filter="all">
                                    <label class="form-check-label" for="flexCheckDefault1">All</label>
                                </div>
                            </li>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="<?php echo e($category->CategoryID); ?>" id="flexCheckDefault<?php echo e($category->CategoryID); ?>" data-filter="category-<?php echo e($category->CategoryID); ?>">
                                    <label class="form-check-label" for="flexCheckDefault<?php echo e($category->CategoryID); ?>">
                                        <?php echo e($category->CategoryName); ?> <span>(<?php echo e($category->CourseCount); ?>)</span>
                                    </label>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                    <div class="widget widget-select-inner">
                        <h4 class="widget-title">Level</h4>
                        <ul>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="Beginner" id="flexCheckDefault14" data-filter="level-beginner">
                                    <label class="form-check-label" for="flexCheckDefault14">Beginner</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="Intermediate" id="flexCheckDefault15" data-filter="level-intermediate">
                                    <label class="form-check-label" for="flexCheckDefault15">Intermediate</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="Expert" id="flexCheckDefault16" data-filter="level-expert">
                                    <label class="form-check-label" for="flexCheckDefault16">Expert</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-select-inner">
                        <h4 class="widget-title">Price</h4>
                        <ul>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault17">
                                    <label class="form-check-label" for="flexCheckDefault17">
                                        Free
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault18">
                                    <label class="form-check-label" for="flexCheckDefault18">
                                        Paid
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-select-inner">
                        <h4 class="widget-title">Language</h4>
                        <ul>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault19">
                                    <label class="form-check-label" for="flexCheckDefault19">
                                        English
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault20">
                                    <label class="form-check-label" for="flexCheckDefault20">
                                        Español
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault21">
                                    <label class="form-check-label" for="flexCheckDefault21">
                                        Yorùbá
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault22">
                                    <label class="form-check-label" for="flexCheckDefault22">
                                        اردو
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault23">
                                    <label class="form-check-label" for="flexCheckDefault23">
                                        لعربية
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault24">
                                    <label class="form-check-label" for="flexCheckDefault24">
                                        বাংলা
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="single-form-check form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault25">
                                    <label class="form-check-label" for="flexCheckDefault25">
                                        中文
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row" id="course-list">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-4 col-md-6 course-item" data-category="category-<?php echo e($course->CategoryID); ?>" data-level="level-<?php echo e(strtolower($course->Level)); ?>">
                        <div class="single-course-wrap">
                            <div class="thumb">
                                <a href="#" class="cat cat-blue"><?php echo e($course->Level); ?></a>
                                <a href="<?php echo e(route('course.preview', ['id' => $course->CourseID])); ?>">
                                    <img src="<?php echo e(asset('client/img/course/1.png')); ?>" alt="Course Image">
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
            <div class="col-lg-12 text-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                  </nav>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterCheckboxes = document.querySelectorAll('.form-check-input');
    const courseItems = document.querySelectorAll('.course-item');

    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            filterCourses();
        });
    });

    function filterCourses() {
        const activeFilters = {
            categories: [],
            levels: []
        };

        filterCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const filter = checkbox.getAttribute('data-filter');
                if (filter.startsWith('category-')) {
                    activeFilters.categories.push(filter);
                } else if (filter.startsWith('level-')) {
                    activeFilters.levels.push(filter);
                }
            }
        });

        courseItems.forEach(item => {
            const itemCategories = item.getAttribute('data-category').split(' ');
            const itemLevels = item.getAttribute('data-level').split(' ');

            const matchesCategory = activeFilters.categories.length === 0 || activeFilters.categories.some(filter => itemCategories.includes(filter));
            const matchesLevel = activeFilters.levels.length === 0 || activeFilters.levels.some(filter => itemLevels.includes(filter));

            if (matchesCategory && matchesLevel) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
});

</script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/courses_index.blade.php ENDPATH**/ ?>