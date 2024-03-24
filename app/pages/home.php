<?php
session_start();

require_once 'h_functions.php';
require_once 'database.php';

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
    <link rel="stylesheet" href="/public/css/home.css"> 
    <link rel="stylesheet" href="/public/css/cards.css"> 
</head>
<body>
    <div class="container">
        <!-- Display Songs -->
        <h2>Songs</h2>
        <section class="song-section">
            <?php foreach ($songsData as $song): ?>
               <!-- TODO: fix link problem -->
                <a href="?page=audio_player ?id=<?php echo $song['song_id']; ?>"class="audio-item-link">
                <div class="card">
                    <?php renderSongCard($song); ?>
                </div>
                </a>
            <?php endforeach; ?>
        </section>
        
        <!-- Display Videos -->
        <h2>Videos</h2>
        <section class="video-section">
            <?php foreach ($videosData as $video): ?>
                <a href="/app/pages/audio_player.php/<?php echo $video['video_id']; ?>" class="video-item-link">
                <div class="card">
                    <?php renderVideoCard($video); ?>
                </div>    
                </a>
            <?php endforeach; ?>   
        </section>

        <!-- Display Artists -->
        <h2>Artists</h2>
        <section class="artist-section">
            <?php foreach ($artistsData as $artist): ?>
                <a href="/app/pages/single_artist_view.php/<?php echo $artist['artist_id']; ?>">
                    <div class="card">
                        <?php renderArtistCard($artist); ?>
                    </div>
            <?php endforeach; ?>
        </section>

    </div>
</body>
</html>
