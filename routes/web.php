<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Topic;
use App\Models\User;
use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
Route::get('/instructor/dashboard', function () {
    // Get the authenticated user's ID
    $userID = Auth::id();

    // Execute the stored procedure with UserID to get instructor statistics
    $instructorStatistics = DB::select('EXEC GetInstructorStatisticsByUserId ?', [$userID]);
    return view('instructor.dashboard', compact('instructorStatistics'));
})->name('instructor.dashboard');

Route::get('/instructor/courses', function () {
    // Lấy UserID của người dùng hiện tại
    $userID = Auth::user()->UserID;

    // Gọi stored procedure để lấy InstructorID từ UserID
    $instructorResult = DB::select('EXEC GetInstructorIdByUserId ?', [$userID]);
    if (empty($instructorResult)) {
        return redirect()->back()->with('error', 'Instructor not found.');
    }
    $instructorID = $instructorResult[0]->InstructorID;

    // Gọi stored procedure để lấy danh sách khóa học của instructor
    $courses = DB::select('EXEC GetInstructorCoursesWithDetailsAndLessonCount ?', [$instructorID]);

    // Truyền danh sách khóa học ra view
    return view('instructor.courses', ['courses' => $courses]);
})->name('instructor.courses');

Route::get('/instructor/courses/{id}/edit', function ($id) {
    // Fetch course details using the stored procedure

    $course = DB::select('EXEC GetCourseDetailsByIdWithoutCurriculum ?', [$id])[0];
    $requirements = json_decode($course->Requirement, true);
    $learningObjectives = json_decode($course->LearningObjective, true);
    $intendedLearners = json_decode($course->IntendedLearner, true);
    // Kiểm tra dữ liệu đã giải mã
    $topics = DB::select('SELECT [TopicID], [Name] FROM [online_learning].[dbo].[Topics]');
    // Pass dữ liệu đã giải mã đến view
    return view('instructor.edit_course', [
        'course' => $course,
        'requirements' => $requirements,
        'learningObjectives' => $learningObjectives,
        'intendedLearners' => $intendedLearners,
        'topics' => $topics // Assume $topics is already defined
    ]);
    // Fetch the list of topics

    // Ensure that course data is correctly retrieved and formatted
    // Pass the course and topics data to the view
})->name('instructor.courses.edit');


