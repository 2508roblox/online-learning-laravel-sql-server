<?php $__env->startSection('content'); ?>

<section class="admin-dashboard-section py-5">
    <div class="container">
        <!-- Form để tạo mới Quiz -->
        <div class="mb-5">
            <h3>Create New Quiz</h3>
            <form action="<?php echo e(route('instructor.curriculums.quiz.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="QuizID" value="<?php echo e($curriculums[0]->QuizID); ?>">

                <div class="form-group mb-3">
                    <label for="Question">Question</label>
                    <textarea class="form-control" id="Question" name="Question" rows="3" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="Choices">Choices</label>
                    <div id="choices-container">
                        <div class="choice-item mb-2">
                            <input type="text" class="form-control mb-1" name="Choices[0][Answer]" placeholder="Answer" required>
                            <textarea class="form-control mb-1" name="Choices[0][Explanation]" rows="2" placeholder="Explanation" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addChoice()">Add Another Choice</button>
                </div>

                <div class="form-group mb-3">
                    <label for="CorrectAnswer">Correct Answer</label>
                    <input type="text" class="form-control" id="CorrectAnswer" name="CorrectAnswer" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Question</button>
            </form>
        </div>

        <!-- Danh sách các câu hỏi -->
        <div class="question-list">
            <h3>Questions</h3>
            <ul class="list-group">
                <?php $__currentLoopData = $curriculums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $curriculum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($curriculum->MCQNo !== null): ?>
                    <?php
                        $choices = json_decode($curriculum->Choices, true);
                    ?>
                    <li class="list-group-item border border-secondary rounded mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-1"><?php echo e($curriculum->Question); ?></h5>
                            <a href="<?php echo e(route('instructor.curriculums.quiz.question.edit', $curriculum->MCQNo)); ?>" class="btn btn-info btn-sm">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </div>
                        <ul class="list-unstyled mt-2">
                            <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <strong><?php echo e($choice['Answer']); ?>:</strong> <?php echo e($choice['Explanation']); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <p class="mb-0"><strong>Correct Answer:</strong> <?php echo e($curriculum->CorrectAnswer); ?></p>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </ul>
        </div>
    </div>

    <?php echo $__env->make('instructor.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<script>
    let choiceIndex = 1;

    function addChoice() {
        const container = document.getElementById('choices-container');
        const newChoice = document.createElement('div');
        newChoice.classList.add('choice-item', 'mb-2');
        newChoice.innerHTML = `
            <input type="text" class="form-control mb-1" name="Choices[${choiceIndex}][Answer]" placeholder="Answer" required>
            <textarea class="form-control mb-1" name="Choices[${choiceIndex}][Explanation]" rows="2" placeholder="Explanation" required></textarea>
        `;
        container.appendChild(newChoice);
        choiceIndex++;
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('instructor.inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/curriculums/edit_quiz.blade.php ENDPATH**/ ?>