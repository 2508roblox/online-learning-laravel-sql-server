@extends('inc.layout')
@section('content')
 <!-- instector-banner Area Start-->
 <div class="instector-banner-area">
</div>
<!-- instector-banner Area End -->

<!-- instructor Area Start-->
<div class="pd-bottom-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="instructor-details-area text-center">
                    <div class="thumb">
                        <img src="{{ $instructorWithCourses[0]->ImageURL }}" alt="Instructor Image">
                    </div>
                    <h3>{{ $instructorWithCourses[0]->InstructorName }}</h3>
                    <p>{{ $instructorWithCourses[0]->InstructorType }}</p>
                    <ul class="social-area d-inline-block">
                        <li><a href="#"><i class="fas fa-globe-asia"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                    <ul class="achivement-fact">
                        <li class="ratting">
                            <div class="icon">
                                <img src="{{ asset('client/img/icon/star.png') }}" alt="img">
                            </div>
                            <h5 class="counter">{{ $instructorWithCourses[0]->Rating }}</h5>
                            <p>Ratings</p>
                        </li>
                        <li class="students">
                            <div class="icon">
                                <img src="{{ asset('client/img/icon/user.png') }}" alt="img">
                            </div>
                            <h5 class="counter">{{ $instructorWithCourses[0]->EnrolledLearner }}</h5>
                            <p>Students Learning</p>
                        </li>
                        <li class="courses">
                            <div class="icon">
                                <img src="{{ asset('client/img/icon/book.png') }}" alt="img">
                            </div>
                            <h5 class="counter">{{ count($instructorWithCourses) }}</h5>
                            <p>Courses</p>
                        </li>
                    </ul>
                    <div class="text-start px-30">
                        <h5>About Me</h5>
                        <p>{{ $instructorWithCourses[0]->InstructorResume }}</p>
                    </div>
                    <div class="education-qualification">
                        <h5>Education</h5>
                        <ul>
                            @foreach (json_decode($instructorWithCourses[0]->InstructorDegrees, true) as $degree)
                                <li>{{ $degree }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="text-start px-30">
                        <h5>Scientific Background</h5>
                        @foreach (json_decode($instructorWithCourses[0]->InstructorScientificBackground, true) as $field)
                        <li>{{ $field }}</li>
                    @endforeach
                    </div>
                    <div class="text-start px-30">
                        <h5>Workplace</h5>
                        <p>{{ $instructorWithCourses[0]->InstructorWorkplace }}</p>
                    </div>


                </div>
            </div>
            <div class="col-lg-8">
                <ul class="nav instructor-nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Course List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Reviews</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row" id="course-list">
                            @foreach($instructorWithCourses as $course)
                            <div class="col-md-6">
                                <div class="single-course-wrap">
                                    <div class="thumb">
                                        <a href="#" class="cat cat-blue">{{ $course->Level }}</a>
                                        <img src="{{ $course->ImageURL }}" alt="Course Image">
                                    </div>
                                    <div class="wrap-details">
                                        <h6><a href="#">{{ $course->CourseTitle }}</a></h6>
                                        <div class="user-area">
                                            <div class="user-details">
                                                <img src="{{ asset('client/img/author/1.png') }}" alt="Instructor Image">
                                                <a href="#">{{ $course->InstructorName }}</a>
                                            </div>
                                            <div class="user-rating">
                                                <span>
                                                    @for ($i = 0; $i < floor($course->Rating); $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                    @if ($course->Rating - floor($course->Rating) > 0)
                                                        <i class="fa fa-star-half-alt"></i>
                                                    @endif
                                                    ({{ $course->EnrolledLearner }})
                                                </span>
                                            </div>
                                        </div>
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <a href="#">{{ $course->CategoryName }}</a>
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
                        <div id="pagination" style="
                        display: flex;
                        justify-content: end;
                    ">

                        </div>
<style>
    /* Phân trang */
#pagination {
    margin-top: 20px;
}

#pagination .page-item {
    display: inline-block;
    margin-right: 5px;
}

