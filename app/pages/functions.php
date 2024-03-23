<?php 

require_once 'database.php'; // Include the database file


function renderSongCard($song) {
    echo '<div class="song-card">';
    echo '<img src="' . $song['cover_image'] . '" alt="' . $song['title'] . '">';
    echo '<div class="song-info">';
    echo '<h3>' . $song['title'] . '</h3>';
    echo '<p>' . $song['artist_name'] . '</p>';
    // echo '<p>' . $song['duration'] . '</p>';
    echo '<p>' . $song['release_year'] . '</p>';
    echo '</div>';
    echo '</div>';
}


function renderVideoCard($video) {
    echo '<div class="video-card">';
    echo '<img src="' . $video['thumbnail_url'] . '" alt="' . $video['title'] . '">';
    echo '<div class="card-info">';
    echo '<h3>' . $video['title'] . '</h3>';
    echo '<p>' . $video['artist_name'] . '</p>';
    echo '<p>' . $video['duration'] . '</p>';
    echo '<p>' . $video['resolution'] . '</p>';
    echo '</div>';
    echo '</div>';
}

function renderArtistCard($artist) {
    echo '<div class="artist-card">';
    echo '<img src="' . $artist['profile_image'] . '" alt="' . $artist['artist_name'] . '">';
    echo '<div class="card-info">';
    echo '<h3>' . $artist['artist_name'] . '</h3>';
    // echo '<p>Description: ' . $artist['description'] . '</p>';
    echo '<p>' . $artist['country'] . '</p>';
    echo '</div>';
    echo '</div>';
}


function fetchSongs($conn) {

    $db = new Database();
    $conn = $db->connect();

    $sql = "SELECT s.song_id, s.title, s.duration, s.genre, s.cover_image, s.audio_file, s.release_year, a.artist_name FROM songs s
            INNER JOIN artists a ON s.artist_id = a.artist_id";
    $result = $conn->query($sql);

    $songsData = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songsData[] = $row;
        }
    }
    return $songsData;
}

function fetchVideos($conn) {

    $db = new Database();
    $conn = $db->connect();

    $sql = "SELECT v.video_id, v.title, v.duration, v.resolution, v.thumbnail_url, v.video_file, a.artist_name FROM videos v
            INNER JOIN artists a ON v.artist_id = a.artist_id";
    $result = $conn->query($sql);

    $videosData = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $videosData[] = $row;
        }
    }
    return $videosData;
}

function fetchArtists($conn) {

    $db = new Database();
    $conn = $db->connect();

    $sql = "SELECT * FROM artists";
    $result = $conn->query($sql);

    $artistsData = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $artistsData[] = $row;
        }
    }
    return $artistsData;
}

function searchSongs($conn, $searchTerm) {
    // Prepare SQL statement to search for songs
    $sql = "SELECT * FROM songs WHERE title LIKE ? OR artist_name LIKE ? OR release_year = ? OR genre LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$searchTerm%"; // Add wildcards for partial matching
    $stmt->bind_param("ssis", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $searchResults = [];
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }

    return $searchResults;
}



function test_input($data) {
    // Sanitize user input
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function register($conn, $name, $email, $password) {
    // Check if connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate and sanitize user inputs
    $name = test_input($name);
    $email = test_input($email);
    $password = test_input($password);

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO User (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Registration successful
        return true;
    } else {
        // Registration failed
        return false;
    }
}

function login($conn, $email, $password) {
    // Check if connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate and sanitize user inputs
    $email = test_input($email);
    $password = test_input($password);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT user_id, username, password FROM User WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Start a session and store user data
            session_start();
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_name"] = $row["username"];
            $_SESSION["user_email"] = $email;
            // Login successful
            return true;
        } else {
            // Invalid password
            return false;
        }
    } else {
        // User not found
        return false;
    }
}

function logout() {
    // Destroy the session upon logout
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}

function isLoggedIn() {
    // Check if the user is logged in
    session_start();
    if (isset($_SESSION["user_id"])) {
        return true;
    } else {
        return false;
    }
}
?>



