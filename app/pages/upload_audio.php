<?php
require_once 'h_functions.php';
require_once 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $artist = $_POST['artist'];
    $genre = $_POST['genre'];
    $cover_image = $_FILES['cover_image'];
    $audio_file = $_FILES['audio_file'];
    $title = $_POST['title'];
    $release_year = $_POST['release_year'];

    // File upload handling for cover image
    $cover_image_path = '';
    if ($cover_image['error'] === 0) {
        $cover_image_name = $cover_image['name'];
        $cover_image_tmp = $cover_image['tmp_name'];
        $cover_image_path = '/public/assets/images/song_images/' . $cover_image_name;
        move_uploaded_file($cover_image_tmp, $cover_image_path);
    }

    // File upload handling for audio file
    $audio_file_path = '';
    if ($audio_file['error'] === 0) {
        $audio_file_name = $audio_file['name'];
        $audio_file_tmp = $audio_file['tmp_name'];
        $audio_file_path = '/public/assets/audio/' . $audio_file_name;
        move_uploaded_file($audio_file_tmp, $audio_file_path);
    }

    // Insert data into database
    $db = new Database();
    $conn = $db->connect();
    if (insertAudioSong($conn, $title, $artist, $genre, $release_year, $cover_image_path, $audio_file_path)) {
        echo "Audio song uploaded successfully!";
    } else {
        echo "Error: Failed to insert data into the database.";
    }
} else {
    echo "Error: Form not submitted.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Audio</title>
    <link rel="stylesheet" href="/public/css/upload.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="upload-container">
        <form class="upload-form" action="?page=upload_audio" method="POST" enctype="multipart/form-data">
            <h2>Upload Audio Song</h2>
            <input type="text" name="artist" placeholder="Artist" required>
            <select name="genre" required>
                <option value="" disabled selected>Select Genre</option>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
                <option value="Hip Hop">Hip Hop</option>
                <!-- Add more genre options as needed -->
            </select>
            <input type="file" name="cover_image" required>
            <input type="file" name="audio_file" required>
            <input type="text" name="title" placeholder="Title" required>
            <input type="text" name="release_year" placeholder="Release Year" required>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>

