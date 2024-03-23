<?php
require_once 'functions.php';
require_once 'database.php';

$db = new Database();
$conn = $db->connect();

// Fetch all artists data
$artistsData = fetchArtists($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
    <link rel="stylesheet" href="/public/css/artists_view.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <h2>Artists</h2>
        <div class="artist-grid">
            <?php foreach ($artistsData as $artist): ?>
                <?php renderArtistCard($artist); ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
