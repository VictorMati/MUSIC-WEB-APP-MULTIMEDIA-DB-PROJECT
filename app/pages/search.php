<!-- search.php -->

<?php
// Include necessary files and configurations
require_once 'database.php';
require_once 'h_functions.php';

$db = new Database();
$conn = $db->connect();

// Check if a search query is present
if (isset($_GET['q'])) {
    $searchQuery = '%' . $_GET['q'] . '%';

    $searchResults = searchSongs($conn, $searchQuery);



    echo '<main>';
    echo '<section class="search-results">';
    echo '<h3>Search Results for: ' . htmlspecialchars($_GET['q']) . '</h3>';

    if (!empty($searchResults)) {
        foreach ($searchResults as $result) {
            echo '<div class="search-result">';
            echo '<img src="' . $result['cover_image'] . '" alt="' . $result['title'] . '">';
            echo '<h3>' . $result['title'] . '</h3>';
            echo '<p>' . $result['artist'] . '</p>';
            // Add more result details or controls as needed
            echo '</div>';
        }
    } else {
        echo '<p>No results found for: ' . htmlspecialchars($_GET['q']) . '</p>';
    }

    echo '</section>';
    echo '</main>';
}
?>
