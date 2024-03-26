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

    // Get form data for song
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $cover_image = $_FILES['cover_image'];
    $audio_file = $_FILES['audio_file'];

    // Define upload directories
    $artist_profile_image_dir = '/public/assets/images/artist_images/';
    $cover_image_dir = '/public/assets/images/song_images/';
    $audio_file_dir = '/public/assets/audio/';

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

    // File upload handling for cover image
    $cover_image_path = '';
    if ($cover_image['error'] === 0) {
        $cover_image_name = $cover_image['name'];
        $cover_image_tmp = $cover_image['tmp_name'];
        $cover_image_path = $cover_image_dir . $cover_image_name;
        if (move_uploaded_file($cover_image_tmp, $_SERVER['DOCUMENT_ROOT'] . $cover_image_path)) {
            // File moved successfully
        } else {
            echo "Error moving cover image.";
            exit;
        }
    }

    // File upload handling for audio file
    $audio_file_path = '';
    if ($audio_file['error'] === 0) {
        $audio_file_name = $audio_file['name'];
        $audio_file_tmp = $audio_file['tmp_name'];
        $audio_file_path = $audio_file_dir . $audio_file_name;
        if (move_uploaded_file($audio_file_tmp, $_SERVER['DOCUMENT_ROOT'] . $audio_file_path)) {
            // File moved successfully
        } else {
            echo "<span>Error moving audio file.</span>";
            exit;
        }
    }

    // Insert data into database
    $db = new Database();
    $conn = $db->connect();
    
    // Insert artist details
    $artist_id = insertArtist($conn, $artist_name, $artist_description, $artist_country, $artist_profile_image_path);

    // Insert song details
    if ($artist_id && insertAudioSong($conn, $title, $artist_id, $genre, $cover_image_path, $audio_file_path, $release_year)) {
        echo "<span>Audio song uploaded successfully!</span>";
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
    <title>Upload Audio</title>
    <link rel="stylesheet" href="/public/css/upload.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="upload-container">
        <form class="upload-form" action="?page=upload_audio" method="POST" enctype="multipart/form-data">
            <h2>Upload Audio Song</h2>
            <input type="text" name="artist_name" placeholder="Artist Name" required>
            <textarea name="artist_description" placeholder="Artist Description" required></textarea>
            <select name="artist_country" required>
                <option value="" disabled selected>Choose Artist Country</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                <!-- Add more countries as needed -->
            </select>
            <input type="file" name="artist_profile_image" required>
            <input type="text" name="title" placeholder="Title" required>
            <select name="genre" required>
                <option value="" disabled selected>Choose Genre</option>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
                <option value="Hip Hop">Hip Hop</option>
                <!-- Add more genres as needed -->
            </select>
            <input type="text" name="release_year" placeholder="Release Year" required>
            <input type="file" name="cover_image" required placeholder="Cover Image">
            <input type="file" name="audio_file" required placeholder="Audio File">
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>


