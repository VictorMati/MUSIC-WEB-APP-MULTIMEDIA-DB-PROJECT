<?php
require_once 'h_functions.php';
require_once 'database.php';

// session_start();

$db = new Database();
$conn = $db->connect();

$selected_video = null; // Initialize $selected_video to null

// Check if the video ID is provided in the URL
if (isset($_GET['video_id'])) {
    $video_id = $_GET['video_id'];
    $selected_video = fetchVideoById($conn, $video_id);
    // Fetch artist details separately
    $artist_name = fetchArtistDetails($conn, $selected_video['artist_id']);
} else {
    // Handle the case when no video is selected
    // Redirect or display an error message
}

// Check if $selected_video is set before accessing its properties
if ($selected_video) {
    // Fetch more videos by the same artist
    $artist_videos = fetchVideosByArtist($conn, $selected_video['artist_id']);

    // Fetch videos of the same genre
    // $genre_videos = fetchVideosByGenre($conn, $selected_video['genre']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <link rel="stylesheet" href="/public/css/player.css">
    <link rel="stylesheet" href="/public/css/cards.css">
</head>
<body>
    <div class="container">
        <!-- Video Player -->
        <?php if ($selected_video): ?>
            <div class="video-player">
                <h2>Now Playing</h2>
                <video controls height="500px" width="100%" poster="/public/assets/images/default_images/poster4.jpg">
                    <source src="<?php echo $selected_video['video_file']; ?>" type="video/mp4">
                    Your browser does not support the video element.
                </video>
                <div class="video-details">
                    <h3><?php echo $selected_video['title']; ?></h3>
                    <p>Artist: <?php echo $artist_name['artist_name']; ?></p>
                    <p>Resolution: <?php echo $selected_video['resolution']; ?></p>
                </div>
            </div>

            <!-- More Videos by the Same Artist -->
            <h2>More Videos by <?php echo $artist_name['artist_name']; ?></h2>
            <div class="artist-videos">
                <?php foreach ($artist_videos as $video): ?>
                    <a href="?page=video_player&video_id=<?php echo $video['video_id']; ?>&&artist_id=<?php echo $selectedVideo['artist_id']; ?>" class="video-item-link">
                <div class="card">
                    <?php renderVideoCard($video); ?>
                </div>    
                </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No video selected.</p>
        <?php endif; ?>
    </div>
</body>
</html>