Route::delete('/instructor/courses/{course}', function ($courseID) {
    // Thực hiện xóa khóa học bằng cách gọi stored procedure hoặc câu lệnh SQL trực tiếp
    DB::statement('EXEC DeleteCourseById ?', [$courseID]);

    // Redirect lại trang danh sách khóa học với thông báo thành công
    return redirect()->route('instructor.courses')->with('success', 'Course deleted successfully.');
})->name('instructor.courses.destroy');
Route::get('/instructor/profile', function () {
    // Lấy ID của giảng viên từ người dùng đã xác thực
    $userID = Auth::user()->UserID;
    // Gọi stored procedure để lấy thông tin giảng viên
    $instructor = DB::select('EXEC GetInstructorDetailsByUserId @UserID = ?', [$userID]);
    // Kiểm tra xem có dữ liệu trả về hay không
    if (!empty($instructor)) {
        $instructor = $instructor[0]; // Lấy đối tượng đầu tiên từ mảng kết quả
    }

    // Truyền dữ liệu vào view
    return view('instructor.profile', ['instructor' => $instructor]);
})->name('instructor.profile');
Route::post('/instructor/profile/update', function (Request $request) {
    $userID = Auth::user()->UserID;

    // Xác thực và lấy dữ liệu từ form
    $data = $request->validate([
        'FullName' => 'nullable|string|max:255',
        'Birthday' => 'nullable',
        'Gender' => 'nullable',
        'Address' => 'nullable|string|max:255',
        'Phone' => 'nullable|string|max:20',
        'ProfilePicture' => 'nullable',
        'Resume' => 'nullable|string',
        'ScientificBackground' => 'nullable|string',
        'Degrees' => 'nullable|string',
        'Workplace' => 'nullable|string'
    ]);
    if ($request->hasFile('ProfilePicture')) {
        $imagePath = $request->file('ProfilePicture')->store('profile_pictures', 'public');
        $data['ProfilePicture'] = '/storage/' . $imagePath;
    } else {
        $data['ProfilePicture'] = NULL;
    }
    // Cập nhật thông tin giảng viên và người dùng trong cơ sở dữ liệu
    DB::statement('EXEC UpdateInstructorAndUser
        @UserID = ?,
        @FullName = ?,
        @Birthday = ?,
        @Gender = ?,
        @Address = ?,
        @Phone = ?,
        @ProfilePicture = ?,
        @Resume = ?,
        @ScientificBackground = ?,
        @Degrees = ?,
        @Workplace = ?',
        [
            $userID,
            $data['FullName'],
            $data['Birthday'],
            $data['Gender'],
            $data['Address'],
            $data['Phone'],
            $data['ProfilePicture'] ?? null,
            $data['Resume'] ?? null,
            $data['ScientificBackground'] ?? null,
            $data['Degrees'] ?? null,
            $data['Workplace'] ?? null
        ]
    );
     return redirect()->route('instructor.profile.edit')->with('success', 'Profile updated successfully!');
})->name('instructor.profile.update');
Route::get('/instructor/profile/edit', function () {
    // Fetch the instructor data based on the authenticated user and pass it to the view
    $instructor = DB::select('EXEC GetInstructorDetailsByUserId @UserID = ?', [Auth::user()->UserID]);
    return view('instructor.edit_profile', ['instructor' => $instructor[0]]);
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
        'price' => 'required|numeric',
        // Thêm các validation khác nếu cần thiết
    ]);
    // Xử lý ảnh và video
    $imagePath = $request->file('image')->store('course_images', 'public');

    // Lấy URL của ảnh và video
    $imageUrl = Storage::disk('public')->url($imagePath);

    // Xử lý requirement và learning_objective thành JSON
    // Format the requirements, learning objectives, and intended learners
    $requirements = [];
    foreach ($request->requirement as $key => $requirement) {
        $requirements["field" . ($key + 1)] = $requirement;
    }

    $learningObjectives = [];
    foreach ($request->learning_objective as $key => $learningObjective) {
        $learningObjectives["field" . ($key + 1)] = $learningObjective;
    }

    $intendedLearnerObjectives = [];
    foreach ($request->intendedLearner as $key => $intendedLearnerObjective) {
        $intendedLearnerObjectives["field" . ($key + 1)] = $intendedLearnerObjective;
    }


    // Chuyển đổi thành JSON
    $requirementJson = json_encode($requirements);
    $learningObjectiveJson = json_encode($learningObjectives);
    $intendedLearnerJson = json_encode($intendedLearnerObjectives);
    $messagesJson = json_encode([
        'welcome_message' => $request->input('welcome_message'),
        'congratulations_message' => $request->input('congratulations_message')
    ]);
    // Lấy ID của instructor hiện tại từ Auth
    $instructorID = DB::select('EXEC GetInstructorIdByUserId ?', [Auth::user()->UserID])[0]->InstructorID;
    // Thực hiện chèn dữ liệu vào cơ sở dữ liệu bằng DB::statement
    DB::statement("
        DECLARE @Requirement NVARCHAR(MAX) = '$requirementJson',
                @LearningObjective NVARCHAR(MAX) = '$learningObjectiveJson',
                @IntendedLearner NVARCHAR(MAX) = '$intendedLearnerJson',
                @Title NVARCHAR(255) = '{$request->title}',
                @Subtitle NVARCHAR(255) = '{$request->subtitle}',
                @Description NVARCHAR(MAX) = '{$request->description}',
                @Language NVARCHAR(50) = '{$request->language}',
                @Level NVARCHAR(50) = '{$request->level}',
                @ImageURL NVARCHAR(255) = '$imagePath',
                @PromotionalVideoURL NVARCHAR(255) = '$request->video_url',
                @Price DECIMAL(10, 2) = {$request->price},
                @Message NVARCHAR(MAX) = '{$messagesJson}',
                @Approve BIT = 0,
                @PublicationDate DATE = CURRENT_TIMESTAMP,
                @UpdateAt DATETIME = CURRENT_TIMESTAMP,
                @InstructorID INT = {$instructorID},
                @TopicID INT = {$request->topic_id};

        EXEC [dbo].[InsertCourse]
            @Requirement = @Requirement,
            @LearningObjective = @LearningObjective,
            @IntendedLearner =  @IntendedLearner,
            @Title = @Title,
            @Subtitle = @Subtitle,
            @Description = @Description,
            @Language = @Language,
            @Level = @Level,
            @ImageURL = @ImageURL,
            @PromotionalVideoURL = @PromotionalVideoURL,
            @Price = @Price,
            @Message = @Message,
            @Approve = @Approve,
            @PublicationDate = @PublicationDate,
            @UpdateAt = @UpdateAt,
            @InstructorID = @InstructorID,
            @TopicID = @TopicID;
    ");

    return redirect()->route('instructor.courses')->with('success', 'Course created successfully.');
})->name('instructor.courses.store');


