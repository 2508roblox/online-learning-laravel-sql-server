
@extends('instructor.inc.layout')
@section('content')






    <section class="enllor-courses-area pd-top-10 pd-bottom-140">
        <div class="container">

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
                    <div class="dashboard-area">
                        <h5 class="dashboard-title">Dashboard</h5>
                        <div class="row">
                            @if ($instructorStatistics && count($instructorStatistics) > 0)
                            @php $stats = $instructorStatistics[0]; @endphp
                            <div class="col-lg-4">
                                <div class="single-dashboard-inner">
                                    <img src="{{ asset('instructor/img/icon/open-book.png') }}" alt="img">
                                    <div class="media-body">
                                        <h4>{{ $stats->TotalLearners }}</h4>
                                        <p>Total Students</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-dashboard-inner">
                                    <img src="{{ asset('instructor/img/icon/open-book.png') }}" alt="img">
                                    <div class="media-body">
                                        <h4>{{ $stats->TotalCourses }}</h4>
                                        <p>Total Courses</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="single-dashboard-inner">
                                    <img src="{{ asset('instructor/img/icon/open-book.png') }}" alt="img">
                                    <div class="media-body">
                                        <h4>${{ number_format($stats->TotalRevenue, 2) }}</h4>
                                        <p>Total Earnings</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <div class="alert alert-warning">
                                    No statistics available.
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                    <!-- dashboard-area end  -->
                    <div class="dashboard-course">
                        <h5 class="dashboard-title">My Courses</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Course Name</th>
                                    <th scope="col">Total Enrolled</th>
                                    <th scope="col">Rating </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">Java (Beginner) Programming Tutorials
                                    </th>
                                    <td>10</td>
                                    <td>
                                        <span class="user-rating">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                4.9
                                            </span>
                                        </span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Java (Beginner) Programming Tutorials
                                    </th>
                                    <td>10</td>
                                    <td>
                                        <span class="user-rating">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                4.9
                                            </span>
                                        </span>
                                    </td>
                                  </tr>
                                  <tr>
                                    <th scope="row">Java (Beginner) Programming Tutorials
                                    </th>
                                    <td>10</td>
                                    <td>
                                        <span class="user-rating">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                4.9
                                            </span>
                                        </span>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- dashboard-left-menu start  -->
                @include('instructor.inc.sidebar')
            </section>
        </div>
    </section>

    @endsection
