<?php
require_once 'h_functions.php';
require_once 'database.php';

session_start();

$db = new Database();
$conn = $db->connect();

$selected_song = null; // Initialize $selected_song to null

// Check if the song ID is provided in the URL
if (isset($_GET['song_id'])) {
    $song_id = $_GET['song_id'];
    $selected_song = fetchSongById($conn, $song_id);
} else {
    // Handle the case when no song is selected
    // Redirect or display an error message
}

// Check if $selected_song is set before accessing its properties
if ($selected_song) {
    // Fetch more songs by the same artist
    $artist_songs = fetchSongsByArtist($conn, $selected_song['artist_id']);

    // Fetch songs of the same genre
    $genre_songs = fetchSongsByGenre($conn, $selected_song['genre']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Player</title>
    <link rel="stylesheet" href="/public/css/player.css">
    <link rel="stylesheet" href="/public/css/cards.css">
</head>
<body>
    <div class="container">
        <!-- Audio Player -->
        <div class="audio-player">
            <h2>Now Playing</h2>
            <?php if ($selected_song): ?>
                <audio controls>
                    <source src="<?php echo $selected_song['audio_file']; ?>" type="audio/mp3">
                    Your browser does not support the audio element.
                </audio>
                <div class="song-details">
                    <h3><?php echo $selected_song['title']; ?></h3>
                    <p>Artist: <?php echo $selected_song['artist_name']; ?></p>
                    <p>Duration: <?php echo $selected_song['duration']; ?></p>
                </div>
            <?php else: ?>
                <p>No song selected.</p>
            <?php endif; ?>
        </div>

        <!-- More Songs by the Same Artist -->
        <?php if ($selected_song): ?>
            <h2>More Songs by <?php echo $selected_song['artist_name']; ?></h2>
            <div class="artist-songs">
                <?php foreach ($artist_songs as $song): ?>
                    <?php renderSongCard($song); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Songs of the Same Genre -->
        <?php if ($selected_song): ?>
            <h2>Songs of <?php echo $selected_song['genre']; ?> Genre</h2>
            <div class="genre-songs">
                <?php foreach ($genre_songs as $song): ?>
                    <?php renderSongCard($song); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
