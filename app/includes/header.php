<!-- header.php -->

<link rel="stylesheet" href="/public/css/header.css">

<header>
    <div class="logo">
        <a href="?page=home">HarmonyVibe</a>
    </div>

    <div class="search-bar">
        <form action="?page=search" method="GET">
            <input type="text" id="search-input" name="search_term" placeholder="Search for songs" autocomplete="off">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="search-suggestions" id="search-suggestions-container"></div> 
    </div>


    <div class="profile">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="?page=profile">
                <img src="<?php echo $_SESSION['avatar'] ?? 'assets\images\default_images\no music.jpg'; ?>" alt="Profile Image">
            </a>
        <?php else : ?>
            <button id="login-button" onclick="">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        <?php endif; ?>
    </div>

</header>

<script src="/public/js/search.js"></script>