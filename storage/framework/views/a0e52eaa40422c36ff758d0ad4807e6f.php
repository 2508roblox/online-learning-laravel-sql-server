<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edufie - Online Courses Html Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="<?php echo e(asset('client/img/fevicon.png')); ?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('client/css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/magnific.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/nice-select.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/owl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/slick-slide.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/css/responsive.css')); ?>">
    <style>
        body, html {
            height: 100%;
        }
        .courses-details-area {
            min-height: 100%;
            display: flex;
            align-items: stretch;
        }
        .col-lg-8 {
            flex: 0 0 70%;
            max-width: 70%;
            height: 100%;
            overflow-y: auto; /* Enable scrolling if content exceeds height */
            position: sticky;
            top: 0;
            padding-right: 15px; /* Offset scrollbar width */
        }
        .sidebar-area {
            flex: 0 0 30%;
            max-width: 30%;
            height: 100%;
            position: sticky;
            top: 0;
            padding-left: 15px; /* Offset scrollbar width */
        }
    </style>
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


    <section class="courses-details-area">
        <div class=" " style="width: 100%">
            <div class="row">
                <div class="col-lg-8">
                    <?php if(!empty($video->Content)): ?>
                    <div class="single-course-wrap mb-0">
                        <div class="thumb">
                            <video controls style="width: 100%;">
                                <source src="<?php echo e($video->Content); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>

                <?php endif; ?>
                <div class="single-course-wrap mb-0 " style="padding: 1rem">
                    <?php if(!empty($quiz)): ?>
                    <div id="quiz-questions">
                        <?php $__currentLoopData = $quiz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="quiz-question card mb-3 p-3" data-question="<?php echo e($index); ?>" style="display: <?php echo e($index == 0 ? 'block' : 'none'); ?>;">
                                <h4 class="card-title">Question <?php echo e($index + 1); ?>: <?php echo e($question->Question); ?></h4>
                                <?php
                                    $choices = json_decode($question->Choices);
                                ?>
                                <?php if($choices): ?>
                                    <ul class="list-group list-group-flush">
                                        <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="question<?php echo e($index); ?>" id="choice<?php echo e($loop->index); ?>" value="<?php echo e($choice->Answer); ?>">
                                                    <label class="form-check-label" for="choice<?php echo e($loop->index); ?>">
                                                        <?php echo e($choice->Answer); ?>

                                                    </label>
                                                </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="quiz-navigation mt-3">
                        <button id="prev-question" class="btn btn-secondary" disabled>Previous</button>
                        <button id="next-question" class="btn btn-primary">Next</button>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const questions = document.querySelectorAll('.quiz-question');
                            const prevButton = document.getElementById('prev-question');
                            const nextButton = document.getElementById('next-question');
                            let currentQuestion = 0;

                            prevButton.addEventListener('click', function () {
                                if (currentQuestion > 0) {
                                    questions[currentQuestion].style.display = 'none';
                                    currentQuestion--;
                                    questions[currentQuestion].style.display = 'block';
                                    updateNavigationButtons();
                                }
                            });

                            nextButton.addEventListener('click', function () {
                                if (currentQuestion < questions.length - 1) {
                                    questions[currentQuestion].style.display = 'none';
                                    currentQuestion++;
                                    questions[currentQuestion].style.display = 'block';
                                    updateNavigationButtons();
                                }
                            });

                            function updateNavigationButtons() {
                                prevButton.disabled = currentQuestion === 0;
                                nextButton.disabled = currentQuestion === questions.length - 1;
                            }

                            updateNavigationButtons();
                        });
                    </script>
                <?php endif; ?>
                </div>

                    <ul class="course-tab nav nav-pills pt-5 px-5">
                        <!-- Overview tab (active by default) -->
                        <li class="nav-item">
                            <button class="nav-link active" id="pill-1" data-bs-toggle="pill" data-bs-target="#pills-01" type="button" role="tab" aria-controls="pills-01" aria-selected="true">Overview</button>
                        </li>
                        <!-- Your additional tabs -->
                        <li class="nav-item">
                            <button class="nav-link" id="pill-2" data-bs-toggle="pill" data-bs-target="#pills-02" type="button" role="tab" aria-controls="pills-02" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-3" data-bs-toggle="pill" data-bs-target="#pills-03" type="button" role="tab" aria-controls="pills-03" aria-selected="false">Announcements</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-4" data-bs-toggle="pill" data-bs-target="#pills-04" type="button" role="tab" aria-controls="pills-04" aria-selected="false">Reviews</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-5" data-bs-toggle="pill" data-bs-target="#pills-05" type="button" role="tab" aria-controls="pills-05" aria-selected="false">Learning tools</button>
                        </li>
                    </ul>
                    <div class="tab-content p-5 pt-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-01" role="tabpanel" aria-labelledby="pill-1">
                            <div class="overview-area">
                                <h5>Course details</h5>
                                <p><?php echo e($course[0]->Description); ?></p>
                                <div class="bg-gray">
                                    <h6>What Will I Learn?</h6>
                                    <?php if(!is_null($course[0]->LearningObjective)): ?>
                                        <?php
                                            $learningObjectives = json_decode($course[0]->LearningObjective, true);
                                        ?>
                                        <?php if(!is_null($learningObjectives)): ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul>
                                                        <?php $__currentLoopData = $learningObjectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $objective): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($loop->index % 2 == 0): ?>
                                                                <li><i class="fa fa-check"></i><?php echo e($objective); ?></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul>
                                                        <?php $__currentLoopData = $learningObjectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $objective): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($loop->index % 2 != 0): ?>
                                                                <li><i class="fa fa-check"></i><?php echo e($objective); ?></li>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <p>No learning objectives available.</p>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p>No data available.</p>
                                    <?php endif; ?>
                                </div>

                                <h6>Requirements</h6>
                                <ul>
                                    <?php
                                        $requirements = json_decode($course[0]->Requirement, true);
                                    ?>
                                    <?php if(!is_null($requirements)): ?>
                                        <?php $__currentLoopData = $requirements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><i class="fa fa-check"></i><?php echo e($requirement); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <li>No requirements listed.</li>
                                    <?php endif; ?>
                                </ul>

                                <h6 class="mt-5">Skills covered in this course</h6>
                                <ul>
                                    <?php
                                        $intendedLearners = json_decode($course[0]->IntendedLearner, true);
                                    ?>
                                    <?php if(!is_null($intendedLearners)): ?>
                                        <?php $__currentLoopData = $intendedLearners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $intendedLearner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><i class="fa fa-check"></i><?php echo e($intendedLearner); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <li>No intended learners specified.</li>
                                    <?php endif; ?>
                                </ul>



                        </div>
                        </div>
                        <div class="tab-pane fade" id="pills-02" role="tabpanel" aria-labelledby="pill-2">...</div>
                        <div class="tab-pane fade" id="pills-03" role="tabpanel" aria-labelledby="pill-3">...</div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar-area">
                    <div class="widget widget-accordion-inner">
                        <h5 class="widget-title border-0">Course Syllabus</h5>
                        <div class="accordion" id="accordionExample">
                            <?php
                                $sections = collect($course)->groupBy('SectionID');
                            ?>