Route::put('/instructor/courses/{id}', function (Request $request, $id) { {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric',
            'level' => 'required|string|max:50',
            'topic_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimetypes:video/mp4|max:20000'
        ]);

        // Fetch the course data
        $course = Course::findOrFail($id);

        // Handle the form submission and update logic
        $data = $request->all();

        // Process image and video uploads
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($course->ImageURL) {
                Storage::disk('public')->delete($course->ImageURL);
            }
            $imagePath = $request->file('image')->store('course_images', 'public');
            $data['ImageURL'] = $imagePath;
        } else {
            $data['ImageURL'] = $course->ImageURL;
        }

        $data['PromotionalVideoURL'] = $request->video_url;



        // Xử lý và format dữ liệu requirements
        $requirements = [];
        $requirementValues = $request->input('requirement', []);

        // Lặp qua tất cả các phần tử và tạo các khóa field1, field2, ...
        foreach ($requirementValues as $index => $requirement) {
            // Chuyển đổi chỉ số thành chuỗi và cộng 1 để tạo khóa
            $indexStr = is_numeric($index) ? (string)($index + 1) : $index;
            // Tạo khóa cho mỗi phần tử
            $requirements["field" . $indexStr] = $requirement;
        }

        // Xử lý và format dữ liệu learning objectives
        $learningObjectives = [];
        $learningObjectiveValues = $request->input('learning_objective', []);

        foreach ($learningObjectiveValues as $index => $learningObjective) {
            // Chuyển đổi chỉ số thành chuỗi và cộng 1 để tạo khóa
            $indexStr = is_numeric($index) ? (string)($index + 1) : $index;
            // Tạo khóa cho mỗi phần tử
            $learningObjectives["field" . $indexStr] = $learningObjective;
        }

        // Xử lý và format dữ liệu intended learners
        $intendedLearnerObjectives = [];
        $intendedLearnerValues = $request->input('intendedLearner', []);

        foreach ($intendedLearnerValues as $index => $intendedLearnerObjective) {
            // Chuyển đổi chỉ số thành chuỗi và cộng 1 để tạo khóa
            $indexStr = is_numeric($index) ? (string)($index + 1) : $index;
            // Tạo khóa cho mỗi phần tử
            $intendedLearnerObjectives["field" . $indexStr] = $intendedLearnerObjective;
        }

        // Chuyển đổi thành JSON
        $requirementJson = json_encode($requirements);
        $learningObjectiveJson = json_encode($learningObjectives);
        $intendedLearnerJson = json_encode($intendedLearnerObjectives);

        // In dữ liệu JSON để kiểm tra


        $messagesJson = json_encode([
            'welcome_message' => $request->input('welcome_message'),
            'congratulations_message' => $request->input('congratulations_message')
        ]);

        // Get current date and time for update
        $updateAt = now();

        // Execute the stored procedure to update the course
        DB::statement("
            DECLARE @Requirement NVARCHAR(MAX) = '$requirementJson',
                    @LearningObjective NVARCHAR(MAX) = '$learningObjectiveJson',
                    @IntendedLearner NVARCHAR(MAX) = '$intendedLearnerJson',
                    @Title NVARCHAR(255) = '{$data['title']}',
                    @Subtitle NVARCHAR(255) = '{$data['subtitle']}',
                    @Description NVARCHAR(MAX) = '{$data['description']}',
                    @Language NVARCHAR(50) = '{$data['language']}',
                    @Level NVARCHAR(50) = '{$data['level']}',
                    @ImageURL NVARCHAR(255) = '{$data['ImageURL']}',
                    @PromotionalVideoURL NVARCHAR(255) = '{$data['PromotionalVideoURL']}',
                    @Price DECIMAL(10, 2) = {$data['price']},
                    @Message NVARCHAR(MAX) = '$messagesJson',
                    @Approve BIT = 1,  -- Assuming approval status remains the same
                    @PublicationDate DATE = CURRENT_TIMESTAMP,
                    @UpdateAt DATETIME = '$updateAt',
                    @InstructorID INT = {$course->InstructorID},
                    @TopicID INT = {$data['topic_id']},
                    @CourseID INT = {$id};

            EXEC [dbo].[UpdateCourse]
                @CourseID,
                @Requirement,
                @LearningObjective,
                @IntendedLearner,
                @Title,
                @Subtitle,
                @Description,
                @Language,
                @Level,
                @ImageURL,
                @PromotionalVideoURL,
                @Price,
                @Message,
                @Approve,
                @PublicationDate,
                @UpdateAt,
                @InstructorID,
                @TopicID;
        ");

        return redirect()->route('instructor.courses.edit', $id)->with('success', 'Course updated successfully!');
    }
})->name('instructor.courses.update');













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
    // Get the authenticated user's ID
    $userID = Auth::id();

    // Execute the stored procedure with CourseID and UserID
    $course = DB::select('EXEC GetCourseDetailsById ?, ?', [$id, $userID]);
    if (!$course) {
        abort(404); // Handle the case where the course is not found
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

    DB::statement(
        'EXEC CreateUser
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
        Auth::loginUsingId($user[0]->UserID);
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
    DB::statement(
        'EXEC CreateUser
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
    return view('edit_profile');
})->name('profile.show');
Route::get('/my-learning', function () {
    $courses = DB::select('EXEC [dbo].[GetUserPurchasedCoursesWithDetails] @UserID = '. Auth::user()->UserID);
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');


    return view('my_learning', compact('courses', 'categories'));
})->name('my.learning');



Route::get('/purchase-history', function () {
    // Get the authenticated user's ID
    $userID = Auth::id();

    // Execute the stored procedure with UserID to get payment history
    $paymentHistory = DB::select('EXEC GetPaymentsByUserId ?', [$userID]);

    // Retrieve courses and categories
    $courses = DB::select('EXEC GetCoursesWithDetails');
    $categories = DB::select('EXEC GetCategoriesWithCourseCountByTopic');
    return view('purchase_history', compact('paymentHistory', 'courses', 'categories'));
})->name('purchase.history');

// Route for checkout
Route::get('/checkout/{course_id}', function ($course_id) {
    // Execute stored procedure to get course details
    $course = DB::select('EXEC GetCourseDetailsOnlyById ' .  $course_id);
    if (empty($course)) {
        return redirect()->back()->with('error', 'Course not found.');
    }
    // Assuming stored procedure returns an array of courses, get the first one
    $courseDetails = $course[0];

    return view('checkout', [
        'course' => $courseDetails
    ]);
})->name('checkout');



// Route để hiển thị chi tiết curriculum trong khóa học
Route::get('/learning/{course_id}/curriculum/{curriculum_id}', function ($course_id, $curriculum_id) {
    // Lấy thông tin khóa học từ cơ sở dữ liệu
    $course = DB::select('EXEC GetCourseDetailsById ?, ?', [$course_id, 0]);

    // Nếu không tìm thấy khóa học, trả về lỗi 404
    if (!$course) {
        abort(404, 'Course not found');
    }

    // Lấy thông tin curriculum từ cơ sở dữ liệu
    $curriculum = DB::table('curriculums')->find($curriculum_id);

    // Nếu không tìm thấy curriculum, trả về lỗi 404
    if (!$curriculum) {
        abort(404, 'Curriculum not found');
    }

    // Trả về view chi tiết curriculum với dữ liệu khóa học và curriculum
    return view('curriculum.show', [
        'course' => $course,
        'curriculum' => $curriculum
    ]);
})->name('curriculum.show');

// Route để hiển thị form tạo curriculum cho một khóa học
Route::get('/instructor/courses/{courseId}/curriculum/create', function ($courseId) {
    // Gọi stored procedure để lấy chi tiết khóa học
    $courseDetails = DB::select('EXEC [dbo].[GetCourseDetailsById]   ?, ?', [$courseId, 0]);

    if (empty($courseDetails)) {
        return redirect()->route('instructor.courses')->with('error', 'Course not found.');
    }

    $sections = [];
    foreach ($courseDetails as $detail) {
        $sections[$detail->SectionID]['section'] = $detail;
        $sections[$detail->SectionID]['curriculums'][] = $detail;
    }

    // Truyền dữ liệu vào view
    return view('instructor.create_curriculum', [
        'courseId' => $courseId,
        'sections' => $sections
    ]);
})->name('instructor.courses.curriculum.create');



Route::post('/instructor/courses/{sectionId}/curriculum', function (Request $request, $sectionId) {


    $type = $request->input('type');
    $dueTime = $request->input('due_time');
    if ($dueTime) {
        // Đảm bảo rằng định dạng ngày tháng khớp với yêu cầu của SQL Server
        $dueTime = Carbon::parse($dueTime)->format('Y-m-d H:i:s');
    } else {
        $dueTime = null; // Nếu không có giá trị, đặt giá trị null
    }
    if ($type === 'A') {
        DB::statement('EXEC [dbo].[InsertCurriculumAssignment] ?, ?, ?, ?, ?, ?, ?, ?', [
            $request->input('title'),
            $request->input('description'),
            'Active',
            $sectionId,
            $request->input('duration1', 0),
            $request->input('instructions', ''),
            $dueTime,
            $request->input('submission_status', 'Not Submitted'),
        ]);
    } elseif ($type === 'L') {
        DB::statement('EXEC [dbo].[InsertCurriculumLecture] ?, ?, ?, ?, ?, ?, ?', [
            $request->input('title'),
            $request->input('description'),
            'Active',
            'L',
            $sectionId,
            $request->input('duration', 0),
            $request->input('content', ''),
        ]);
    } elseif ($type === 'Q') {
        DB::statement('EXEC [dbo].[InsertCurriculumQuiz] ?, ?, ?, ?', [
            $request->input('title'),
            $request->input('description'),
            'Active',
            $sectionId,
        ]);
    }

    return redirect()->back()->with('success', 'Curriculum added successfully.');
})->name('instructor.courses.curriculum.store');


Route::post('/instructor/courses/{courseId}/section', function (Request $request, $courseId) {
    $request->validate([
        'section_title' => 'required|string|max:255',
        'section_learning_objective' => 'required|string',
    ]);

    // Gọi stored procedure để thêm section
    DB::statement('EXEC [dbo].[InsertSection] @Title = ?, @LearningObjective = ?, @CourseID = ?', [
        $request->input('section_title'),
        $request->input('section_learning_objective'),
        $courseId,
    ]);

    return redirect()->back()->with('success', 'Section added successfully.');
})->name('instructor.courses.section.store');
Route::post('/instructor/curriculums/{curriculumId}/edit', function (Request $request, $curriculumId) {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|string|max:50',
    ]);

    DB::statement('EXEC [dbo].[UpdateCurriculumQuiz] @CurriculumID = ?, @Title = ?, @Description = ?, @Status = ?', [
        $curriculumId,
        $request->input('title'),
        $request->input('description'),
        $request->input('status'),
    ]);

    return redirect()->back()->with('success', 'Quiz updated successfully.');
})->name('instructor.curriculums.quiz.update');
Route::put('/instructor/curriculums/{curriculumId}/edit/quiz', function (Request $request, $curriculumId) {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|string|max:50',
    ]);

    DB::statement('EXEC [dbo].[UpdateCurriculumQuiz] @CurriculumID = ?, @Title = ?, @Description = ?, @Status = ?', [
        $curriculumId,
        $request->input('title'),
        $request->input('description'),
        $request->input('status'),
    ]);

    return redirect()->back()->with('success', 'Quiz updated successfully.');
})->name('instructor.curriculums.quiz.update');
Route::put('/instructor/curriculums/{curriculumId}/assignment', function (Request $request, $curriculumId) {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'instructions' => 'nullable|string',
        'duration' => 'nullable|integer',
        'due_time' => 'nullable|date_format:Y-m-d H:i:s',
        'submission_status' => 'nullable|string|max:50',
    ]);

    $dueTime = $request->input('due_time') ? Carbon::parse($request->input('due_time'))->format('Y-m-d H:i:s') : null;

    DB::statement('EXEC [dbo].[UpdateCurriculumAssignment] @CurriculumID = ?, @Title = ?, @Description = ?, @Instructions = ?, @Duration = ?, @DueTime = ?, @SubmissionStatus = ?', [
        $curriculumId,
        $request->input('title'),
        $request->input('description'),
        $request->input('instructions'),
        $request->input('duration'),
        $dueTime,
        $request->input('submission_status'),
    ]);

    return redirect()->back()->with('success', 'Assignment updated successfully.');
})->name('instructor.curriculums.assignment.update');
Route::put('/instructor/curriculums/lecture/{lectureId}', function (Request $request, $lectureId) {
    // Lấy dữ liệu từ request
    $duration = $request->input('Duration');
    $content = $request->input('Content');
    $curriculumItemId = $request->input('CurriculumItemID');

    // Cập nhật dữ liệu lecture trong cơ sở dữ liệu
    DB::update('
        UPDATE [online_learning].[dbo].[Lecture]
        SET
            [Duration] = ?,
            [Content] = ?
        WHERE
            [LectureID] = ?', [
        $duration,
        $content,
        $lectureId
    ]);

    return redirect()->route('instructor.curriculums.lecture.edit', ['curriculumId' => $curriculumItemId])
        ->with('success', 'Lecture updated successfully.');
})->name('instructor.curriculums.lecture.update');






