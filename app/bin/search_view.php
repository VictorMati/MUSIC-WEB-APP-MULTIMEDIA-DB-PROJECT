<?php
require_once 'h_functions.php';
require_once 'database.php';

$db = new Database();
$conn = $db->connect();

$searchTerm = $_GET['search-term'] ?? '';

if (!empty($searchTerm)) {
    $searchResults = searchSongs($conn, $searchTerm);
} else {
    $searchResults = [];
}

echo json_encode(['searchResults' => $searchResults]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="/public/css/search.css">
    <link rel="stylesheet" href="/public/css/cards.css"> 
</head>
<body>
    <div class="container">
        <div class="search-results">
            <?php if (!empty($searchResults)) : ?>
                <h3>Search Results:</h3>
                <?php foreach ($searchResults as $song): ?>
                    <div class="card">
                        <?php renderSongCard($song); ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
