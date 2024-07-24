<?php $__env->startSection('content'); ?>

    <!-- Banner Area Start-->
    <section class="banner-area instructor-banner p-0" style="background-color: #11142D;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-8">
                    <div class="thumb">
                        <img src="<?php echo e(asset('client/img/instructor.png')); ?>" alt="img">
                    </div>
                </div>
                <div class="col-md-7 col-sm-10 align-self-center">
                    <div class="banner-inner text-md-start text-center">
                        <h1 class="text-white">Make a global impact</h1>
                        <div class="banner-content me-0">
                            <p class="text-white">Create an online video course and earn money by teaching people around the world.</p>
                        </div>
                        <a class="btn btn-base" href="<?php echo e(route('instructor.register')); ?>">Become an Instructor</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- intro Area Start-->
    <div class="text-center pd-top-135 pd-bottom-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Discover your potential</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet .</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="<?php echo e(asset('client/img/intro/01.')); ?>png" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Earn money</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="<?php echo e(asset('client/img/intro/02.')); ?>png" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Inspire students</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-intro-wrap-2">
                        <div class="thumb">
                            <img src="<?php echo e(asset('client/img/intro/03.')); ?>png" alt="img">
                        </div>
                        <div class="wrap-details">
                            <h4><a href="#">Join our community</a></h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dui praesent nam fermentum, est neque, dignissim. Phasellus feugiat elit vulputate convallis.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- intro Area End -->

    <!-- fact Area Start-->
    <div class="text-center pd-top-135 pd-bottom-115" style="background: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2>Exceptional opportunities</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet .</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-fact-wrap">
                        <div class="fact-count">
                            <h3><span class="counter">35</span>m</h3>
                        </div>
                        <div class="wrap-details">
                            <p>Students worldwide</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-fact-wrap">
                        <div class="fact-count">
                            <h3><span class="counter">65</span>+</h3>
                        </div>
                        <div class="wrap-details">
                            <p>Different languages</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-fact-wrap">
                        <div class="fact-count">
                            <h3><span class="counter">400</span>m</h3>
                        </div>
                        <div class="wrap-details">
                            <p>Course enrollments</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-fact-wrap">
                        <div class="fact-count">
                            <h3><span class="counter">180</span>+</h3>
                        </div>
                        <div class="wrap-details">
                            <p>Countries taught</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fact Area End -->

    <!-- potential Area Start-->
    <div class="potential-area pd-top-135 pd-bottom-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Discover your potential</h2>
                        <ul class="potential-nav nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Plan your course</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Record your video</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Build your community</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-lg-6 align-self-center">
                                    <div class="potential-wrap">
                                        <h3>Record your video</h3>
                                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio velit elit, mattis sit pellentesque. Eu blandit velit viverra ut. Bibendum in molestie odio suspendisse neque, tortor sem vestibulum a. Varius mauris scelerisque cursus et vel ut urna. Dignissim mi quis et sagittis, dolor fermentum non scelerisque. Adipiscing proin eu orci vitae tristique magna nulla amet sit.</p>
                                        <p>In leo ut ut mauris scelerisque ullamcorper laoreet pharetra. Mattis vestibulum lobortis tristique bibendum. Id turpis nibh nulla ac eget convallis id fringilla volutpat. Pretium sed morbi blandit odio in. Arcu pulvinar eget faucibus amet non in. Pulvinar orci, iaculis amet elit, odio. Cursus amet, sed volutpat ridiculus ullamcorper pellentesque.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 align-self-center">
                                    <div class="thumb">
                                        <img src="<?php echo e(asset('client/img/about/1.')); ?>png" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="potential-wrap">
                                        <h3>Record your video</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio velit elit, mattis sit pellentesque. Eu blandit velit viverra ut. Bibendum in molestie odio suspendisse neque, tortor sem vestibulum a. Varius mauris scelerisque cursus et vel ut urna. Dignissim mi quis et sagittis, dolor fermentum non scelerisque. Adipiscing proin eu orci vitae tristique magna nulla amet sit.</p>
                                        <p>In leo ut ut mauris scelerisque ullamcorper laoreet pharetra. Mattis vestibulum lobortis tristique bibendum. Id turpis nibh nulla ac eget convallis id fringilla volutpat. Pretium sed morbi blandit odio in. Arcu pulvinar eget faucibus amet non in. Pulvinar orci, iaculis amet elit, odio. Cursus amet, sed volutpat ridiculus ullamcorper pellentesque.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="thumb">
                                        <img src="<?php echo e(asset('client/img/about/1.')); ?>png" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="potential-wrap">
                                        <h3>Record your video</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Odio velit elit, mattis sit pellentesque. Eu blandit velit viverra ut. Bibendum in molestie odio suspendisse neque, tortor sem vestibulum a. Varius mauris scelerisque cursus et vel ut urna. Dignissim mi quis et sagittis, dolor fermentum non scelerisque. Adipiscing proin eu orci vitae tristique magna nulla amet sit.</p>
                                        <p>In leo ut ut mauris scelerisque ullamcorper laoreet pharetra. Mattis vestibulum lobortis tristique bibendum. Id turpis nibh nulla ac eget convallis id fringilla volutpat. Pretium sed morbi blandit odio in. Arcu pulvinar eget faucibus amet non in. Pulvinar orci, iaculis amet elit, odio. Cursus amet, sed volutpat ridiculus ullamcorper pellentesque.</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="thumb">
                                        <img src="<?php echo e(asset('client/img/about/1.')); ?>png" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- potential Area End -->

    <!-- testimonial courses Area Start-->
    <section class="testimonial-courses-area pd-bottom-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>People <i style="color: var(--main-color);" class="fa fa-heart"></i> Edufie</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="testimonial-slider owl-carousel">
                        <div class="item">
                            <div class="single-testimonial-wrap">
                                <div class="thumb">
                                    <img src="<?php echo e(asset('client/img/quote.png')); ?>" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap">
                                <div class="thumb">
                                    <img src="<?php echo e(asset('client/img/quote.png')); ?>" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap">
                                <div class="thumb">
                                    <img src="<?php echo e(asset('client/img/quote.png')); ?>" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="single-testimonial-wrap">
                                <div class="thumb">
                                    <img src="<?php echo e(asset('client/img/quote.png')); ?>" alt="img">
                                </div>
                                <div class="wrap-details">
                                    <h5><a href="#">Super fast WordPress themes</a></h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Velit placerat sit feugiat ornare tortor arcu, euismod pellentesque porta. Lacus, semper congue consequat, potenti suspendisse luctus cras vel.</p>
                                    <span>- Jessica Jessy</span>
                                    <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial courses Area End -->

    <!-- cta Area Start-->
    <div class="cta-area text-center pd-top-70 pd-bottom-80" style="background: var(--main-color);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-wrap">
                        <h2>Become an instructor today</h2>
                        <h5>Join the world's largest online learning marketplace.</h5>
                        <a class="btn btn-white" href="#">Become an Instrucotor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('inc.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\trang\OneDrive\Máy tính\2m\online_learning\resources\views/instructor_introduction.blade.php ENDPATH**/ ?>