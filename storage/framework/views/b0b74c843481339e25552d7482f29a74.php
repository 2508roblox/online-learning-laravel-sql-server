<?php $__env->startSection('content'); ?>

<section class="admin-dashboard-section py-5">
    <div class="container">
        <!-- Form để chỉnh sửa câu hỏi -->
        <div class="mb-5">
            <h3>Edit Question</h3>
            <form action="<?php echo e(route('instructor.curriculums.quiz.update', $question->MCQNo)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?> <!-- Đặt phương thức PUT cho cập nhật -->

                <div class="form-group mb-3">
                    <label for="Question">Question</label>
                    <textarea class="form-control" id="Question" name="Question" rows="3" required><?php echo e($question->Question); ?></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="Choices">Choices</label>
                    <div id="choices-container">
                        <?php
                            $choices = json_decode($question->Choices, true);
                        ?>
                        <?php $__currentLoopData = $choices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $choice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="choice-item mb-2">
                                <input type="text" class="form-control mb-1" name="Choices[<?php echo e($index); ?>][Answer]" value="<?php echo e($choice['Answer']); ?>" placeholder="Answer" required>
                                <textarea class="form-control mb-1" name="Choices[<?php echo e($index); ?>][Explanation]" rows="2" placeholder="Explanation" required><?php echo e($choice['Explanation']); ?></textarea>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" class="btn btn-secondary" onclick="addChoice()">Add Another Choice</button>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="CorrectAnswer">Correct Answer</label>
                    <input type="text" class="form-control" id="CorrectAnswer" name="CorrectAnswer" value="<?php echo e($question->CorrectAnswer); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Question</button>
            </form>
        </div>
    </div>
</section>

<script>
    let choiceIndex = <?php echo e(count($choices)); ?>;

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

<?php echo $__env->make('instructor.inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/curriculums/edit_question.blade.php ENDPATH**/ ?>