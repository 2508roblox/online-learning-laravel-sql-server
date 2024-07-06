<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Topic;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

// Home route
Route::get('/', function () {
    $courses = DB::select('EXEC GetCoursesAndCategoryId');
    $courses = collect($courses);
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');
    // +"CategoryID": "1"
    // +"CategoryName": "Finance & Accounting"
    // +"CategoryDescription": "Finance and accounting related topics"
    // +"CourseCount": "0"getCategoryById
    return view('home', compact('courses', 'categories'));
})->name('home');
Route::get('/category/{id}', function ($id) {
    $category = DB::select('EXEC getCategoryById ' . $id);
    if (!$category) {
        abort(404); // Xử lý khi không tìm thấy category
    }
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    $courses = DB::select('EXEC GetSubcategoriesTopicsCoursesByCategoryId ' . $id);

    // Chuyển đổi courses thành một cấu trúc dễ xử lý
    $structuredCourses = [];
    foreach ($courses as $course) {
        if (is_null($course->CourseID)) {
            continue; // Bỏ qua các khóa học có CourseID là null
        }

        $subcategoryID = $course->SubcategoryID;
        $topicID = $course->TopicID;

        // Tạo cấu trúc cho Subcategory nếu chưa tồn tại
        if (!isset($structuredCourses[$subcategoryID])) {
            $structuredCourses[$subcategoryID] = [
                'SubcategoryName' => $course->SubcategoryName,
                'Topics' => []
            ];
        }

        // Bỏ qua các chủ đề có TopicID hoặc TopicName là null
        if (is_null($topicID) || is_null($course->TopicName)) {
            continue;
        }

        // Tạo cấu trúc cho Topic nếu chưa tồn tại
        if (!isset($structuredCourses[$subcategoryID]['Topics'][$topicID])) {
            $structuredCourses[$subcategoryID]['Topics'][$topicID] = [
                'TopicName' => $course->TopicName,
                'Courses' => []
            ];
        }

        // Thêm khóa học vào Topic
        $structuredCourses[$subcategoryID]['Topics'][$topicID]['Courses'][] = $course;
    }

    return view('category', compact('category', 'structuredCourses', 'categories'));
})->name('category.show');

// Course detail route
Route::get('/courses/{id}', function ($id) {
    $course = Course::with(['category', 'subcategory', 'topic'])->findOrFail($id);
    return view('course-detail', compact('course'));
});


Route::get('/course/preview/{id}', function ($id) {
    // Logic để lấy dữ liệu course từ database
    $course = DB::select('EXEC GetCourseDetailsById ' . $id);
    if (!$course) {
        abort(404); // Xử lý khi không tìm thấy course
    }
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    return view('course_preview', compact('course', 'categories'));
})->name('course.preview');

Route::get('/courses', function (Request $request) {
    $searchParam = $request->query('search');
    $courses = DB::select('EXEC GetCoursesWithDetails');
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    if ($searchParam) {
        $courses = DB::select('EXEC SearchCourses ?', [$searchParam]);
    } else {
        $courses = DB::select('EXEC GetCoursesWithDetails');
    }

    return view('courses_index', compact('courses', 'categories', 'searchParam'));
})->name('courses.index');

Route::get('/register', function () {
        $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    return view('register', compact('categories'));
})->name('register');

Route::post('/register', function (Request $request) {
        $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);



    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
});

Route::get('/login', function () {
        $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    return view('login', compact('categories'));
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');
// Enroll in a course
// Route::post('/courses/{id}/enroll', function ($id) {
//     $course = Course::findOrFail($id);

//     $enrollment = Enrollment::create([
//         'user_id' => auth()->id(),
//         'course_id' => $course->id,
//     ]);

//     return redirect()->back()->with('success', 'Enrolled successfully!');
// });

// View user's enrolled courses
Route::get('/my-courses', function () {
    $courses = auth()->user()->enrollments->map(function ($enrollment) {
        return $enrollment->course;
    });
    return view('my-courses', compact('courses'));
});

Route::get('/instructor/introduction', function () {
    return view('instructor_introduction');
})->name('instructor.introduction');

Route::get('/instructor/register', function () {
    return view('instructor_register');
})->name('instructor.register');

// Handle instructor registration
Route::post('/instructor/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    $resumePath = $request->file('resume')->store('resumes');

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'resume' => $resumePath,
        'role' => 'instructor', // Assuming you have a role column to differentiate users
    ]);

    Auth::login($user);

    return redirect()->route('home')->with('success', 'Registration successful. Welcome, instructor!');
});
Route::get('/instructor/{id}', function ($id) {
    // Retrieve the instructor's information from the database
    $instructorWithCourses = DB::select('EXEC GetInstructorDetailsWithCoursesAndCategories 1');
    // If instructor is not found, redirect to a 404 page or another appropriate page
    if (!$instructorWithCourses) {
        abort(404);
    }

    // Pass the instructor data to the view
    return view('instructor_details', compact('instructorWithCourses'));
})->name('instructor.show');
Route::get('/edit_profile', function () {
    // Retrieve the instructor's information from the database

    // Pass the instructor data to the view
    return view('edit_profile' );
})->name('profile.show');
Route::get('/my-learning', function () {
    $courses = DB::select('EXEC GetCoursesWithDetails');
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');


    return view('my_learning', compact('courses','categories' ));
})->name('my.learning');



Route::get('/purchase-history', function () {
    $courses = DB::select('EXEC GetCoursesWithDetails');
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');


    return view('purchase_history', compact('courses','categories' ));
})->name('purchase.history');
// Route for checkout
Route::get('/checkout/{course_id}', function ($course_id ) {
    // Execute stored procedure to get course details
    $course = DB::select('EXEC GetCourseDetailsOnlyById ' .  $course_id );

    if (empty($course)) {
        return redirect()->back()->with('error', 'Course not found.');
    }
    // Assuming stored procedure returns an array of courses, get the first one
    $courseDetails = $course[0];

    return view('checkout', [
        'course' => $courseDetails
    ]);
})->name('checkout');
