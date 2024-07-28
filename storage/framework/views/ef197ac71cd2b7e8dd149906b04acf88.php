<?php $__env->startSection('content'); ?>

<!-- Breadcrumb Area Start-->
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
<!-- Breadcrumb Area End -->

<section class="enllor-courses-area pd-top-120 pd-bottom-140">
    <div class="container">
        <h2>Purchase History</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Total Price</th>
                    <th>Payment Type</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $paymentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($payment->Title); ?></td>
                        <td><?php echo e($payment->DateCreated); ?></td>
                        <td><?php echo e($payment->TotalPrice); ?></td>
                        <td><?php echo e($payment->PaymentMethod); ?></td>
                        <td><?php echo e($payment->TotalDiscount ? $payment->TotalDiscount : 'No discount available'); ?></td>
                        <td><?php echo e($payment->Status); ?></td>
                        <td>
                            <a   class="btn btn-info">Receipt</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/purchase_history.blade.php ENDPATH**/ ?>