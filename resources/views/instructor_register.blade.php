@extends('inc.layout')
@section('content')

    <!-- breabcrumb Area Start-->
    <section class="breadcrumb-area" style="background-color: #F9FAFD;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 align-self-center">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                    </ul>
                    <h2>Please Sign Up Here</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- breabcrumb Area End -->

    <div class="signin-area pd-top-130 pd-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <form class="single-signin-form-wrap" method="POST" action=" ">
                        @csrf
                        <div class="single-input-wrap">
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="text" name="fullname" placeholder="Full Name" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="date" name="birthday" placeholder="Birthday" required>
                        </div>
                        <div class="single-input-wrap mb-3">
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="single-input-wrap">
                            <input type="text" name="address" placeholder="Address" required>
                        </div>
                        <div class="single-input-wrap">
                            <input type="text" name="phone" placeholder="Phone" required>
                        </div>
                        <div class="single-checkbox-inner">
                            <input type="checkbox" required> By clicking "create account".
                        </div>
                        <div class="btn-wrap">
                            <button class="btn btn-base w-100" type="submit">SignUp Now</button>
                        </div>
                        <div class="bottom-content">
                            <a href="#">Forgot Your Password?</a>
                            <a class="strong" href="{{ route('login') }}">Signin</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
