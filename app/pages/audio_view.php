
<?php 
require_once 'functions.php';
require_once 'database.php';

$db = new Database();
$conn = $db->connect();

$audioSongs = fetchSongs($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio View</title>
    <link rel="stylesheet" href="/public/css/audio.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <h2>Audio Songs</h2>
        <div class="audio-list">
            <?php foreach ($audioSongs as $song): ?>
                <a href="player.php?song_id=<?php echo $song['song_id']; ?>" class="audio-item-link">
                    <?php renderSongCard($song); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
