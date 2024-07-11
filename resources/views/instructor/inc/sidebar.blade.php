<div class="dashboard-left-menu">
    <a href="" class="logo"><img src="{{asset('instructor/img/logo.png')}}"  alt="img"></a>
    <ul>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('instructor.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('instructor.profile') }}"><i class="fa fa-user"></i> My Profile</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('instructor.courses') }}"><i class="fas fa-graduation-cap"></i>My Courses</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('instructor.courses.create') }}"><i class="fa fa-rocket"></i>Create Course</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('instructor.profile.edit') }}"><i class="fas fa-cog"></i>Edit Profile</a>
        </li>
        <li class="nav-item">
            <a class="dashboard-item-menu" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>

</div>
