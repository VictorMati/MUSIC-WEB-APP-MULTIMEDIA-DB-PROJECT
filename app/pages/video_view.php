<?php 
require_once 'h_functions.php';
require_once 'database.php';

// session_start();

$db = new Database();
$conn = $db->connect();

$videos = fetchVideos($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos View</title>
    <link rel="stylesheet" href="/public/css/videos.css"> 
    <link rel="stylesheet" href="/public/css/cards.css"> 
<body>
    <div class="container">
        <h2>Video Songs</h2>
        <div class="video-list">
            <?php foreach ($videos as $video): ?>
                <a href="/app/pages/audio_player.php/<?php echo $video['video_id']; ?>" class="video-item-link">
                <div class="card">
                    <?php renderVideoCard($video); ?>
                </div>    
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
