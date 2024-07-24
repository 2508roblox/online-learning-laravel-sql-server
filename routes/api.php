<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

Route::post('/upload-video', function (Request $request) {

    $request->validate([
        'video' => 'required|max:204800', // Adjust max file size as needed
    ]);

    $uploadedFile = $request->file('video');

    // Upload video to Cloudinary
    $uploadedVideo = Cloudinary::upload($uploadedFile->getRealPath(), [
        'resource_type' => 'video',
    ]);
    // Return the public URL of the uploaded video
    return response()->json([
        'video_url' => $uploadedVideo->getSecurePath(),
    ]);
});
