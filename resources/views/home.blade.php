
@extends('inc.layout')
@section('content')





<!-- Banner Area Start-->
<section class="banner-area" style="background-image: url('{{ asset('client/img/banner/0.jpg') }}');">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 align-self-center">
                <div class="banner-inner text-md-start text-center">
                    <h1>Find the Best <span>Courses</span>  & Upgrade <span>Your Skills.</span></h1>
                    <div class="banner-content">
                        <p>Edufie offers professional training classes and special features to help you improve your skills.</p>
                    </div>
                    <div class="single-input-wrap">
                        <form action="{{ route('courses.index') }}" method="GET" class="single-input-wrap">
                            <input type="text" name="search" placeholder="Search your best courses" value="{{ $searchParam ?? '' }}">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<!-- intro Area Start-->
<div class="container">
    <div class="intro-area">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-6">
                <div class="single-intro-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/1')}}.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h6><a href="#">130,000 online courses</a></h6>
                        <p>Enjoy a variety of fresh topics</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-intro-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/2')}}.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h6><a href="#">Expert instruction</a></h6>
                        <p>Enjoy a variety of fresh topics</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-intro-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/3')}}.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h6><a href="#">Lifetime access</a></h6>
                        <p>Learn on your schedule</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-intro-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/1')}}.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h6><a href="#">130,000 online courses</a></h6>
                        <p>Enjoy a variety of fresh topics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- intro Area End -->

<!-- trending courses Area Start-->
<section class="trending-courses-area pd-top-135 pd-bottom-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Most Trending Courses</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="edl-nav nav nav-pills">
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $category->CategoryID }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $category->CategoryID }}">{{ $category->CategoryName }}</button>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($categories as $category)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $category->CategoryID }}">
                        <div class="course-slider owl-carousel">
                            @foreach($courses as $course)
                                @if ($course->CategoryID == $category->CategoryID)
                                <div class="item">
                                    <div class="single-course-wrap">
                                        <div class="thumb">
                                            <a href="#" class="cat cat-blue">{{ $course->Level }}</a>
                                            <img src="{{ $course->ImageURL }}" alt="img">
                                        </div>
                                        <div class="wrap-details">
                                            <h6><a href="#">{{ $course->Title }}</a></h6>
                                            <div class="user-area">
                                                <div class="user-details">
                                                    <img src="{{ asset('client/img/author/' . $course->InstructorID . '.png') }}" alt="img">
                                                    <a href="{{ route('instructor.show', ['id' =>  $course->InstructorID ]) }}">Jessica Jessy</a>
                                                </div>
                                                <div class="user-rating">
                                                    <span><i class="fa fa-star"></i> {{ $course->Rating }}</span> ({{ $course->EnrolledLearner }})
                                                </div>
                                            </div>
                                            <div class="price-wrap">
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <a href="#">Development</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <div class="price">${{ $course->Price }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
</section>
<!-- trending courses Area End -->

<!-- service Area Start-->
<section class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">
                    <h2>Find the right course</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in eget phasellus dui tincidunt nascetur nisl nunc consequat. Arcu ultricies pulvinar enim vulputate.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="category-service">
                    @foreach($categories as $category)
                    <div class="item">
                        <div class="single-service-wrap">
                            <h6>{{ $category->CategoryName }}</h6>
                            <p>{{ $category->CourseCount }} Course Available</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- service Area End -->

<!-- enllor courses Area Start-->
<section class="enllor-courses-area pd-top-120 pd-bottom-140">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Most Students Enllor</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <ul class="edl-nav nav nav-pills">
                    <li class="nav-item">
                        <button class="nav-link active" id="pills-7-tab" data-bs-toggle="pill" data-bs-target="#pills-7">All Course</button>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-7">
                        <div class="course-slider owl-carousel">
                            @foreach($courses as $course)
                            <div class="item">
                                <div class="single-course-wrap">
                                    <div class="thumb">
                                        <a href="#" class="cat cat-blue">{{ $course->Level }}</a>
                                        <img src="{{  $course->ImageURL   }}" alt="img">
                                    </div>
                                    <div class="wrap-details">
                                        <h6><a href="#">{{ $course->Title }}</a></h6>
                                        <div class="user-area">
                                            <div class="user-details">
                                                <img src="{{ asset('client/img/author/' . $course->InstructorID . '.png') }}" alt="img">
                                                <a href="#">Jessica Jessy</a>
                                            </div>
                                            <div class="user-rating">
                                                <span><i class="fa fa-star"></i> {{ $course->Rating }}</span> ({{ $course->EnrolledLearner }})
                                            </div>
                                        </div>
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <a href="#">Development</a>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <div class="price">${{ $course->Price }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- enllor courses Area End -->


<!-- client Area Start-->
<section class="client-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="client-slider owl-carousel">
                    <div class="item">
                        <img src="{{asset('client/img/client/1')}}.png" alt="img">
                    </div>
                    <div class="item">
                        <img src="{{asset('client/img/client/2')}}.png" alt="img">
                    </div>
                    <div class="item">
                        <img src="{{asset('client/img/client/3')}}.png" alt="img">
                    </div>
                    <div class="item">
                        <img src="{{asset('client/img/client/4')}}.png" alt="img">
                    </div>
                    <div class="item">
                        <img src="{{asset('client/img/client/5')}}.png" alt="img">
                    </div>
                    <div class="item">
                        <img src="{{asset('client/img/client/6')}}.png" alt="img">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- client Area End -->

<!-- about Area Start-->
<section class="about-area pd-top-150 pd-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="single-about-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/video')}}-player.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h3><a href="#">Become a trainer</a></h3>
                        <p>Our courses are built with keeping all levels of users in mind. Learn from industry experts and open up a whole new series of possibilities.</p>
                        <a class="btn btn-base-light-border href="#">Resignation</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-about-wrap">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/brain')}}.png" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h3><a href="#">Become a Student</a></h3>
                        <p>Our courses are built with keeping all levels of users in mind. Learn from industry experts and open up a whole new series of possibilities.</p>
                        <a class="btn btn-base-light-border href="#">Resignation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about Area End -->
@endsection
