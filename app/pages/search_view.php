<?php
require_once 'functions.php';
require_once 'database.php';

$db = new Database();
$conn = $db->connect();

// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = test_input($_POST["search_term"]);
    $searchResults = searchSongs($conn, $searchTerm);
} else {
    // Default search results
    $searchResults = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="/public/css/search.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <h2>Search</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="search_term" placeholder="Enter search term">
            <button type="submit">Search</button>
        </form>

        <div class="search-results">
            <?php if (!empty($searchResults)) : ?>
                <h3>Search Results:</h3>
                <?php foreach ($searchResults as $song): ?>
                    <?php renderSongCard($song); ?>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No results found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
