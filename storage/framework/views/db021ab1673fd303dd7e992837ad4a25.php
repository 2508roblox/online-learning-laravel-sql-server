<?php $__env->startSection('content'); ?>
<section class="admin-dashboard-section">
    <div class="admin-dashboard-right-side">
        <!-- top header start  -->
        <div class="main-header">
            <div class="header-wraper">
                <div class="row">
                    <div class="col-xl-6">
                        <span class="header-user">
                            <a href="#"><img style="width: 100px;" src="<?php echo e($instructor->ProfilePicture); ?>" alt="Profile Picture"></a>
                            <span>Hello,
                                <h5><?php echo e($instructor->FullName); ?></h5>
                            </span>
                        </span>
                    </div>
                    <div class="col-xl-6 align-self-center text-lg-end">
                        <div class="d-lg-flex align-items-center">
                            <div class="user-rating text-center d-inline-block">
                                <span class="d-block">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                                4.0 (172 Ratings)
                            </div>
                            <a class="header-btn btn btn-white" href="#">Create a new course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- top header end  -->

        <!-- dashboard-area start  -->
        <div class="dashboard-profile-area">
            <h5 class="dashboard-title">Edit Profile</h5>
            <form action="<?php echo e(route('instructor.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <!-- User Information -->
                <div class="form-group">
                    <label for="FullName">Full Name</label>
                    <input type="text" id="FullName" name="FullName" class="form-control" value="<?php echo e($instructor->FullName); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Birthday">Birthday</label>
                    <input type="date" id="Birthday" name="Birthday" class="form-control" value="<?php echo e($instructor->Birthday); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Gender">Gender</label>
                    <select id="Gender" name="Gender" class="form-control" required>
                        <option value="M" <?php echo e($instructor->Gender == 'M' ? 'selected' : ''); ?>>Male</option>
                        <option value="F" <?php echo e($instructor->Gender == 'F' ? 'selected' : ''); ?>>Female</option>
                        <option value="O" <?php echo e($instructor->Gender == 'O' ? 'selected' : ''); ?>>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Phone">Phone Number</label>
                    <input type="text" id="Phone" name="Phone" class="form-control" value="<?php echo e($instructor->Phone); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" id="Address" name="Address" class="form-control" value="<?php echo e($instructor->Address); ?>" required>
                </div>
                <div class="form-group">
                    <label for="ProfilePicture">Profile Picture</label>
                    <input type="file" class="form-control" id="ProfilePicture" name="ProfilePicture" onchange="previewImage(event)">
                    <img id="image-preview" src="<?php echo e($instructor->ProfilePicture); ?>" alt="Image Preview" style="display: <?php echo e($instructor->ProfilePicture ? 'block' : 'none'); ?>; width: 100px; height: auto; margin-top: 10px;">
                </div>

                <script>
                function previewImage(event) {
                    var reader = new FileReader();
                    reader.onload = function(){
                        var output = document.getElementById('image-preview');
                        output.src = reader.result;
                        output.style.display = 'block';
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
                </script>


                <div class="form-group">
                    <label for="Resume">Resume</label>
                    <textarea id="Resume" name="Resume" class="form-control"><?php echo e($instructor->Resume); ?></textarea>
                </div>

                <!-- Instructor Specific Information -->
                <div class="form-group">
                    <label for="ScientificBackground">Scientific Background</label>
                    <textarea id="ScientificBackground" name="ScientificBackground" class="form-control"><?php echo e($instructor->ScientificBackground); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="Degrees">Degrees</label>
                    <textarea id="Degrees" name="Degrees" class="form-control"><?php echo e($instructor->Degrees); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="Workplace">Workplace</label>
                    <textarea id="Workplace" name="Workplace" class="form-control"><?php echo e($instructor->Workplace); ?></textarea>
                </div>


                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
    <!-- dashboard-left-menu start  -->
    <?php echo $__env->make('instructor.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('instructor.inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor/edit_profile.blade.php ENDPATH**/ ?>