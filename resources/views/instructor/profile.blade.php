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
                            <a href="#"><img style="width: 100px;" src="{{ $instructor->ProfilePicture }}" alt="Profile Picture"></a>
                            <span>Hello,
                                <h5>{{ $instructor->FullName }}</h5>
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
        <div class="dashboard-profile-area">
            <h5 class="dashboard-title">My Profile</h5>
            <a class="edit-btn" href="#"><i class="fa fa-pencil-alt me-2"></i>Edit</a>
            <ul>
                <li><span>Registration Date</span>{{ \Carbon\Carbon::parse($instructor->CreatedAt)->format('l, d M Y, h:i A') }}</li>
                <li><span>Full Name</span>{{ $instructor->FullName }}</li>
                <li><span>Username</span>{{ $instructor->Username }}</li>
                <li><span>Email</span>{{ $instructor->Email }}</li>
                <li><span>Phone Number</span>{{ $instructor->Phone }}</li>
                <li><span>Address</span>{{ $instructor->Address }}</li>
                <li><span>Instructor Type</span>{{ ucfirst($instructor->InstructorType) }}</li>
                <li><span>Scientific Background</span>{{ $instructor->ScientificBackground }}</li>
                <li><span>Degrees</span>{{ $instructor->Degrees }}</li>
            </ul>
        </div>
    </div>
    <!-- dashboard-left-menu start  -->
    @include('instructor.inc.sidebar')
</section>
@endsection