<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionID => $sectionItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="accordion-item active">
    <h2 class="accordion-header" id="heading<?php echo e($sectionID); ?>">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($sectionID); ?>" aria-expanded="true" aria-controls="collapse<?php echo e($sectionID); ?>">
            <?php echo e($sectionItems->first()->SectionTitle); ?>

        </button>
    </h2>
    <div id="collapse<?php echo e($sectionID); ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo e($sectionID); ?>" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <ul class="list-unstyled">
                <?php $__currentLoopData = $sectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="
                    <?php if($item->CurriculumItemType == 'Q'): ?>
                        <?php echo e(route('learning.quiz', ['course_id' => $course[0]->CourseID, 'item_id' => $item->CurriculumItemID])); ?>

                    <?php elseif($item->CurriculumItemType == 'A'): ?>
                        <?php echo e(route('learning.assignment', ['course_id' => $course[0]->CourseID, 'item_id' => $item->CurriculumItemID])); ?>

                    <?php elseif($item->CurriculumItemType == 'L'): ?>
                        <?php echo e(route('learning.video', ['course_id' => $course[0]->CourseID, 'item_id' => $item->CurriculumItemID])); ?>

                    <?php endif; ?>
" class="curriculum-item p-1 d-block cursor-pointer <?php echo e($item->CurriculumItemID == ($current_item ?? 0) ? 'active' : ''); ?>">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-play me-2"></i>
                        <div>
                            <p><?php echo e($item->CurriculumItemTitle); ?></p>
                            <span>
                                <?php if($item->CurriculumItemType == 'Q'): ?>
                                    Quiz
                                <?php elseif($item->CurriculumItemType == 'A'): ?>
                                    Assignment
                                <?php elseif($item->CurriculumItemType == 'L'): ?>
                                    Video
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>

<style>
    /* CSS */
.play-btn {
    transition: transform 0.3s ease-in-out;
}

.play-btn:hover {
    transform: scale(1.1); /* Scale up on hover */
}
/* CSS */
.curriculum-item {
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.curriculum-item:hover {
    background-color: #f2f2f2; /* Màu nền khi hover */
}



</style>
<!-- all plugins here -->
<script src="<?php echo e(asset('client/js/jquery.3.6.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/imageloded.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/counterup.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/waypoint.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/magnific.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/nice-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/fontawesome.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/ripple.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/owl.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/slick-slider.min.js')); ?>"></script>
<script src="<?php echo e(asset('client/js/wow.min.js')); ?>"></script>
<!-- main js  -->
<script src="<?php echo e(asset('client/js/main.js')); ?>"></script>
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
<style>

    .curriculum-item:hover {
        background-color: #f9f9f9; /* Light background on hover */
        cursor: pointer; /* Pointer cursor on hover */
    }

    .curriculum-item.active {
        background-color: #e0f7fa; /* Highlight background for active item */
        font-weight: bold; /* Make text bold for active item */
    }
</style>

</body>
</html>
<?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/learning.blade.php ENDPATH**/ ?>