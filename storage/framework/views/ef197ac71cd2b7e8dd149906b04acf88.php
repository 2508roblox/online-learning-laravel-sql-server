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


            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Total price</th>
                        <th>Payment type</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Replace with PHP loop to populate data -->
                    <tr>
                        <td>The Complete AI-Powered Copywriting Course & ChatGPT Course</td>
                        <td>Nov 12, 2023</td>
                        <td>₫0</td>
                        <td>Free Coupon</td>
                        <td>No discount available</td>
                        <td>Completed</td>
                        <td>
                           <button class="nav-link active" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2">Receipt</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Amazon Dropshipping And Retail Arbitrage With AI - 2024</td>
                        <td>Oct 15, 2023</td>
                        <td>₫0</td>
                        <td>Free Coupon</td>
                        <td>50% discount applied</td>
                        <td>In Progress</td>
                        <td>
                        <button class="nav-link active" id="pills-2-tab" data-bs-toggle="pill" data-bs-target="#pills-2">Receipt</button>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>


        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/purchase_history.blade.php ENDPATH**/ ?>