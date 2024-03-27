
<aside class="sidebar">
    
        <div class="user-profile">
            <img src="/public/assets/images/default_images/Letter H.jpg" alt="User Avatar">
            <p>Welcome, <?php echo $_SESSION['user_name'] ?? 'Guest'; ?>!</p>
        </div>

        <nav class="sidebar-navigation">
            <ul>
                <li><a href="?page=home"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="?page=search"><i class="fas fa-search"></i> Search</a></li>
                <li><a href="?page=artists_view"><i class="fas fa-users"></i> Artists</a></li>
                <li><a href="?page=audio_view"><i class="fas fa-music"></i> Audio</a></li>
                <li><a href="?page=video_view"><i class="fas fa-video"></i> Video</a></li>
                <li><a href="?page=upload_audio"><i class="fas fa-upload"></i> Upload Audio</a></li>
                <li><a href="?page=upload_video"><i class="fas fa-upload"></i> Upload Video</a></li>
            </ul>
        </nav>
        <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="logout">
            <a href="?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    <?php else : ?>
        <div class="logout">
            <a href="?page=login"><i class="fas fa-sign-in-alt"></i> Login</a>
        </div>
    <?php endif; ?>
</aside>
