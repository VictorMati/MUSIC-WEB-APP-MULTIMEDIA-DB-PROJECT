<?php
require_once 'functions.php';
require_once 'database.php';

// Start the session
// session_start();

// Check if the user is not logged in, then redirect to the login page
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();
// }

// Proceed with fetching data if the user is logged in
$db = new Database();
$conn = $db->connect();
$songsData = fetchSongs($conn);
$videosData = fetchVideos($conn);
$artistsData = fetchArtists($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyVibe-home</title>
    <link rel="stylesheet" href="/public/css/home.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <!-- Display Songs -->
        <h2>Songs</h2>
        <section class="song-section">
            <?php foreach ($songsData as $song): ?>
                <div class="card">
                    <?php renderSongCard($song); ?>
                </div>
            <?php endforeach; ?>
        </section>
        
        <!-- Display Videos -->
        <h2>Videos</h2>
        <section class="video-section">
            <?php foreach ($videosData as $video): ?>
                <div class="card">
                    <?php renderVideoCard($video); ?>
                </div>
            <?php endforeach; ?>   
        </section>

        <!-- Display Artists -->
        <h2>Artists</h2>
        <section class="artist-section">
            <?php foreach ($artistsData as $artist): ?>
                <div class="card">
                    <?php renderArtistCard($artist); ?>
                </div>
            <?php endforeach; ?>
        </section>

    </div>
</body>
</html>
