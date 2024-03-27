<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarmonyVibe-Entertainment</title>
    <link rel="stylesheet" href="/public/css/index.css">
    <link rel="stylesheet" href="/public/css/header.css">
    <link rel="stylesheet" href="/public/css/sidebar.css">
    <link rel="stylesheet" href="/public/css/search.css">

    <link rel="icon" href="/public/assets/images/default_images/Letter H.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <div class="sidebar-container">
            <?php include("../app/includes/sidebar.php"); ?>
        </div>

        <div class="main-container">
        <header>
            <?php include("../app/includes/header.php"); ?>
        </header>
            <?php
            // Include the main content based on the requested page
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';

            $allowedPages = ['home', 'login', 'register', 'audio_view', 'video_view', 'artists_view', 'search', 'single_artist_view', 'audio_player', 'video_player', 'upload_audio', 'upload_video'];

            if (in_array($page, $allowedPages)) {
                include("../app/pages/" . $page . ".php");
            } else {
                // Handle 404 or redirect to a default page
                include '../app/pages/404.php';
            }
            include_once '../app/includes/footer.php';
            ?>
        </div>
    </main>
    <script src="/public/js/search.js"></script>
    <script src="/public/js/sidebartoggle.js"></script>
</body>

</html>
