@php
     $categories = Illuminate\Support\Facades\DB::select('EXEC GetCategoriesWithCourseCountByTopic');
@endphp
<header class="navbar-area">
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <button class="menu toggle-btn d-block d-lg-none" data-target="#themefie_main_menu"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-left"></span>
                    <span class="icon-right"></span>
                </button>
            </div>
            <div class="logo">
                <a class="main-logo" href="{{ route('home') }}"><img src="{{ asset('client/img/logo.png') }}" alt="img"></a>
            </div>
            <div class="nav-right-part nav-right-part-mobile">
                <ul>
                    <li><a class="search header-search" href="#"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="themefie_main_menu">
                <div class="single-input-wrap">
                        <form action="{{ route('courses.index') }}" method="GET" class="single-input-wrap">
                            <input type="text" name="search" placeholder="Search your best courses" value="{{ $searchParam ?? '' }}">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                </div>
                <ul class="navbar-nav menu-open text-end">


                    <li>
                        <a href="{{ route('instructor.introduction') }}">Become an Instructor</a>

                    </li>
                </ul>
            </div>
            <div class="nav-right-part nav-right-part-desktop">
                <ul>
                    @auth
                        <li><a href="#"><i class="fa fa-shopping-basket"></i></a></li>
                        <li><a href="{{ route('login') }}">Log In</a></li>
                        <li>
                            <a href="{{ route('register') }}" class="btn btn-base-light">
                                Sign Up
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ Auth::user()->avatar ?? null }}" alt="Avatar" class="rounded-circle" width="30" height="30">
                                {{ Auth::user()->name ?? "Người dùng 1" }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('my.learning') }}">
                                    My Learning
                                </a>
                                <a class="dropdown-item" href="{{ route('profile.show') }}">
                                    Edit Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('purchase.history') }}">
                                    Purchase History
                                </a>
                                <hr>
                                <a class="dropdown-item" href=" ">
                                    Settings
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </nav>
</header>
<div class="category-responsive d-xl-none d-block">
    <div class="container">
        <div class="category-slider owl-carousel">
            @foreach($categories as $category)
            <div class="item">
                <a href="{{ route('category.show', ['id' => $category->CategoryID]) }}">{{ $category->CategoryName }}</a>
            </div>
        @endforeach

        </div>

    </div>
</div>
<div class="category-navbar navbar-area d-xl-block d-none">
    <nav class="navbar navbar-expand-lg">
        <div class="container nav-container">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav menu-open">
                        @foreach($categories as $category)
                            <li  >
                                <a href="{{ route('category.show', ['id' => $category->CategoryID]) }}">{{ $category->CategoryName }}</a>
                            </li>
                            @endforeach

                </ul>
            </div>
        </div>
    </nav>
</div>
