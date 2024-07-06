
@extends('inc.layout')
@section('content')





<section class="courses-details-area pd-top-135 pd-bottom-130">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-course-wrap mb-0">
                    <div class="thumb">
                        <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                        <img src="{{asset('client/img/course/video.png')}}" alt="img">
                    </div>
                    <div class="wrap-details">
                        <h5><a href="#">{{ $course[0]->Title }}</a></h5>
                        <p>{{ $course[0]->Description }}</p>
                        <div class="user-area">
                            <div class="user-details">
                                <img src="{{ asset('client/img/author/' . $course[0]->InstructorID . '.png') }}" alt="img">
                                <a href="{{ route('instructor.show', ['id' =>  $course[0]->InstructorID ]) }}">{{ $course[0]->InstructorName }}</a>
                            </div>
                            <div class="date ms-auto">
                                <i class="fa fa-calendar-alt me-2" style="color: var(--main-color);"></i>Last updated {{ \Carbon\Carbon::parse($course[0]->UpdateAt)->format('m/Y') }}
                            </div>
                            <div class="ms-auto">
                                <i class="fa fa-user me-2" style="color: var(--main-color);"></i>{{ $course[0]->EnrolledLearner }} already enrolled
                            </div>
                            <div class="user-rating">
                                <span>
                                    @if ($course[0]->Rating == 0 || $course[0]->Rating == ".00")
                                    0 Rating
                                @else
                                    @for ($i = 0; $i < round($course[0]->Rating); $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    {{ $course[0]->Rating }} Rating
                                @endif
                                </span> ({{ $course[0]->EnrolledLearner }})
                            </div>

                        </div>
                        <div class="buying-wrap d-flex align-items-center">
                            <h2 class="price d-inline-block mb-0">${{ $course[0]->Price }}</h2>
                            <div class="ms-auto d-425-none">
                                <a href="#"><i class="far fa-heart"></i></a>
                                <a class="ms-4" href="#"><i class="fa fa-share me-2"></i>share</a>
                            </div>


                            <a class="btn btn-base ms-auto" href="{{ route('checkout', ['course_id' => $course[0]->CourseID]) }}">Enroll Now </a>
                        </div>
                    </div>
                </div>
                <ul class="course-tab nav nav-pills pd-top-100">
                    <li class="nav-item">
                      <button class="nav-link active" id="pill-1" data-bs-toggle="pill" data-bs-target="#pills-01" type="button" role="tab" aria-controls="pills-01" aria-selected="true">Overview</button>
                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
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
                                                    @if ($item->CurriculumItemType == 'V')
                                                        <a class="play-btn" href="#"><i class="fa fa-play"></i></a>
                                                    @else
                                                        <i class="fa fa-lock"></i>
                                                    @endif
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
                <div class="widget widget-course-details mb-0">
                    <h5 class="widget-title">Course Details</h5>
                    <ul>
                        <li>Level: <span>{{ $course[0]->Level }}</span></li>
                        <li>Categories: <span><a href="#">{{ $course[0]->CategoryName }}</a></span></li>
                        <li>Total Hour: <span>07h 30m</span></li>
                        <li>Total Lessons: <span>{{ count($course) }}</span></li>

                        <li>Total Enrolled: <span>{{ $course[0]->EnrolledLearner }}</span></li>
                        <li>Last Update: <span>{{ \Carbon\Carbon::parse($course[0]->UpdateAt)->format('F d, Y') }}</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>

    @endsection
