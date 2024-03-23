<?php 
    // Destroy the session upon logout
    session_start();
    session_destroy();
    header("Location: home.php");
    exit();
?>