#pagination .page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: default;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

#pagination .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}

#pagination .page-link {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

#pagination .page-link:hover {
    z-index: 2;
    color: #0056b3;
    text-decoration: none;
    background-color: #e9ecef;
    border-color: #dee2e6;
}

#pagination .page-link:focus {
    z-index: 3;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

</style>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                            <script>
    $(document).ready(function() {
        // Initialize variables
        var courses = @json($instructorWithCourses); // Assuming $instructorWithCourses is already JSON encoded in PHP

        var currentPage = 1;
        var coursesPerPage = 4; // Number of courses per page
        var totalPages = Math.ceil(courses.length / coursesPerPage);

        // Function to display courses for the current page
        function displayCourses(page) {
            $("#course-list").empty();
            var startIndex = (page - 1) * coursesPerPage;
            var endIndex = startIndex + coursesPerPage;
            var paginatedCourses = courses.slice(startIndex, endIndex);

            paginatedCourses.forEach(function(course) {
                var courseHtml = `
                    <div class="col-md-6">
                        <div class="single-course-wrap">
                            <div class="thumb">
                                <a href="#" class="cat cat-blue">${course.Level}</a>
                                <img src="${course.ImageURL}" alt="Course Image">
                            </div>
                            <div class="wrap-details">
                                <h6><a href="#">${course.CourseTitle}</a></h6>
                                <div class="user-area">
                                    <div class="user-details">
                                        <img src="{{ asset('client/img/author/1.png') }}" alt="Instructor Image">
                                        <a href="#">${course.InstructorName}</a>
                                    </div>
                                    <div class="user-rating">
                                        <span>
                                            ${getStarsHtml(course.Rating)}
                                            (${course.EnrolledLearner})
                                        </span>
                                    </div>
                                </div>
                                <div class="price-wrap">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <a href="#">${course.CategoryName}</a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="price">$${course.Price}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $("#course-list").append(courseHtml);
            });
        }

        // Function to generate star icons based on rating
        function getStarsHtml(rating) {
            var fullStars = Math.floor(rating);
            var halfStar = rating - fullStars >= 0.5 ? '<i class="fa fa-star-half-alt"></i>' : '';
            var starsHtml = '';
            for (var i = 0; i < fullStars; i++) {
                starsHtml += '<i class="fa fa-star"></i>';
            }
            starsHtml += halfStar;
            return starsHtml;
        }

        // Initial display on page load
        displayCourses(currentPage);

        // Function to render pagination links
        function renderPagination() {
            $("#pagination").empty();
            for (var i = 1; i <= totalPages; i++) {
                var pageLink = `<a href="#" class="page-link" data-page="${i}">${i}</a>`;
                $("#pagination").append(pageLink);
            }
        }

        // Initial render of pagination links
        renderPagination();

        // Event listener for pagination links
        $(document).on("click", ".page-link", function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).attr("data-page"));
            displayCourses(currentPage);
        });
    });
</script>

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="single-course-wrap">
                                    <div class="thumb">
                                        <a href="#" class="cat cat-blue">Beginner</a>
                                        <img src="{{asset('client/img/course/5.png')}}" alt="img">
                                    </div>
                                    <div class="wrap-details">
                                        <h6><a href="#">Best way learn fundamentals of design thinking.</a></h6>
                                        <div class="user-area">
                                            <div class="user-details">
                                                <img src="{{asset('client/img/author/1.png')}}" alt="img">
                                                <a href="#">Jessica Jessy</a>
                                            </div>
                                            <div class="user-rating">
                                                <span><i class="fa fa-star"></i>
                                                    4.9</span>(76)
                                            </div>
                                        </div>
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <a href="#">UX Design</a>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <div class="price">$30</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single-course-wrap">
                                    <div class="thumb">
                                        <a href="#" class="cat cat-blue">Beginner</a>
                                        <img src="{{asset('client/img/course/4.png')}}" alt="img">
                                    </div>
                                    <div class="wrap-details">
                                        <h6><a href="#">About latest tips news and course for Illustration 2021</a></h6>
                                        <div class="user-area">
                                            <div class="user-details">
                                                <img src="{{asset('client/img/author/1.png')}}" alt="img">
                                                <a href="#">Jessica Jessy</a>
                                            </div>
                                            <div class="user-rating">
                                                <span><i class="fa fa-star"></i>
                                                    4.9</span>(76)
                                            </div>
                                        </div>
                                        <div class="price-wrap">
                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <a href="#">Video Editing</a>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <div class="price">$30</div>
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
        <div class="row justify-content-center pd-top-120">
            <div class="col-lg-4 col-sm-6">
                <div class="single-intro-wrap-2">
                    <div class="thumb">
                        <img src="{{asset('client/img/intro/01.png')}}" alt="img">
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
                        <img src="{{asset('client/img/intro/02.png')}}" alt="img">
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
                        <img src="{{asset('client/img/intro/03.png')}}" alt="img">
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
<!-- instructor Area End -->

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
                                    <img src="{{asset('client/img/about/1.png')}}" alt="img">
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
                                    <img src="{{asset('client/img/about/1.png')}}" alt="img">
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
                                    <img src="{{asset('client/img/about/1.png')}}" alt="img">
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
                                <img src="{{asset('client/img/quote.png"')}} alt="img">
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
                                <img src="{{asset('client/img/quote.png"')}} alt="img">
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
                                <img src="{{asset('client/img/quote.png"')}} alt="img">
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
                                <img src="{{asset('client/img/quote.png"')}} alt="img">
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
<!-- cta Area End -->

<!-- footer area start -->
<footer class="footer-area">
    <div class="footer-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-4 col-sm-6">
                    <div class="footer-widget widget widget_link">
                        <h4 class="widget-title">Categories</h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="pe-5">
                                    <li><a href="category.html">Development</a></li>
                                    <li><a href="category.html">Business</a></li>
                                    <li><a href="category.html">Finance & Accounting</a></li>
                                    <li><a href="category.html">IT & Software</a></li>
                                    <li><a href="category.html">Office Productivity</a></li>
                                    <li><a href="category.html">Design</a></li>
                                    <li><a href="category.html">Marketing</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul class="pe-5">
                                    <li><a href="category.html">Lifiestyle</a></li>
                                    <li><a href="category.html">Photography & Video</a></li>
                                    <li><a href="category.html">Health & Fitness</a></li>
                                    <li><a href="category.html">Music</a></li>
                                    <li><a href="category.html">UX Design</a></li>
                                    <li><a href="category.html">Seo</a></li>
                                    <li><a href="category.html">Business Analysis and Strategy</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-4">
                                <ul>
                                    <li><a href="category.html">Customer Service</a></li>
                                    <li><a href="category.html">Human Resources</a></li>
                                    <li><a href="category.html">Leadership and Management
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget widget widget_link">
                        <h4 class="widget-title">Link</h4>
                        <ul class="pe-4">
                            <li><a href="blog.html">News & Blogs
                            </a></li>
                            <li><a href="blog-cat.html">Blog Category</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                            <li><a href="course.html">Course</a></li>
                            <li><a href="course-details.html">Course Details</a></li>
                            <li><a href="instructor.html">Instructor</a></li>
                            <li><a href="instructor-details.html">Instructor Details</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="footer-widget widget widget_link">
                        <h4 class="widget-title">Support</h4>
                        <ul class="pe-4">
                            <li><a href="home.html">Documentation</a></li>
                            <li><a href="faq.html">FAQS</a></li>
                            <li><a href="dashboard.html">Dashboard</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
