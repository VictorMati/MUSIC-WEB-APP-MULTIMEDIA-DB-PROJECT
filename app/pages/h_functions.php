<?php 

require_once 'database.php'; // Include the database file


function renderSongCard($song) {
    echo '<div class="song-card">';
    echo '<img src="' . $song['cover_image'] . '" alt="' . $song['title'] . '">';
    echo '<div class="song-info">';
    echo '<h3>'. $song['artist_name'] ." - ". $song['title'] . '</h3>';
    // echo '<p>' . $song['artist_name'] . '</p>';
    // echo '<p>' . $song['duration'] . '</p>';
    echo '<p>' . $song['genre'] . '</p>';
    echo '<p>' . $song['release_year'] . '</p>';
    echo '</div>';
    echo '</div>';
}


function renderVideoCard($video) {
    echo '<div class="video-card">';
    echo '<img src="' . $video['thumbnail_url'] . '" alt="' . $video['title'] . '">';
    echo '<div class="card-info">';
    echo '<h3>' . $video['artist_name'] ." - ". $video['title'] . '</h3>';
    // echo '<p>' . $video['artist_name'] . '</p>';
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

function fetchSongsByArtist($conn, $artist_id) {
    $sql = "SELECT * FROM songs WHERE artist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $songs = [];
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
    return $songs;
}

function fetchSongsByGenre($conn, $genre) {
    $sql = "SELECT * FROM songs WHERE genre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();

    $songs = [];
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row;
    }
    return $songs;
}

function fetchSongById($conn, $song_id) {
    $sql = "SELECT * FROM songs WHERE song_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $song_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        // Handle the case when no song is found
        return null;
    }
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


function fetchVideoById($conn, $video_id) {
    $sql = "SELECT * FROM videos WHERE video_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $video_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function fetchVideosByArtist($conn, $artist_id) {
    $sql = "SELECT * FROM videos WHERE artist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $videos = [];
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
    return $videos;
}

function fetchVideosByGenre($conn, $genre) {
    $sql = "SELECT * FROM videos WHERE genre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();
    $videos = [];
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
    return $videos;
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

function fetchArtistDetails($conn, $artist_id) {
    $sql = "SELECT * FROM artists WHERE artist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        // Handle the case when no artist is found with the given ID
        return null;
    }
}

function fetchArtistAudio($conn, $artist_id) {
    $sql = "SELECT * FROM songs WHERE artist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $audio_tracks = array();
    while ($row = $result->fetch_assoc()) {
        $audio_tracks[] = $row;
    }
    return $audio_tracks;
}

function fetchArtistVideos($conn, $artist_id) {
    $sql = "SELECT * FROM videos WHERE artist_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $artist_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $videos = array();
    while ($row = $result->fetch_assoc()) {
        $videos[] = $row;
    }
    return $videos;
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
    
    // Initializing variables to store user registration data
    $nameErr = $emailErr = $passwordErr = "";
    
 
    
        // If no validation errors, proceed with the registration
        if (empty($nameErr) && empty($emailErr) && empty($passwordErr)) {
    
            // Encrypt the password for security purposes
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Insert user data into the database
            $sql = "INSERT INTO user (username, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    
            if ($conn->query($sql) === TRUE) {
                // Registration successful
                return true;
            } else {
                
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
            $conn->close();
        }
}

function login($conn, $email, $password) {
    //initialize variables for error handling
    $emailErr = $passwordErr = "";
    $loginErr = "";

        // If no validation errors, proceed with login
        if (empty($emailErr) && empty($passwordErr)) {

            // Fetch user data from the database
            $sql = "SELECT user_id, username, email, password FROM user WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                // Verify the password
                if (password_verify($password, $row["password"])) {
                    // Start a session and store user data
                    session_start();
                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["user_name"] = $row["username"];
                    $_SESSION["user_email"] = $row["email"];

                    // Login successful
                    return true;

                } else {

                    return false;
                }
            } else {
                $loginErr = "User not found\n<a> href='\pages\profile.php'>forgot your password?</a>";  
            }
            $conn->close();
        }

}


function logout() {
    // Destroy the session upon logout
    session_start();
    session_destroy();
    header("Location: home.php");
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



