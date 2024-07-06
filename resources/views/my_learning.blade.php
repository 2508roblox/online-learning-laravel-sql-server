@extends('inc.layout')
@section('content')

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
            <div class="row mb-4" style="align-items: flex-end">
                <div class="col-lg-4">
                    <div class="widget widget-select-inner">
                        <p class="widget-title">Category</p>
                        <div class="input-group mb-3">
                            <select class="form-select" id="categoryFilter" style="
                            height: 42px;
                        ">
                                <option value="all">All</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }} ({{ $category->CourseCount }})</option>
                                @endforeach
                            </select>
                            <button   style="
                            height: 42px;
                             line-height: 100%;
                        " class="btn btn-outline-secondary" type="button" id="clearCategoryFilter">Clear</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="widget widget-select-inner">
                        <p class="widget-title">Level</p>
                        <div class="input-group mb-3">
                            <select class="form-select" id="levelFilter" style="
                            height: 42px;
                        ">
                                <option value="all">All</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="expert">Expert</option>
                            </select>
                            <button  style="
                            height: 42px;
                             line-height: 100%;
                        " class="btn btn-outline-secondary" type="button" id="clearLevelFilter">Clear</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="single-input-wrap">
                        <form action="{{ route('courses.index') }}" method="GET" class="single-input-wrap">
                            <input type="text" name="search" class="form-control" placeholder="Search your best courses" value="{{ $searchParam ?? '' }}">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row" id="course-list">
                    @foreach($courses as $course)
                        <div class="col-xl-3 col-md-6 course-item" data-category="category-{{ $course->CategoryID }}" data-level="level-{{ strtolower($course->Level) }}">
                            <div class="single-course-wrap">
                                <div class="thumb">
                                    <a href="#" class="cat cat-blue">{{ $course->Level }}</a>
                                    <a href="{{ route('course.preview', ['id' => $course->CourseID]) }}">
                                        <img src="{{ asset('client/img/course/1.png') }}" alt="Course Image">
                                    </a>
                                </div>
                                <div class="wrap-details">
                                    <h6><a href="{{ route('course.preview', ['id' => $course->CourseID]) }}">{{ $course->Title }}</a></h6>
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
                                            <div  class="col-6 text-end">
                                                <a   href="{{ route('learning.course', ['course_id' => $course->CourseID]) }}" class="btn btn-primary">Start</a>
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
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryFilter = document.getElementById('categoryFilter');
            const levelFilter = document.getElementById('levelFilter');
            const clearCategoryFilter = document.getElementById('clearCategoryFilter');
            const clearLevelFilter = document.getElementById('clearLevelFilter');
            const courseItems = document.querySelectorAll('.course-item');

            categoryFilter.addEventListener('change', filterCourses);
            levelFilter.addEventListener('change', filterCourses);
            clearCategoryFilter.addEventListener('click', clearCategory);
            clearLevelFilter.addEventListener('click', clearLevel);

            function filterCourses() {
                const selectedCategory = categoryFilter.value;
                const selectedLevel = levelFilter.value;

                courseItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    const itemLevel = item.getAttribute('data-level');

                    const matchesCategory = selectedCategory === 'all' || itemCategory.includes(selectedCategory);
                    const matchesLevel = selectedLevel === 'all' || itemLevel.includes(selectedLevel);

                    if (matchesCategory && matchesLevel) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            function clearCategory() {
                categoryFilter.value = 'all';
                filterCourses();
            }

            function clearLevel() {
                levelFilter.value = 'all';
                filterCourses();
            }
        });
    </script>
@endsection
