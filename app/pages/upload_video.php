<?php
require_once 'h_functions.php';
require_once 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data for artist
    $artist_name = $_POST['artist_name'];
    $artist_description = $_POST['artist_description'];
    $artist_country = $_POST['artist_country'];
    $artist_profile_image = $_FILES['artist_profile_image'];

    // Get form data for video
    $title = $_POST['title'];
    $resolution = $_POST['resolution'];
    $thumbnail_url = $_FILES['thumbnail_url'];
    $video_file = $_FILES['video_file'];

    // Define upload directories
    $artist_profile_image_dir = '/public/assets/images/artist_images/';
    $thumbnail_url_dir = '/public/assets/images/video_images/';
    $video_file_dir = '/public/assets/videos/';

    // File upload handling for artist profile image
    $artist_profile_image_path = '';
    if ($artist_profile_image['error'] === 0) {
        $artist_profile_image_name = $artist_profile_image['name'];
        $artist_profile_image_tmp = $artist_profile_image['tmp_name'];
        $artist_profile_image_path = $artist_profile_image_dir . $artist_profile_image_name;
        if (move_uploaded_file($artist_profile_image_tmp, $_SERVER['DOCUMENT_ROOT'] . $artist_profile_image_path)) {
            // File moved successfully
        } else {
            echo "Error moving artist profile image.";
            exit;
        }
    }

    // File upload handling for thumbnail URL
    $thumbnail_url_path = '';
    if ($thumbnail_url['error'] === 0) {
        $thumbnail_url_name = $thumbnail_url['name'];
        $thumbnail_url_tmp = $thumbnail_url['tmp_name'];
        $thumbnail_url_path = $thumbnail_url_dir . $thumbnail_url_name;
        if (move_uploaded_file($thumbnail_url_tmp, $_SERVER['DOCUMENT_ROOT'] . $thumbnail_url_path)) {
            // File moved successfully
        } else {
            echo "Error moving thumbnail image.";
            exit;
        }
    }

    // File upload handling for video file
    $video_file_path = '';
    if ($video_file['error'] === 0) {
        $video_file_name = $video_file['name'];
        $video_file_tmp = $video_file['tmp_name'];
        $video_file_path = $video_file_dir . $video_file_name;
        if (move_uploaded_file($video_file_tmp, $_SERVER['DOCUMENT_ROOT'] . $video_file_path)) {
            // File moved successfully
        } else {
            echo "Error moving video file.";
            exit;
        }
    }

    // Insert data into database
    $db = new Database();
    $conn = $db->connect();
    
    // Insert artist details
    $artist_id = insertArtist($conn, $artist_name, $artist_description, $artist_country, $artist_profile_image_path);

    // Insert video details
    if ($artist_id && insertVideo($conn, $title, $artist_id, $duration, $resolution, $thumbnail_url_path, $video_file_path)) {
        echo "<span>Video uploaded successfully!</span>";
    } else {
        echo "<span>Failed to insert data into the database.</span>";
    }
} else {
    echo "<span>Form not submitted.</span>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
    <link rel="stylesheet" href="/public/css/upload.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="upload-container">
        <form class="upload-form" action="?page=upload_video" method="POST" enctype="multipart/form-data">
        <h2>Upload Video</h2>
        <input type="text" name="artist_name" placeholder="Artist Name" required>
        <textarea name="artist_description" placeholder="Artist Description" required></textarea>
        <select name="artist_country" required>
            <option value="" disabled selected>Choose Artist Country</option>
            <option value="Kenya">Kenya</option>
            <option value="Tanzania">Tanzania</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Ghana">Ghana</option>
            <option value="South Africa">South Africa</option>
            <!-- Add more countries as needed -->
        </select>
        <input type="file" name="artist_profile_image" required>
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="resolution" placeholder="Resolution" required>
        <input type="file" name="thumbnail_url" required placeholder="Thumbnail Image">
        <input type="file" name="video_file" required placeholder="Video File">
        <button type="submit">Upload</button>
    </form>

    </div>
</body>
</html>


