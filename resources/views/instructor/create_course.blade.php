
@extends('instructor.inc.layout')
@section('content')




<section class="admin-dashboard-section">
    <div class="admin-dashboard-right-side">

        <div class="main-header">
            <div class="header-wraper">
                <div class="row">
                    <div class="col-xl-6">
                        <span class="header-user">
                            <h3 class="text-white">Create Course</h3>
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="dashboard-course-area">
            <div class="row">
                {{-- form create --}}
                <form method="POST" action="{{ route('instructor.courses.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12">
                        <ul class="nav nav-pills" id="createCourseTabs">
                            <li class="nav-item">
                                <button class="nav-link active" id="requirements-tab" data-bs-toggle="pill" data-bs-target="#requirements">Requirements</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="details-tab" data-bs-toggle="pill" data-bs-target="#details">Details</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="messages-tab" data-bs-toggle="pill" data-bs-target="#messages">Messages</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- Requirements Tab -->
                            <div class="tab-pane fade show active" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
                                <div id="requirements-fields">
                                    <div class="form-group mt-3">
                                        <label for="requirement">Requirement</label>
                                        <input type="text" class="form-control" id="requirement" name="requirement[]" rows="4" required></input>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-requirement">+</button>

                                <div id="intendedLearner-fields">
                                    <div class="form-group mt-3">
                                        <label for="intendedLearner">IntendedLearner</label>
                                        <input type="text" class="form-control" id="intendedLearner" name="intendedLearner[]" rows="4" required></input>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-intendedLearner">+</button>

                                <div id="learning-objectives-fields">
                                    <div class="form-group mt-3">
                                        <label for="learning_objective">Learning Objective</label>
                                        <input type="text" class="form-control" id="learning_objective" name="learning_objective[]" rows="4" required></input>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-learning-objective">+</button>
                            </div>

                            <!-- Details Tab -->
                            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="form-group mt-3">
                                    <label for="topic_id">Topic</label>
                                    <select class="form-control" id="topic_id" name="topic_id" required>
                                        @foreach($topics as $topic)
                                        <option value="{{ $topic->TopicID }}">{{ $topic->Name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="language">Language</label>
                                    <input type="text" class="form-control" id="language" name="language" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" required placeholder="$">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level" name="level" required>
                                </div>
                                  <div class="form-group mt-3">
                        <label for="image_url">Image</label>
                        <input type="file" class="form-control" id="image_url" name="image" required onchange="previewImage(event)">
                    </div>
                    <img id="image-preview" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-top: 10px;">

                    <div class="form-group mt-3">
                        <label for="promotional_video_url">Promotional Video</label>
                        <input type="file" class="form-control" id="promotional_video_url" name="video" onchange="uploadVideo()" required>
                    </div>
                    <input type="hidden" id="video_url" name="video_url">

                    <div id="videoContainer" style="display: none; width: 300px;">
                        <video id="uploadedVideo" controls  style="  width: 300px;">
                            <!-- Video source will be set dynamically -->
                            Your browser does not support the video tag.
                        </video>
                    </div>

                    <script>
                        function uploadVideo() {
                            let formData = new FormData();
                            formData.append('video', document.getElementById('promotional_video_url').files[0]);

                            fetch('/api/upload-video', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                console.log('Uploaded video URL:', data.video_url);
                                renderVideo(data.video_url);
                                // Set the hidden input value to the video URL
                                document.getElementById('video_url').value = data.video_url;
                            })
                            .catch(error => {
                                console.error('Error uploading video:', error);
                            });
                        }

                        function renderVideo(videoUrl) {
                            // Show the video container
                            document.getElementById('videoContainer').style.display = 'block';

                            // Set the source of the video element
                            let videoElement = document.getElementById('uploadedVideo');
                            videoElement.src = videoUrl;
                        }
                    </script>

                            </div>

                            <!-- Messages Tab -->
                            <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                <div class="form-group mt-3">
                                    <label for="welcome_message">Welcome Message</label>
                                    <textarea class="form-control" id="welcome_message" name="welcome_message" rows="4" required></textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="congratulations_message">Congratulations Message</label>
                                    <textarea class="form-control" id="congratulations_message" name="congratulations_message" rows="4" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create Course</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- dashboard-left-menu start  -->
    @include('instructor.inc.sidebar')

</section>


    @endsection
    @section('scripts')
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Bootstrap tabs
            $('#createCourseTabs .nav-link').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            // Add new requirement input
            $('#add-requirement').click(function() {
                $('#requirements-fields').append(`
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="requirement[]" rows="4" required></input>
                    </div>
                `);
            });

            // Add new learning objective input
            $('#add-learning-objective').click(function() {
                $('#learning-objectives-fields').append(`
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="learning_objective[]" rows="4" required></input>
                    </div>
                `);
            });
            $('#add-intendedLearner').click(function() {
                $('#intendedLearner-fields').append(`
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="intendedLearner[]" rows="4" required></input>
                    </div>
                `);
            });
        });

        function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
