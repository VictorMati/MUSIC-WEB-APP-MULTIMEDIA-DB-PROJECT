<!-- header.php -->
<?php
// require_once("C:\Users\hp\Documents\DataBase\MULTIMEDIA-DB-PROJECT\app\pages\h_functions.php");
// require_once("C:\Users\hp\Documents\DataBase\MULTIMEDIA-DB-PROJECT\app\pages\database.php");

// $db = new Database();
// $conn = $db->connect();

// // Check if the search form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["q"])) {
//     $searchTerm = test_input($_POST["q"]);
//     $searchResults = searchSongs($conn, $searchTerm);
// } else {
//     // Default search results
//     $searchResults = [];
// }

// ?>

<header>
    <div class="logo-container">
        <div class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </div>
        <div class="logo">
            <a href="?page=home">HarmonyVibe</a>
        </div>
    </div>


    <div class="search-bar">
        <form action="?page=search" method="POST">
            <input type="text" id="search-input" name="q" placeholder="Search for songs" autocomplete="off">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="search-results" id="search-results-container"></div> 
    </div>


    <div class="profile">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="?page=profile">
                <img src="<?php echo $_SESSION['avatar'] ?? 'assets\images\default_images\no music.jpg'; ?>" alt="Profile Image">
            </a>
        <?php else : ?>
            <a href="?page=login" class="login-button">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        <?php endif; ?>
    </div>

</header>
