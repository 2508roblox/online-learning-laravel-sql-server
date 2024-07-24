<?php $__env->startSection('content'); ?>





    <!-- breabcrumb Area Start-->
    <section class="breadcrumb-area" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Courses</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- breabcrumb Area End -->

    <section class="enllor-courses-area pd-top-120 pd-bottom-140">
        <div class="container">
            <h2>Edit Profile</h2>
            <ul class="nav nav-tabs" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info" aria-selected="true">Basic Information</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="change-password-tab" data-bs-toggle="tab" data-bs-target="#change-password" type="button" role="tab" aria-controls="change-password" aria-selected="false">Change Password</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-picture-tab" data-bs-toggle="tab" data-bs-target="#profile-picture" type="button" role="tab" aria-controls="profile-picture" aria-selected="false">Profile Picture</button>
                </li>
            </ul>
            <div class="tab-content" id="profileTabContent">
                <!-- Basic Information Tab -->
                <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
                    <form action="<?php echo e(route('learner.profile.update')); ?>" method="POST" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="FullName">Full Name:</label>
                                    <input type="text" id="FullName" name="FullName" class="form-control" value="<?php echo e(old('FullName', Auth::user()->FullName ?? null)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Email">Email:</label>
                                    <input type="email" id="Email" name="Email" class="form-control" value="<?php echo e(old('Email', Auth::user()->Email ?? null)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Gender">Gender:</label>
                                    <select id="Gender" name="Gender" class="form-control" required>
                                        <option value="M" <?php echo e(Auth::user()->Gender ?? null == 'Male' ? 'selected' : ''); ?>>Male</option>
                                        <option value="F" <?php echo e(Auth::user()->Gender ?? null == 'Female' ? 'selected' : ''); ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Address">Address:</label>
                                    <input type="text" id="Address" name="Address" class="form-control" value="<?php echo e(old('Address', Auth::user()->Address ?? null)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Phone">Phone:</label>
                                    <input type="text" id="Phone" name="Phone" class="form-control" value="<?php echo e(old('Phone', Auth::user()->Phone ?? null)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Birthday">Birthday:</label>
                                    <input type="date" id="Birthday" name="Birthday" class="form-control" value="<?php echo e(old('Birthday', Auth::user()->Birthday ?? null)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>

                    <style>
                        .form-group {
                            margin-bottom: 15px;
                        }
                        #imagePreview {
                            display: block;
                            margin-bottom: 15px;
                        }
                        .tab-pane {
                            padding-top: 20px;
                        }

                        .nav-tabs .nav-link.active {
                            color: black;
                            border: none;
                            border-bottom: 5px solid #007bff;
                        }
                    </style>
                </div>
                <!-- Change Password Tab -->
                <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                    <form action="<?php echo e(route('user.change.password')); ?>" method="POST" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-group">
                            <label for="current_password">Current Password:</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm New Password:</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
                <!-- Profile Picture Tab -->
                <div class="tab-pane fade" id="profile-picture" role="tabpanel" aria-labelledby="profile-picture-tab">
                    <form action="<?php echo e(route('user.update.profile.picture')); ?>" method="POST" enctype="multipart/form-data" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="form-group">
                            <?php if(Auth::user()->ProfilePicture): ?>
                            <div class="mt-2">
                                <p>Image Preview:</p>
                                <img id="imagePreview" width="300px" src="<?php echo e(Auth::user()->ProfilePicture); ?>" alt="Current Avatar" class="img-thumbnail">
                            </div>
                            <?php else: ?>
                            <div class="mt-2">
                                <p>Image Preview:</p>
                                <img id="imagePreview" width="300px" src="https://www.vietnamworks.com/hrinsider/wp-content/uploads/2023/12/anh-den-ngau.jpeg" alt="Default Avatar" class="img-thumbnail">
                            </div>
                            <?php endif; ?>
                            <label for="ProfilePicture" class="mt-2">Profile Picture:</label>
                            <input type="file" id="ProfilePicture" name="ProfilePicture" class="form-control" style="width: 300px;">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Picture</button>
                    </form>

                </div>
                <style>
                    .form-group {
                        margin-bottom: 15px;
                    }
                    #imagePreview {
                        display: block;
                        margin-bottom: 15px;
                    }
                    .tab-pane {
                        padding-top: 20px;
                    }
                </style>
            </div>
        </div>
    </section>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/edit_profile.blade.php ENDPATH**/ ?>