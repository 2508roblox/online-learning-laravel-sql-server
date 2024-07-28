@extends('instructor.inc.layout')
@section('content')

<section class="admin-dashboard-section">
    <div class="admin-dashboard-right-side">

        <div class="main-header">
            <div class="header-wraper">
                <div class="row">
                    <div class="col-xl-6">
                        <span class="header-user">
                            <h3 class="text-white">Edit Course</h3>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-course-area">
            <div class="row">
                <!-- form edit -->
                <form method="POST" action="{{ route('instructor.courses.update', $course->CourseID) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">
                        <ul class="nav nav-pills" id="editCourseTabs">
                            <li class="nav-item">
                                <button class="nav-link active" id="requirements-tab" data-bs-toggle="pill" data-bs-target="#requirements">Requirements</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="details-tab" data-bs-toggle="pill" data-bs-target="#details">Details</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="messages-tab" data-bs-toggle="pill" data-bs-target="#messages">Messages</button>
                            </li>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Bootstrap tabs
        $('#editCourseTabs .nav-link').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        let requirementCounter = {{ isset($requirements) && is_array($requirements) ? count($requirements) : 0 }};
        let learningObjectiveCounter = {{ isset($learningObjectives) && is_array($learningObjectives) ? count($learningObjectives) : 0 }};
        let intendedLearnerCounter = {{ isset($intendedLearners) && is_array($intendedLearners) ? count($intendedLearners) : 0 }};

        // Add new requirement input
        $('#add-requirement').click(function() {
            requirementCounter++;
            $('#requirements-fields').append(`
                <div class="form-group mt-3" id="requirement-field-${requirementCounter}">
                    <input type="text" class="form-control" name="requirement[field${requirementCounter}]" rows="4" required></input>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeField('requirement-field-${requirementCounter}')">Remove</button>
                </div>
            `);
        });

        // Add new learning objective input
        $('#add-learning-objective').click(function() {
            learningObjectiveCounter++;
            $('#learning-objectives-fields').append(`
                <div class="form-group mt-3" id="learning-objective-field-${learningObjectiveCounter}">
                    <input type="text" class="form-control" name="learning_objective[field${learningObjectiveCounter}]" rows="4" required></input>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeField('learning-objective-field-${learningObjectiveCounter}')">Remove</button>
                </div>
            `);
        });

        // Add new intended learner input
        $('#add-intendedLearner').click(function() {
            intendedLearnerCounter++;
            $('#intendedLearner-fields').append(`
                <div class="form-group mt-3" id="intendedLearner-field-${intendedLearnerCounter}">
                    <input type="text" class="form-control" name="intendedLearner[field${intendedLearnerCounter}]" rows="4" required></input>
                    <button type="button" class="btn btn-danger mt-2" onclick="removeField('intendedLearner-field-${intendedLearnerCounter}')">Remove</button>
                </div>
            `);
        });
    });

    function removeField(fieldId) {
        $(`#${fieldId}`).remove();
    }

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
            </ul>
                        <div class="tab-content mt-3">
                            <!-- Requirements Tab -->
                            <div class="tab-pane fade show active" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
                                <div id="requirements-fields">
                                    @forelse(($requirements ?? []) as $requirement)
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="requirement[]" value="{{ $requirement }}" rows="4" required>
                                    </div>
                                    @empty
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="requirement[]" value="" rows="4" required>
                                    </div>
                                    @endforelse
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-requirement">+</button>

                                <div id="intendedLearner-fields">
                                    @forelse(($intendedLearners ?? []) as $learner)
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="intendedLearner[]" value="{{ $learner }}" rows="4" required>
                                    </div>
                                    @empty
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="intendedLearner[]" value="" rows="4" required>
                                    </div>
                                    @endforelse
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-intendedLearner">+</button>

                                <div id="learning-objectives-fields">
                                    @forelse(($learningObjectives ?? []) as $objective)
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="learning_objective[]" value="{{ $objective }}" rows="4" required>
                                    </div>
                                    @empty
                                    <div class="form-group mt-3">
                                        <input type="text" class="form-control" name="learning_objective[]" value="" rows="4" required>
                                    </div>
                                    @endforelse
                                </div>
                                <button type="button" class="btn btn-secondary mt-3" id="add-learning-objective">+</button>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    let requirementCounter = {{ isset($requirements) && is_array($requirements) ? count($requirements) : 0 }};
                                    let learningObjectiveCounter = {{ isset($learningObjectives) && is_array($learningObjectives) ? count($learningObjectives) : 0 }};
                                    let intendedLearnerCounter = {{ isset($intendedLearners) && is_array($intendedLearners) ? count($intendedLearners) : 0 }};

                                    // Add new requirement input
                                    $('#add-requirement').click(function() {
                                        requirementCounter++;
                                        $('#requirements-fields').append(`
                                            <div class="form-group mt-3" id="requirement-field-${requirementCounter}">
                                                <input type="text" class="form-control" name="requirement[field${requirementCounter}]" rows="4" required>
                                                <button type="button" class="btn btn-danger mt-2" onclick="removeField('requirement-field-${requirementCounter}')">Remove</button>
                                            </div>
                                        `);
                                    });

                                    // Add new learning objective input
                                    $('#add-learning-objective').click(function() {
                                        learningObjectiveCounter++;
                                        $('#learning-objectives-fields').append(`
                                            <div class="form-group mt-3" id="learning-objective-field-${learningObjectiveCounter}">
                                                <input type="text" class="form-control" name="learning_objective[field${learningObjectiveCounter}]" rows="4" required>
                                                <button type="button" class="btn btn-danger mt-2" onclick="removeField('learning-objective-field-${learningObjectiveCounter}')">Remove</button>
                                            </div>
                                        `);
                                    });

                                    // Add new intended learner input
                                    $('#add-intendedLearner').click(function() {
                                        intendedLearnerCounter++;
                                        $('#intendedLearner-fields').append(`
                                            <div class="form-group mt-3" id="intendedLearner-field-${intendedLearnerCounter}">
                                                <input type="text" class="form-control" name="intendedLearner[field${intendedLearnerCounter}]" rows="4" required>
                                                <button type="button" class="btn btn-danger mt-2" onclick="removeField('intendedLearner-field-${intendedLearnerCounter}')">Remove</button>
                                            </div>
                                        `);
                                    });
                                });

                                function removeField(fieldId) {
                                    $(`#${fieldId}`).remove();
                                }

                                function previewImage(event) {
                                    var reader = new FileReader();
                                    reader.onload = function() {
                                        var output = document.getElementById('image-preview');
                                        output.src = reader.result;
                                        output.style.display = 'block';
                                    };
                                    reader.readAsDataURL(event.target.files[0]);
                                }
                            </script>


                            <!-- Details Tab -->
                            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="form-group mt-3">
                                    <label for="topic_id">Topic</label>

                                    <select class="form-control" id="topic_id" name="topic_id" required>

                                        @foreach($topics as $topic)
                                            <option value="{{ $topic->TopicID }}" {{ $topic->TopicID == $course->TopicID ? 'selected' : '' }}>
                                                {{ $topic->Name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group mt-3">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $course->Title }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="subtitle">Subtitle</label>
                                    <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $course->Subtitle }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $course->Description }}</textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="language">Language</label>
                                    <input type="text" class="form-control" id="language" name="language" value="{{ $course->Language }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $course->Price }}" required placeholder="$">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level" name="level" value="{{ $course->Level }}" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="image_url">Image</label>
                                    <input type="file" class="form-control" id="image_url" name="image" onchange="previewImage(event)">
                                    <img id="image-preview" src="{{ asset('storage/' . $course->ImageURL) }}" alt="Image Preview" style="display: block; width: 100px; height: auto; margin-top: 10px;">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="promotional_video_url">Promotional Video</label>
                                    <input type="file" class="form-control" id="promotional_video_url" name="video" onchange="uploadVideo()">
                                    <input type="hidden" id="video_url" name="video_url" value="{{ $course->PromotionalVideoURL }}">
                                </div>
                                <div id="videoContainer" style="display: block; width: 300px;">
                                    <video id="uploadedVideo" controls style="width: 300px;">

                                        <source src="{{ $course->PromotionalVideoURL }}" type="video/mp4">
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
                                            document.getElementById('video_url').value = data.video_url;
                                        })
                                        .catch(error => {
                                            console.error('Error uploading video:', error);
                                        });
                                    }

                                    function renderVideo(videoUrl) {
                                        document.getElementById('videoContainer').style.display = 'block';
                                        let videoElement = document.getElementById('uploadedVideo');
                                        videoElement.src = videoUrl;
                                    }
                                </script>
                            </div>
                            <?php
                            $messages = json_decode($course->Message, true);
                            $welcome_message = isset($messages['welcome_message']) ? $messages['welcome_message'] : '';
                            $congratulations_message = isset($messages['congratulations_message']) ? $messages['congratulations_message'] : '';
                            ?>


                            <!-- Messages Tab -->
                            <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                <div class="form-group mt-3">
                                    <label for="welcome_message">Welcome Message</label>
                                    <textarea class="form-control" id="welcome_message" name="welcome_message" rows="4" required>{{ $welcome_message }}</textarea>

                                </div>
                                <div class="form-group mt-3">
                                    <label for="congratulations_message">Congratulations Message</label>
                                    <textarea class="form-control" id="congratulations_message" name="congratulations_message" rows="4" required>{{ $congratulations_message }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- dashboard-left-menu start -->
    @include('instructor.inc.sidebar')
</section>

@endsection
@section('scripts')




@endsection
