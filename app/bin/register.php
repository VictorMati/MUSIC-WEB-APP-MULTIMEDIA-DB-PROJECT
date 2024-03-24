<?php 
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
    $stmt = $conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Registration successful
        echo '<div class="success-message">Signup successful. You are now logged in.</div>';
        session_start();
        $_SESSION["user_name"] = $name; // Use $name variable
        $_SESSION["user_email"] = $email;
        return true;
    } else {
        // Registration failed
        echo '<div class="error-message">Registration failed. Please try again.</div>';
        return false;
    }
}

function login($conn, $email, $password) {
    // Check if connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize the $name variable
    $name = "";

    // Validate and sanitize user inputs
    $email = test_input($email);
    $password = test_input($password);

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT user_id, username, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["username"]; // Assign username to $name variable
        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Start a session and store user data
            session_start();
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_name"] = $name; // Use $name variable
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

?>

