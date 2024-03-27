
<?php 
require_once 'h_functions.php';
require_once 'database.php';

// session_start();

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
    <link rel="stylesheet" href="/public/css/audio.css">
    <link rel="stylesheet" href="/public/css/cards.css">
</head>
<body>
    <div class="container">
        <h2>Audio Songs</h2>
        <div class="audio-list">
            <?php foreach ($audioSongs as $song): ?>
            <a href="?page=audio_player&song_id=<?php echo $song['song_id']; ?>" class="audio-item-link">
                <div class="card">
                    <?php renderSongCard($song); ?>
                </div>    
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
