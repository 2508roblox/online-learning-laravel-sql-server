@extends('instructor.inc.layout')

@section('content')

<section class="admin-dashboard-section py-5">
    <div class="container">
        <h3>Edit Lecture</h3>
        <form action="{{ route('instructor.curriculums.lecture.update', $lecture->LectureID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="CurriculumItemID" value="{{ $lecture->CurriculumItemID }}">

            <div class="form-group mb-3">
                <label for="Duration">Duration</label>
                <input type="text" class="form-control" id="Duration" name="Duration" value="{{ $lecture->Duration }}" required>
            </div>

            <div class="form-group mt-3 mb-4">
                <label for="promotional_video_url">Lecture Video</label>
                <input type="file" class="form-control" id="promotional_video_url" name="video" onchange="uploadVideo()" required>
            </div>

            <div id="loading-icon" style="display: none;">
                <img src="{{ asset('H8An.gif') }}" alt="Loading" width="50" height="50">
            </div>

            <input type="hidden" id="video_url" name="video_url" value="{{ $lecture->Content }}">

            <div id="videoContainer" style="display: {{ $lecture->Content ? 'block' : 'none' }}; width: 300px;">
                <video id="uploadedVideo" controls style="width: 300px;">
                    <source src="{{ $lecture->Content }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="form-group mb-3">
                <label for="Content">Content</label>
                <textarea class="form-control" id="Content" name="Content" rows="5" required>{{ $lecture->Content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Lecture</button>
        </form>
    </div>

    @include('instructor.inc.sidebar')
</section>

<script>
    function uploadVideo() {
        // Show the loading icon
        document.getElementById('loading-icon').style.display = 'block';

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
            // Set the content field value to the video URL
            document.getElementById('Content').value = data.video_url;
            // Hide the loading icon
            document.getElementById('loading-icon').style.display = 'none';
        })
        .catch(error => {
            console.error('Error uploading video:', error);
            // Hide the loading icon
            document.getElementById('loading-icon').style.display = 'none';
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

@endsection
