<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Topic;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/instructor/dashboard', function () {
    return view('instructor.dashboard');
})->name('instructor.dashboard');

Route::get('/instructor/courses', function () {
    return view('instructor.courses');
})->name('instructor.courses');

Route::get('/instructor/courses/{id}/edit', function ($id) {
    // Fetch the course data based on the id and pass it to the view
    $course = \App\Models\Course::find($id);
    return view('instructor.edit_course', ['course' => $course]);
})->name('instructor.courses.edit');

Route::get('/instructor/profile', function () {
    // Fetch the instructor data based on the authenticated user and pass it to the view
    $instructor = \Auth::user();
    return view('instructor.profile', ['instructor' => $instructor]);
})->name('instructor.profile');

Route::get('/instructor/profile/edit', function () {
    // Fetch the instructor data based on the authenticated user and pass it to the view
    $instructor = \Auth::user();
    return view('instructor.edit_profile', ['instructor' => $instructor]);
})->name('instructor.profile.edit');
Route::get('/instructor/courses/create', function () {
    $topics = DB::select('SELECT [TopicID], [Name] FROM [online_learning].[dbo].[Topics]');
    // Pass the topics to the view
    return view('instructor.create_course', ['topics' => $topics]);
})->name('instructor.courses.create');
Route::post('/instructor/courses', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'category' => 'required|string|max:255',
        'price' => 'required|numeric',
        // Thêm các validation khác nếu cần thiết
    ]);

    // Tạo course mới
    \App\Models\Course::create([
        'title' => $request->title,
        'description' => $request->description,
        'category' => $request->category,
        'price' => $request->price,
        'instructor_id' => \Auth::id(), // Lấy ID của instructor hiện tại
        // Thêm các trường khác nếu cần thiết
    ]);

    return redirect()->route('instructor.courses')->with('success', 'Course created successfully.');
})->name('instructor.courses.store');


















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
    $request->validate([
        'username' => 'required|string|max:50',
        'password' => 'required|string|min:8|confirmed',
        'email' => 'required|string|email|max:100',
        'fullname' => 'required|string|max:100',
        'birthday' => 'required|date',
        'gender' => 'required|in:M,F',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
    ]);

    $hashedPassword = Hash::make($request->password);

    DB::statement('EXEC CreateUser
        @Username = ?,
        @Password = ?,
        @Email = ?,
        @FullName = ?,
        @Birthday = ?,
        @Gender = ?,
        @Address = ?,
        @Phone = ?,
        @ProfilePicture = ?,
        @UserType = ?',
        [
            $request->username,
            $hashedPassword,
            $request->email,
            $request->fullname,
            $request->birthday,
            $request->gender,
            $request->address,
            $request->phone,
            'default.png', // Default profile picture
            'L' // User type Learner
        ]
    );

    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
})->name('register');

Route::get('/login', function () {
        $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');

    return view('login', compact('categories'));
})->name('login');



Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => 'required|string|max:50',
        'password' => 'required|string|min:8',
    ]);

    // Call the stored procedure to get the user details
    $user = DB::select('EXEC GetUserByUsername @Username = ?', [$credentials['username']]);

    if ($user && Hash::check($credentials['password'], $user[0]->Password)) {
        // Assuming the stored procedure returns user information if successful

        // Manually setting session data
        $request->session()->put('user_id', $user[0]->UserID);
        $request->session()->put('username', $user[0]->Username);
        $request->session()->put('email', $user[0]->Email);

        // Check user type
        if ($user[0]->UserType == 'I') {
            // If user is instructor, redirect to instructor dashboard
            return redirect()->route('instructor.dashboard');
        } else {
            // Otherwise, redirect to default home/dashboard route
            return redirect('/');
        }
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ])->onlyInput('username');
})->name('login');



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
        'password' => 'required|string|min:8|confirmed'
    ]);

    // Store the uploaded resume

    // Hash the password
    $hashedPassword = Hash::make($request->password);

    // Execute stored procedure to create instructor
    DB::statement('EXEC CreateUser
        @Username = ?,
        @Password = ?,
        @Email = ?,
        @FullName = ?,
        @Birthday = ?,
        @Gender = ?,
        @Address = ?,
        @Phone = ?,
        @ProfilePicture = ?,
        @UserType = ?',
        [
            $request->name,
            $hashedPassword,
            $request->email,
            $request->fullname,
            $request->birthday,
            $request->gender,
            $request->address,
            $request->phone,
            'default.png', // Default profile picture
            'I' // User type Instructor
        ]
    );

    // Redirect to login with success message
    return redirect()->route('login')->with('success', 'Registration successful. Please login.');
})->name('instructor.register');
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

Route::get('/learning/{course_id}', function ($course_id) {
    // Check if the user has purchased the course or has access to it
    // You may need to implement your own logic here to check if the user has access

    // For demonstration purposes, assume the user has access
    $course = DB::select('EXEC GetCourseDetailsById ' . $course_id);
    if (!$course) {
        abort(404); // Xử lý khi không tìm thấy course
    }

    if (empty($course)) {
        return redirect()->back()->with('error', 'Course not found.');
    }

    return view('learning', [
        'course' => $course // Assuming you retrieve the course details from database
    ]);
})->name('learning.course');


