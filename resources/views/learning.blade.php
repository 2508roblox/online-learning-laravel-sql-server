<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edufie - Online Courses Html Template</title>
    <!--fivicon icon-->
    <link rel="icon" href="{{ asset('client/img/fevicon.png') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('client/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/magnific.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/slick-slide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/responsive.css') }}">
    <style>
        body, html {
            height: 100%;
        }
        .courses-details-area {
            min-height: 100%;
            display: flex;
            align-items: stretch;
        }
        .col-lg-8 {
            flex: 0 0 70%;
            max-width: 70%;
            height: 100%;
            overflow-y: auto; /* Enable scrolling if content exceeds height */
            position: sticky;
            top: 0;
            padding-right: 15px; /* Offset scrollbar width */
        }
        .sidebar-area {
            flex: 0 0 30%;
            max-width: 30%;
            height: 100%;
            position: sticky;
            top: 0;
            padding-left: 15px; /* Offset scrollbar width */
        }
    </style>
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class='sc5'>
    <!-- preloader area start -->

    <!-- preloader area end -->
    <div class="body-overlay" id="body-overlay"></div>

    <!-- search popup area start -->
    <div class="search-popup" id="search-popup">
        <form action="home.html" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search.....">
            </div>
            <button type="submit" class="submit-btn"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <!-- //. search Popup -->


    <section class="courses-details-area">
        <div class=" " style="width: 100%">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single-course-wrap mb-0">
                        <div class="thumb">
                            <video controls style="
                            width: 100%;
                        ">
                                <source src="{{ asset('client/video/test.mkv') }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>

                    </div>
                    <ul class="course-tab nav nav-pills pt-5 px-5">
                        <!-- Overview tab (active by default) -->
                        <li class="nav-item">
                            <button class="nav-link active" id="pill-1" data-bs-toggle="pill" data-bs-target="#pills-01" type="button" role="tab" aria-controls="pills-01" aria-selected="true">Overview</button>
                        </li>
                        <!-- Your additional tabs -->
                        <li class="nav-item">
                            <button class="nav-link" id="pill-2" data-bs-toggle="pill" data-bs-target="#pills-02" type="button" role="tab" aria-controls="pills-02" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-3" data-bs-toggle="pill" data-bs-target="#pills-03" type="button" role="tab" aria-controls="pills-03" aria-selected="false">Announcements</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-4" data-bs-toggle="pill" data-bs-target="#pills-04" type="button" role="tab" aria-controls="pills-04" aria-selected="false">Reviews</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pill-5" data-bs-toggle="pill" data-bs-target="#pills-05" type="button" role="tab" aria-controls="pills-05" aria-selected="false">Learning tools</button>
                        </li>
                    </ul>
                    <div class="tab-content p-5 pt-1" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-01" role="tabpanel" aria-labelledby="pill-1">
                            <div class="overview-area">
                                <h5>Course details</h5>
                                <p>{{ $course[0]->Description }}</p>
                                <div class="bg-gray">
                                    <h6>What Will I Learn?</h6>
                                    @if (!is_null($course[0]->LearningObjective))
                                        @php
                                            $learningObjectives = json_decode($course[0]->LearningObjective, true);
                                        @endphp
                                        @if (!is_null($learningObjectives))
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul>
                                                        @foreach($learningObjectives as $key => $objective)
                                                            @if($loop->index % 2 == 0)
                                                                <li><i class="fa fa-check"></i>{{ $objective }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul>
                                                        @foreach($learningObjectives as $key => $objective)
                                                            @if($loop->index % 2 != 0)
                                                                <li><i class="fa fa-check"></i>{{ $objective }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <p>No learning objectives available.</p>
                                        @endif
                                    @else
                                        <p>No data available.</p>
                                    @endif
                                </div>

                                <h6>Requirements</h6>
                                <ul>
                                    @php
                                        $requirements = json_decode($course[0]->Requirement, true);
                                    @endphp
                                    @if (!is_null($requirements))
                                        @foreach($requirements as $key => $requirement)
                                            <li><i class="fa fa-check"></i>{{ $requirement }}</li>
                                        @endforeach
                                    @else
                                        <li>No requirements listed.</li>
                                    @endif
                                </ul>

                                <h6 class="mt-5">Skills covered in this course</h6>
                                <ul>
                                    @php
                                        $intendedLearners = json_decode($course[0]->IntendedLearner, true);
                                    @endphp
                                    @if (!is_null($intendedLearners))
                                        @foreach($intendedLearners as $key => $intendedLearner)
                                            <li><i class="fa fa-check"></i>{{ $intendedLearner }}</li>
                                        @endforeach
                                    @else
                                        <li>No intended learners specified.</li>
                                    @endif
                                </ul>



                        </div>
                        </div>
                        <div class="tab-pane fade" id="pills-02" role="tabpanel" aria-labelledby="pill-2">...</div>
                        <div class="tab-pane fade" id="pills-03" role="tabpanel" aria-labelledby="pill-3">...</div>
                    </div>
                </div>
                <div class="col-lg-4 sidebar-area">
                    <div class="widget widget-accordion-inner">
                        <h5 class="widget-title border-0">Course Syllabus</h5>
                        <div class="accordion" id="accordionExample">
                            @php
                                $sections = collect($course)->groupBy('SectionID');
                            @endphp
                            @foreach($sections as $sectionID => $sectionItems)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $sectionID }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $sectionID }}" aria-expanded="false" aria-controls="collapse{{ $sectionID }}">
                                            {{ $sectionItems->first()->SectionTitle }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $sectionID }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $sectionID }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul>
                                                @foreach($sectionItems as $item)

                                                    <li>
                                                        <a   href="index.html" >
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                        <span>
                                                            <p>{{ $item->CurriculumItemTitle }}</p>
                                                            <span>
                                                                @if ($item->CurriculumItemType == 'Q')
                                                                    Quiz
                                                                @elseif ($item->CurriculumItemType == 'A')
                                                                    Assignment
                                                                @elseif ($item->CurriculumItemType == 'V')
                                                                    Video
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>

<style>
    /* CSS */
.play-btn {
    transition: transform 0.3s ease-in-out;
}

.play-btn:hover {
    transform: scale(1.1); /* Scale up on hover */
}

</style>
<!-- all plugins here -->
<script src="{{ asset('client/js/jquery.3.6.min.js') }}"></script>
<script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('client/js/imageloded.min.js') }}"></script>
<script src="{{ asset('client/js/counterup.js') }}"></script>
<script src="{{ asset('client/js/waypoint.js') }}"></script>
<script src="{{ asset('client/js/magnific.min.js') }}"></script>
<script src="{{ asset('client/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('client/js/nice-select.min.js') }}"></script>
<script src="{{ asset('client/js/fontawesome.min.js') }}"></script>
<script src="{{ asset('client/js/ripple.js') }}"></script>
<script src="{{ asset('client/js/owl.min.js') }}"></script>
<script src="{{ asset('client/js/slick-slider.min.js') }}"></script>
<script src="{{ asset('client/js/wow.min.js') }}"></script>
<!-- main js  -->
<script src="{{ asset('client/js/main.js') }}"></script>
<script>
    $(document).ready(function(){
    $('.course-slider').owlCarousel({
        loop:false,
        autoplay:true,
        autoplayTimeout:1000,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    })
});

</script>
</body>
</html>
