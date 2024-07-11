<?
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Routing\Route;

Route::post('/upload-video', function (Request $request) {
    $request->validate([
        'video' => 'required|mimes:mp4,mov,avi|max:204800', // Adjust max file size as needed
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
