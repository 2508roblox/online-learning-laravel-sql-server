<?php $__env->startSection('content'); ?>
    <section class="admin-dashboard-section py-5">
        <div class="container">
            <?php
    $sectionCounter = 1; // Khởi tạo biến đếm từ 1
?>
            <h2 class="mb-4">Create Curriculum for Course</h2>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionIndex => $sectionData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!is_null($sectionData['section']->SectionID)): ?>
                <div class="section mb-4 p-4 border rounded bg-light">
                    <h3 class="mb-2">Section <?php echo e($sectionCounter); ?>: <?php echo e($sectionData['section']->SectionTitle); ?></h3>
                    <p class="text-muted"><?php echo e($sectionData['section']->SectionLearningObjective); ?></p>
                    <?php
                    $sectionCounter += 1; // Khởi tạo biến đếm từ 1
                ?>
                    <ul class="list-group mb-3">
                        <ul class="list-group mb-3">
                            <?php
                                $quizCounter = 1;
                                $assignmentCounter = 1;
                                $lectureCounter = 1;
                            ?>

                            <?php $__currentLoopData = $sectionData['curriculums']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curriculum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!is_null($curriculum->CurriculumItemID)): ?>
                                    <?php
                                        $itemType = '';
                                        $itemLabel = '';

                                        if ($curriculum->CurriculumItemType == 'Q') {
                                            $itemType = 'Quiz';
                                            $itemLabel = $itemType . ' ' . $quizCounter;
                                            $quizCounter++;
                                        } elseif ($curriculum->CurriculumItemType == 'A') {
                                            $itemType = 'Assignment';
                                            $itemLabel = $itemType . ' ' . $assignmentCounter;
                                            $assignmentCounter++;
                                        } elseif ($curriculum->CurriculumItemType == 'L') {
                                            $itemType = 'Lecture';
                                            $itemLabel = $itemType . ' ' . $lectureCounter;
                                            $lectureCounter++;
                                        }
                                    ?>

                                    <li class="list-group-item border border-secondary rounded mb-2 p-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p style="font-weight: 600; color:black" class="text-xs mb-1">
                                                <?php echo e($itemLabel); ?>: <?php echo e($curriculum->CurriculumItemTitle); ?></p>
                                            <?php
                                                $editRoute = '';
                                                if ($curriculum->CurriculumItemType == 'Q') {
                                                    $editRoute = route(
                                                        'instructor.curriculums.quiz.edit',
                                                        $curriculum->CurriculumItemID,
                                                    );
                                                } elseif ($curriculum->CurriculumItemType == 'A') {
                                                    $editRoute = route(
                                                        'instructor.curriculums.assignment.edit',
                                                        $curriculum->CurriculumItemID,
                                                    );
                                                } elseif ($curriculum->CurriculumItemType == 'L') {
                                                    $editRoute = route(
                                                        'instructor.curriculums.lecture.edit',
                                                        $curriculum->CurriculumItemID,
                                                    );
                                                }
                                            ?>
                                            <?php if($editRoute): ?>
                                                <a href="<?php echo e($editRoute); ?>" class="">
                                                    <svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true"
                                                        focusable="false" data-prefix="fas" data-icon="edit" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                                                        data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <p class="mb-1 text-muted"><?php echo e($curriculum->CurriculumItemDescription); ?></p>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </ul>

                    </ul>


                    <!-- Nút để thêm curriculum -->
                    <div class="mb-3">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-curriculum-modal"
                            data-section-id="<?php echo e($sectionData['section']->SectionID); ?>">Add Curriculum</button>
                    </div>

                    <!-- Modal để thêm curriculum -->
                    <div class="modal fade" id="add-curriculum-modal" tabindex="-1" aria-labelledby="addCurriculumLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" style="margin: auto">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCurriculumLabel">Add Curriculum</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="curriculum-form" method="POST" action="">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" id="modal-section-id" name="section_id" value="">

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type</label>
                                            <select class="form-select" id="type" name="type" required>
                                                <option value="Q">Quiz</option>
                                                <option value="A">Assignment</option>
                                                <option value="L">Lecture</option>
                                            </select>
                                        </div>

                                        <!-- Fields for Assignment -->
                                        <div id="assignment-fields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="instructions" class="form-label">Instructions</label>
                                                <textarea class="form-control" id="instructions" name="instructions" rows="3"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="duration1" class="form-label">Duration (minutes)</label>
                                                <input type="number" class="form-control" id="duration1" name="duration1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="due_time" class="form-label">Due Time</label>
                                                <input type="datetime-local" class="form-control" id="due_time"
                                                    name="due_time">
                                            </div>
                                            <div class="mb-3">
                                                <label for="submission_status" class="form-label">Submission
                                                    Status</label>
                                                <input type="text" class="form-control" id="submission_status"
                                                    name="submission_status" value="Not Submitted">
                                            </div>
                                        </div>

                                        <!-- Fields for Lecture -->
                                        <div id="lecture-fields" style="display: none;">
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Duration (minutes)</label>
                                                <input type="number" class="form-control" id="duration"
                                                    name="duration">
                                            </div>
                                            <div class="form-group mt-3 mb-4">
                                                <label for="promotional_video_url">Lecture Video</label>
                                                <input type="file" class="form-control" id="promotional_video_url"
                                                    name="video" onchange="uploadVideo()" >
                                            </div>
                                            <div id="loading-icon" style="display: none;">
                                                <img src="<?php echo e(asset('H8An.gif')); ?>" alt="Loading" width="50"
                                                    height="50">
                                            </div>
                                            <input type="hidden" id="video_url" name="video_url">
                                            <div id="videoContainer" style="display: none; width: 300px;">
                                                <video id="uploadedVideo" controls style="width: 300px;">
                                                    <!-- Video source will be set dynamically -->
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            <script>
                                                function uploadVideo() {
                                                    // Show the loading icon
                                                    document.getElementById('loading-icon').style.display = 'block';

                                                    let formData = new FormData();
                                                    formData.append('video', document.getElementById('promotional_video_url').files[0]);

                                                    fetch('/api/upload-video', {
                                                            method: 'POST',
                                                            body: formData
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            console.log('Uploaded video URL:', data.video_url);
                                                            renderVideo(data.video_url);
                                                            // Set the hidden input value to the video URL
                                                            document.getElementById('video_url').value = data.video_url;
                                                            // Set the content field value to the video URL
                                                            document.getElementById('content').value = data.video_url;
                                                            // Hide the loading icon
                                                            document.getElementById('loading-icon').style.display = 'none';
                                                        })
                                                        .catch(error => {
                                                            console.error('Error uploading video:', error);
                                                            // Hide the loading icon
                                                            document.getElementById('loading-icon').style.display = 'none';
                                                        });
                                                }

                                                function renderVideo(videoUrl) {
                                                    // Show the video container
                                                    document.getElementById('videoContainer').style.display = 'block';

                                                    // Set the source of the video element
                                                    let videoElement = document.getElementById('uploadedVideo');
                                                    videoElement.src = videoUrl;
                                                }
                                            </script>
                                            <div style="display: none" class="mb-3">
                                                <label for="content" class="form-label">Content</label>
                                                <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                                            </div>
                                        </div>



                                        <!-- Fields for Quiz -->
                                        <div id="quiz-fields" style="display: none;">
                                            <!-- Add quiz-specific fields here if needed -->
                                        </div>

                                        <button type="submit" class="btn btn-success">Save</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <!-- Nút để thêm Section -->
            <div class="mb-3">
                <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#add-section-modal">Add
                    Section</button>
            </div>

            <!-- Modal để thêm Section -->
            <div class="modal fade" id="add-section-modal" tabindex="-1" aria-labelledby="addSectionLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" style="display: flex; margin: auto;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSectionLabel">Add Section</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST"
                                action="<?php echo e(route('instructor.courses.section.store', ['courseId' => $courseId])); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="mb-3">
                                    <label for="section_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="section_title" name="section_title"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="section_learning_objective" class="form-label">Learning Objective</label>
                                    <textarea class="form-control" id="section_learning_objective" name="section_learning_objective" rows="3"
                                        required></textarea>
                                </div>
                                <input type="hidden" name="course_id" value="<?php echo e($courseId); ?>">
                                <button type="submit" class="btn btn-success">Save Section</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = document.getElementById('add-curriculum-modal');
                modal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var sectionId = button.getAttribute('data-section-id');
                    var form = document.getElementById('curriculum-form');
                    form.action = '/instructor/courses/' + sectionId + '/curriculum';
                    document.getElementById('modal-section-id').value = sectionId;
                });

                var typeSelect = document.getElementById('type');
                typeSelect.addEventListener('change', function() {
                    var assignmentFields = document.getElementById('assignment-fields');
                    var lectureFields = document.getElementById('lecture-fields');
                    var quizFields = document.getElementById('quiz-fields');

                    assignmentFields.style.display = 'none';
                    lectureFields.style.display = 'none';
                    quizFields.style.display = 'none';

                    if (this.value === 'A') {
                        assignmentFields.style.display = 'block';
                    } else if (this.value === 'L') {
                        lectureFields.style.display = 'block';
                    } else if (this.value === 'Q') {
                        quizFields.style.display = 'block';
                    }
                });
            });
        </script>

        <?php echo $__env->make('instructor.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('instructor.inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/create_curriculum.blade.php ENDPATH**/ ?>