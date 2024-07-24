
@extends('instructor.inc.layout')
@section('content')




<section class="admin-dashboard-section">
    <div class="admin-dashboard-right-side">
        <!-- top header start  -->
        <div class="main-header">
            <div class="header-wraper">
                <div class="row">
                    <div class="col-xl-6">
                        <span class="header-user">
                            <a href="#"><img src="{{asset('instructor/img/author/02.png')}}" alt="img"></a>
                            <span>Hello,
                                <h5>Ramjan Ali Anik</h5>
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
        <div class="dashboard-course-area">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="dashboard-title">My Enrolled Courses</h5>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"> All Courses </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"> Active Courses </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Completed Courses </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        @foreach ($courses as $course)
                        <div class="col-lg-6 mb-4">
                            <div class="single-course-wrap media">
                                <div class="thumb" style="background-image: url('{{ url('storage/'. $course->ImageURL ) }}');">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">{{ $course->Title }}</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{ asset('instructor/img/author/1.png') }}" alt="img">
                                            <a href="#">{{ $course->InstructorName }}</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i> {{ $course->Rating > 0 ? number_format($course->Rating, 2) : '0.00' }}</span> ({{ $course->EnrolledLearner }})
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <div class="row align-items-center">
                                            <div class="col-5">
                                                <span>Total Lessons: <span>{{ $course->LessonCount }}</span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                        <style>
                                            .btn-icon {
                                                width: 100px;
                                                height: 40px; /* Adjust height as needed */
                                                padding: 5px;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                            }
                                            .btn-icon i {
                                                font-size: 1.2rem; /* Adjust icon size as needed */
                                            }
                                        </style>

                                        <!-- Icon for editing course -->
                                        <a href="{{ route('instructor.courses.edit', $course->CourseID) }}" class="btn btn-primary btn-icon me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Icon for creating curriculum -->
                                        <a href="{{ route('instructor.courses.curriculum.create', $course->CourseID) }}" class="btn btn-success btn-icon me-2">
                                            <i class="fas fa-list"></i> <!-- List icon for creating curriculum -->
                                        </a>

                                        <!-- Form for deleting course -->
                                        <form action="{{ route('instructor.courses.destroy', $course->CourseID) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-course-wrap media">
                                <div class="thumb" style="background-image: url({{asset('instructor/img/lesson/3.png')}});">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{asset('instructor/img/author/1.png')}}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i>
                                                4.9</span>(76)
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <div class="row align-items-center">
                                            <div class="col-5">
                                                <span>Total Lessons: <span>8</span></span>
                                            </div>
                                            <div class="col-7 text-end">
                                                <span>Completed Lessons: <span>1 / 8</span></span>
                                            </div>
                                        </div>
                                        <div class="progress-bg">
                                            <div id="progress-7" class="progress-rate" data-value="13">
                                                <div class="progress-count-wrap">
                                                    <span class="progress-count counting" data-count="13">0</span>
                                                    <span class="counting-icons">% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-course-wrap media">
                                <div class="thumb" style="background-image: url({{asset('instructor/img/lesson/3.png')}});">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{asset('instructor/img/author/1.png')}}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i>
                                                4.9</span>(76)
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <div class="row align-items-center">
                                            <div class="col-5">
                                                <span>Total Lessons: <span>8</span></span>
                                            </div>
                                            <div class="col-7 text-end">
                                                <span>Completed Lessons: <span>1 / 8</span></span>
                                            </div>
                                        </div>
                                        <div class="progress-bg">
                                            <div id="progress-8" class="progress-rate" data-value="13">
                                                <div class="progress-count-wrap">
                                                    <span class="progress-count counting" data-count="13">0</span>
                                                    <span class="counting-icons">% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-course-wrap media">
                                <div class="thumb" style="background-image: url({{asset('instructor/img/lesson/3.png')}});">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{asset('instructor/img/author/1.png')}}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i>
                                                4.9</span>(76)
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <div class="row align-items-center">
                                            <div class="col-5">
                                                <span>Total Lessons: <span>8</span></span>
                                            </div>
                                            <div class="col-7 text-end">
                                                <span>Completed Lessons: <span>1 / 8</span></span>
                                            </div>
                                        </div>
                                        <div class="progress-bg">
                                            <div id="progress-9" class="progress-rate" data-value="13">
                                                <div class="progress-count-wrap">
                                                    <span class="progress-count counting" data-count="13">0</span>
                                                    <span class="counting-icons">% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-course-wrap media">
                                <div class="thumb" style="background-image: url({{asset('instructor/img/lesson/3.png')}});">
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="#">PHP for Beginners - Become a PHP Master - CMS Project</a></h6>
                                    <div class="user-area">
                                        <div class="user-details">
                                            <img src="{{asset('instructor/img/author/1.png')}}" alt="img">
                                            <a href="#">Jessica Jessy</a>
                                        </div>
                                        <div class="user-rating">
                                            <span><i class="fa fa-star"></i>
                                                4.9</span>(76)
                                        </div>
                                    </div>
                                    <div class="progress-item">
                                        <div class="row align-items-center">
                                            <div class="col-5">
                                                <span>Total Lessons: <span>8</span></span>
                                            </div>
                                            <div class="col-7 text-end">
                                                <span>Completed Lessons: <span>1 / 8</span></span>
                                            </div>
                                        </div>
                                        <div class="progress-bg">
                                            <div id="progress-10" class="progress-rate" data-value="13">
                                                <div class="progress-count-wrap">
                                                    <span class="progress-count counting" data-count="13">0</span>
                                                    <span class="counting-icons">% Complete</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard-left-menu start  -->
    @include('instructor.inc.sidebar')

</section>


    @endsection
