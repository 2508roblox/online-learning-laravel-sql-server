
@extends('inc.layout')
@section('content')





    <!-- breabcrumb Area Start-->
    <section class="breadcrumb-area" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Courses</a></li>

                        <li class="breadcrumb-item active" aria-current="page">{{ $category[0]->Name }}</li>
                    </ul>
                    <h2>{{ $category[0]->Name }} Course</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- breabcrumb Area End -->

    <section class="enllor-courses-area pd-top-120 pd-bottom-140">
        <div class="container">

@foreach ($structuredCourses as $subcategoryID => $subcategory)
<div class="row">
    <div class="col-lg-12">
        <div class="section-title">
            <h2>{{ $subcategory['SubcategoryName'] }}</h2>
        </div>
    </div>
    <div class="col-lg-12">
        <ul class="edl-nav nav nav-pills">
            @foreach ($subcategory['Topics'] as $topicID => $topic)
                <li class="nav-item">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $topicID }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $topicID }}">{{ $topic['TopicName'] }}</button>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach ($subcategory['Topics'] as $topicID => $topic)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pills-{{ $topicID }}">
                    <div class="course-slider owl-carousel">
                        @foreach ($topic['Courses'] as $course)
                        <div class="item">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="#" class="cat cat-blue">{{ $course->Level }}</a>
                                    <a href="{{ route('course.preview', ['id' => $course->CourseID]) }}">
                                        <img src="{{ asset('storage/'. $course->ImageURL) }}" alt="img">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="{{ route('course.preview', ['id' => $course->CourseID]) }}">{{ $course->CourseTitle }}</a></h6>
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
                    @endforeach

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endforeach
        </div>
    </section>

    @endsection
