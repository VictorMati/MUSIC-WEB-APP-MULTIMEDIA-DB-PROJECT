<?php 
require_once 'functions.php';
require_once 'database.php';

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
    <link rel="stylesheet" href="/public/css/videos.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <h2>Videos</h2>
        <div class="video-list">
            <?php foreach ($videos as $video): ?>
                <a href="player.php?video_id=<?php echo $video['video_id']; ?>" class="video-item-link">
                    <?php renderVideoCard($video); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
