<?php $__env->startSection('content'); ?>





<section class="courses-details-area pd-top-135 pd-bottom-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-course-wrap mb-0">
                    <div class="thumb">
                        <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                        <img src="<?php echo e(asset('storage/' . $course[0]->ImageURL)); ?>" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h5><a href="#"><?php echo e($course[0]->Title); ?></a></h5>
                        <p><?php echo e($course[0]->Description); ?></p>
                        <div class="user-area">
                            <div class="user-details">
                                <img style="width: 50px;" src="<?php echo e(asset( $course[0]->ProfilePicture )); ?>" alt="img">

                                <a href="<?php echo e(route('instructor.show', ['id' =>  $course[0]->InstructorID ])); ?>"><?php echo e($course[0]->InstructorName); ?></a>
                            </div>
                            <div class="date ms-auto">
                                <i class="fa fa-calendar-alt me-2" style="color: var(--main-color);"></i>Last updated <?php echo e(\Carbon\Carbon::parse($course[0]->UpdateAt)->format('m/Y')); ?>

                            </div>
                            <div class="ms-auto">
                                <i class="fa fa-user me-2" style="color: var(--main-color);"></i><?php echo e($course[0]->EnrolledLearner); ?> already enrolled
                            </div>
                            <div class="user-rating">
                                <span>
                                    <?php if($course[0]->Rating == 0 || $course[0]->Rating == ".00"): ?>
                                    0 Rating
                                <?php else: ?>
                                    <?php for($i = 0; $i < round($course[0]->Rating); $i++): ?>
                                        <i class="fa fa-star"></i>
                                    <?php endfor; ?>
                                    <?php echo e($course[0]->Rating); ?> Rating
                                <?php endif; ?>
                                </span> (<?php echo e($course[0]->EnrolledLearner); ?>)
                            </div>

                        </div>
                        <div class="buying-wrap d-flex align-items-center">
                            <h2 class="price d-inline-block mb-0">$<?php echo e($course[0]->Price); ?></h2>
                            <div class="ms-auto d-425-none">
                                <a href="#"><i class="far fa-heart"></i></a>
                                <a class="ms-4" href="#"><i class="fa fa-share me-2"></i>share</a>
                            </div>

                            <?php if($course[0]->HasPurchased == 1): ?>
                            <a class="btn btn-base ms-auto" href="<?php echo e(route('learning.course', ['course_id' => $course[0]->CourseID])); ?>">Learn Now</a>
                        <?php else: ?>
                            <a class="btn btn-base ms-auto" href="<?php echo e(route('checkout', ['course_id' => $course[0]->CourseID])); ?>">Enroll Now</a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
                <ul class="course-tab nav nav-pills pd-top-100">
                    <li class="nav-item">
                      <button class="nav-link active" id="pill-1" data-bs-toggle="pill" data-bs-target="#pills-01" type="button" role="tab" aria-controls="pills-01" aria-selected="true">Overview</button>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
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
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo e($sectionID); ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e($sectionID); ?>" aria-expanded="false" aria-controls="collapse<?php echo e($sectionID); ?>">
                                        <?php echo e($sectionItems->first()->SectionTitle); ?>

                                    </button>
                                </h2>
                                <div id="collapse<?php echo e($sectionID); ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo e($sectionID); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            <?php $__currentLoopData = $sectionItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <?php if($item->CurriculumItemType == 'V'): ?>
                                                        <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                                    <?php else: ?>
                                                        <i class="fa fa-lock"></i>
                                                    <?php endif; ?>
                                                    <span>
                                                        <p><?php echo e($item->CurriculumItemTitle); ?></p>
                                                        <span>
                                                            <?php if($item->CurriculumItemType == 'Q'): ?>
                                                                Quiz
                                                            <?php elseif($item->CurriculumItemType == 'A'): ?>
                                                                Assignment
                                                            <?php elseif($item->CurriculumItemType == 'V'): ?>
                                                                Video
                                                            <?php endif; ?>
                                                        </span>
                                                    </span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="widget widget-course-details mb-0">
                    <h5 class="widget-title">Course Details</h5>
                    <ul>
                        <li>Level: <span><?php echo e($course[0]->Level); ?></span></li>
                        <li>Categories: <span><a href="#"><?php echo e($course[0]->CategoryName); ?></a></span></li>
                        <li>Total Hour: <span>07h 30m</span></li>
                        <li>Total Lessons: <span><?php echo e(count($course)); ?></span></li>

                        <li>Total Enrolled: <span><?php echo e($course[0]->EnrolledLearner); ?></span></li>
                        <li>Last Update: <span><?php echo e(\Carbon\Carbon::parse($course[0]->UpdateAt)->format('F d, Y')); ?></span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/course_preview.blade.php ENDPATH**/ ?>