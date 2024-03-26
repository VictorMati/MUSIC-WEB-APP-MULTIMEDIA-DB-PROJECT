<?php
require_once 'h_functions.php';
require_once 'database.php';

// session_start();

// // Check if the user is not logged in, then redirect to the login page
// // if (!isset($_SESSION['user_id'])) {
// //     header("Location: ?page=login");
// //     exit();
// // }

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
    <link rel="stylesheet" href="/public/css/artists_view.css">
    <link rel="stylesheet" href="/public/css/cards.css">
     <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <h2>Artists</h2>
        <div class="artist-grid">
            <?php foreach ($artistsData as $artist): ?>
                <a href="/app/pages/single_artist_view.php/<?php echo $artist['artist_id']; ?>">
                    <div class="card">
                        <?php renderArtistCard($artist); ?>
                    </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