Route::get('/instructor/curriculums/{curriculumId}/quiz/edit', function ($curriculumId) {
    // Lấy dữ liệu của Quiz từ cơ sở dữ liệu
    $curriculum = DB::select('EXEC [dbo].[GetQuizDetails] @CurriculumItemID = ?', [$curriculumId]);

    if (empty($curriculum)) {
        abort(404, 'Curriculum not found');
    }
    // Trả về view chỉnh sửa Quiz với dữ liệu của Quiz
    return view('instructor.curriculums.edit_quiz', ['curriculums' => $curriculum]);
})->name('instructor.curriculums.quiz.edit');


Route::get('/instructor/curriculums/{curriculumId}/assignment/edit', function ($curriculumId) {
    // Lấy dữ liệu của Assignment từ cơ sở dữ liệu
    $curriculum = DB::select('EXEC [dbo].[GetCurriculumAssignmentById] ?', [$curriculumId]);

    if (empty($curriculum)) {
        abort(404, 'Curriculum not found');
    }

    // Trả về view chỉnh sửa Assignment với dữ liệu của Assignment
    return view('instructor.curriculums.edit_assignment', ['curriculum' => $curriculum[0]]);
})->name('instructor.curriculums.assignment.edit');



Route::get('/instructor/curriculums/{curriculumId}/lecture/edit', function ($curriculumId) {
    // Lấy dữ liệu của Lecture từ cơ sở dữ liệu
    $lecture = DB::select('
        SELECT
            [LectureID],
            [Duration],
            [Content],
            [CurriculumItemID]
        FROM
            [online_learning].[dbo].[Lecture]
        WHERE
            [CurriculumItemID] = ?', [$curriculumId]);

    if (empty($lecture)) {
        abort(404, 'Lecture not found');
    }

    // Trả về view chỉnh sửa Lecture với dữ liệu của Lecture
    return view('instructor.curriculums.edit_lecture', ['lecture' => $lecture[0]]);
})->name('instructor.curriculums.lecture.edit');


Route::post('/instructor/curriculums/quiz/store', function (Request $request) {
    // Lấy dữ liệu từ request
    $question = $request->input('Question');
    $choices = json_encode($request->input('Choices'));
    $correctAnswer = $request->input('CorrectAnswer');
    $quizId = $request->input('QuizID');

    // Gọi stored procedure để lưu dữ liệu
    DB::statement('EXEC [dbo].[InsertMultipleChoiceQuestion] @QuizID = ?, @Question = ?, @Choices = ?, @CorrectAnswer = ?', [
        $quizId,
        $question,
        $choices,
        $correctAnswer
    ]);

    return redirect()->back()->with('success', 'Question added successfully.');
})->name('instructor.curriculums.quiz.store');



Route::get('/instructor/curriculums/quiz/{questionId}/edit', function ($questionId) {
    // Lấy dữ liệu của câu hỏi từ cơ sở dữ liệu
    $question = DB::select('
        SELECT
            [MCQNo],
            [Question],
            [Choices],
            [CorrectAnswer],
            [QuizID]
        FROM
            [online_learning].[dbo].[MultipleChoiceQuestion]
        WHERE
            [MCQNo] = ?', [$questionId]);

    if (empty($question)) {
        abort(404, 'Question not found');
    }

    return view('instructor.curriculums.edit_question', ['question' => $question[0]]);
})->name('instructor.curriculums.quiz.question.edit');
Route::put('/instructor/curriculums/quiz/{questionId}', function (Request $request, $questionId) {
    // Lấy dữ liệu từ request
    $question = $request->input('Question');
    $choices = json_encode($request->input('Choices')); // Chuyển đổi choices thành JSON
    $correctAnswer = $request->input('CorrectAnswer');
    $quizId = $request->input('QuizID');
    // Cập nhật dữ liệu câu hỏi trong cơ sở dữ liệu thông qua stored procedure
    DB::statement('EXEC dbo.UpdateMultipleChoiceQuestion
        @MCQNo = ?,
        @Question = ?,
        @Choices = ?,
        @CorrectAnswer = ?', [
        $questionId,
        $question,
        $choices,
        $correctAnswer,

    ]);

    return redirect()->back()->with('success', 'Question updated successfully.');
})->name('instructor.curriculums.quiz.update');



// Route for viewing a quiz
Route::get('/learning/{course_id}/quiz/{item_id}', function ($course_id, $item_id) {
    // Fetch the quiz details based on the CurriculumItemID
    $quiz = DB::select('
        SELECT
            mcq.[MCQNo],
            mcq.[Question],
            mcq.[Choices],
            mcq.[CorrectAnswer],
            mcq.[QuizID]
        FROM [online_learning].[dbo].[MultipleChoiceQuestion] AS mcq
        INNER JOIN [online_learning].[dbo].[Quiz] AS q
            ON mcq.[QuizID] = q.[QuizID]
        WHERE q.[CurriculumItemID] = ?', [$item_id]);

    if (empty($quiz)) {
        abort(404); // Handle the case when the quiz is not found
    }

    // Fetch the course details
    $course = DB::select('EXEC GetCourseDetailsById ?, ?', [$course_id, 0]);
    if (empty($course)) {
        abort(404); // Handle the case when the course is not found
    }

    return view('learning', [
        'quiz' => $quiz,
        'course' => $course,
        'current_item' => $item_id
    ]);
})->name('learning.quiz');


// Route for viewing an assignment
Route::get('/learning/{course_id}/assignment/{item_id}', function ($course_id, $item_id) {
    // Fetch the assignment details based on the item_id
    $assignment = DB::select('EXEC GetAssignmentDetailsById @AssignmentID = ?', [$item_id]);
    if (!$assignment) {
        abort(404); // Handle the case when the assignment is not found
    }
    return view('learning.assignment', ['assignment' => $assignment]);
})->name('learning.assignment');

// Route for viewing a video
Route::get('/learning/{course_id}/video/{item_id}', function ($course_id, $item_id) {
    // Fetch the video details based on the CurriculumItemID
    $video = DB::select('
        SELECT
            [LectureID],
            [Duration],
            [Content],
            [CurriculumItemID]
        FROM [online_learning].[dbo].[Lecture]
        WHERE [CurriculumItemID] = ?', [$item_id]);

    if (empty($video)) {
        abort(404); // Handle the case when the video is not found
    }
    $course = DB::select('EXEC GetCourseDetailsById ?, ?', [$course_id, 0]);
    if (!$course) {
        abort(404); // Xử lý khi không tìm thấy course
    }

    if (empty($course)) {
        return redirect()->back()->with('error', 'Course not found.');
    }

    return view('learning', ['video' => $video[0], 'course' =>  $course, 'current_item' => $item_id]);
})->name('learning.video');
Route::get('/learning/{course_id}', function ($course_id) {
    // Get the authenticated user's ID
    $userID = Auth::id();

    // Execute the stored procedure with CourseID and UserID
    $course = DB::select('EXEC GetCourseDetailsById ?, ?', [$course_id, $userID]);
    if (!$course) {
        abort(404); // Handle the case where the course is not found
    }

    // Check if the user has purchased the course
    if ($course[0]->HasPurchased == "0") {
        return redirect()->route('checkout', ['course_id' => $course[0]->CourseID]);
    }

    // Group the course details by SectionID
    $sections = collect($course)->groupBy('SectionID');

    // Find the first curriculum item
    $firstItem = $sections->first()->first();
    if ($firstItem) {
        switch ($firstItem->CurriculumItemType) {
            case 'Q':
                return redirect()->route('learning.quiz', ['course_id' => $course_id, 'item_id' => $firstItem->CurriculumItemID]);
            case 'A':
                return redirect()->route('learning.assignment', ['course_id' => $course_id, 'item_id' => $firstItem->CurriculumItemID]);
            case 'L':
                return redirect()->route('learning.video', ['course_id' => $course_id, 'item_id' => $firstItem->CurriculumItemID]);
        }
    }

    // If no curriculum item found, return to the learning view
    return view('learning', [
        'course' => $course,
        'sections' => $sections
    ]);
})->name('learning.course');

Route::put('/learner/profile/update', function (Request $request) {
    $userID = Auth::user()->UserID;

    // Validate the form data
    $data = $request->validate([
        'FullName' => 'required|string|max:255',
        'Email' => 'required|email|max:255',
        'Gender' => 'required|in:Male,Female',
        'Address' => 'required|string|max:255',
        'Phone' => 'required|string|max:20',
        'Birthday' => 'required|date',
    ]);

    // Prepare the SQL statement
    $sql = "
        DECLARE @UserID INT = ?;
        DECLARE @FullName NVARCHAR(255) = ?;
        DECLARE @Email NVARCHAR(255) = ?;
        DECLARE @Gender NVARCHAR(6) = ?;
        DECLARE @Address NVARCHAR(255) = ?;
        DECLARE @Phone NVARCHAR(20) = ?;
        DECLARE @Birthday DATE = ?;
        DECLARE @UpdatedAt DATETIME = NULL;

        EXEC [dbo].[UpdateUserProfile]
            @UserID,
            @FullName,
            @Email,
            @Gender,
            @Address,
            @Phone,
            @Birthday,
            @UpdatedAt;
    ";

    // Execute the SQL statement
    DB::statement($sql, [
        $userID,
        $data['FullName'],
        $data['Email'],
        $data['Gender'],
        $data['Address'],
        $data['Phone'],
        $data['Birthday']
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully!');
})->name('learner.profile.update');

Route::put('/user/change-password', function (Request $request) {
    $user = Auth::user();
    $userID = $user->UserID;
    $currentPassword = $request->input('current_password');
    $newPassword = $request->input('new_password');

    // Check if the current password is correct
    if (!Hash::check($currentPassword, $user->Password)) {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    // Hash the new password
    $hashedNewPassword = Hash::make($newPassword);

    // Call the stored procedure to update the password
    DB::statement('
        EXEC [dbo].[ChangeUserPassword]
            @UserID = ?,
            @CurrentPassword = ?,
            @NewPassword = ?',
        [
            $userID,
            $user->Password,  // Plain text password for validation
            $hashedNewPassword // Hashed new password
        ]
    );

    return redirect()->back()->with('success', 'Password changed successfully!');
})->name('user.change.password');

Route::put('/user/update-profile-picture', function (Request $request) {
    $user = Auth::user();
    $userID = $user->UserID;

    // Validate the uploaded file
    $request->validate([
        'ProfilePicture' => 'nullable ',
    ]);

    $profilePicture = $request->file('ProfilePicture');

    if ($profilePicture) {
        // Store the new profile picture
        $path = $profilePicture->store('profile_pictures', 'public');
        $profilePictureUrl = Storage::url($path);

        // Update the user's profile picture in the database
        DB::update('
            UPDATE [online_learning].[dbo].[Users]
            SET ProfilePicture = ?
            WHERE UserID = ?',
            [$profilePictureUrl, $userID]
        );
    }

    return redirect()->back()->with('success', 'Profile picture updated successfully!');
})->name('user.update.profile.picture');

Route::post('/checkout/process', function (Request $request) {
    $userID = Auth::user()->UserID;

    // Retrieve the LearnerID based on the UserID
    $learnerID = DB::table('Learners')
                    ->where('UserID', $userID)
                    ->value('LearnerID');

    if (!$learnerID) {
        return redirect()->back()->withErrors(['error' => 'Learner ID not found.']);
    }
    $courseID = $request->input('course_id');
    $quantity = 1;
    $price = $request->input('course_price');
    $paymentMethod = 'Credit Card' ;
    $amount = $price;
    $status = 'success';

    // Call the stored procedure to process the order
    DB::statement('
        EXEC [dbo].[ProcessOrder]
            @LearnerID = ?,
            @CourseID = ?,
            @Quantity = ?,
            @Price = ?,
            @PaymentMethod = ?,
            @Amount = ?,
            @Status = ?',
        [
            $learnerID,
            $courseID,
            $quantity,
            $price,
            $paymentMethod,
            $amount,
            $status
        ]
    );

    return redirect()->back()->with('success', 'Order processed successfully!');
})->name('checkout.process');
