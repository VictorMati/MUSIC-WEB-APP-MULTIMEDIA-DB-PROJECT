<?php
require_once 'h_functions.php';
require_once 'database.php';

// session_start();

$db = new Database();
$conn = $db->connect();

// Check if the artist ID is provided in the URL
if (isset($_GET['artist_id'])) {
    $artist_id = $_GET['artist_id'];
    $artist_details = fetchArtistDetails($conn, $artist_id);
    $artist_audio = fetchArtistAudio($conn, $artist_id);
    $artist_videos = fetchArtistVideos($conn, $artist_id);
} else {
    // Handle the case when no artist is selected
    // Redirect or display an error message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $artist_details['artist_name']; ?> - Artist Page</title>
    <link rel="stylesheet" href="/public/css/artists_view.css">
</head>
<body>
    <div class="container">
        <!-- Artist Details -->
        <div class="artist-details">
            <div class="artist-image">
                <img src="<?php echo $artist_details['profile_image']; ?>" alt="<?php echo $artist_details['artist_name']; ?>">
            </div>
            <div class="artist-info">
                <h2><?php echo $artist_details['artist_name']; ?></h2>
                <p><?php echo $artist_details['description']; ?></p>
            </div>
        </div>

        <!-- Audio Section -->
        <div class="audio-section">
            <h2>Audio</h2>
            <div class="audio-list">
                <?php foreach ($artist_audio as $audio): ?>
                    <a href="/app/pages/audio_player.php/<?php echo $song['song_id']; ?>" class="audio-item-link">
                        <div class="card">
                            <?php renderSongCard($song); ?>
                        </div>    
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Video Section -->
        <div class="video-section">
            <h2>Videos</h2>
            <div class="video-list">
                <?php foreach ($artist_videos as $video): ?>
                    <a href="/app/pages/video_player.php/<?php echo $video['video_id']; ?>" class="video-item-link">
                        <div class="card">
                            <?php renderVideoCard($video); ?>
                        </div>    
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
