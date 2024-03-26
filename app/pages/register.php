<?php 
require_once 'h_functions.php';
require_once 'database.php';

// Initialize variables to hold error messages
$nameErr = $emailErr = $passwordErr = $registrationSuccess = "";

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

        // Validate username
        if (empty($name)) {
            $nameErr = "Name is required";
        }
    
        // Validate email
        if (empty($email)) {
            $emailErr = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    
        // Validate password
        if (empty($password)) {
            $passwordErr = "Password is required";
        }

    // Call the register function
    $db = new Database();
    $conn = $db->connect();
    if (register($conn, $name, $email, $password)) {
        $registrationSuccess = "Signup successful. You are now logged in.";
        // Call the login function
        if (login($conn, $email, $password)) {
            header("Location: ?page=home");
            exit();
        } else {
            $loginErr = "Invalid email or password";
        }
    } else {
        $registrationSuccess = "";
    }
}
?>

<link rel="stylesheet" href="/public/css/register.css">

<section class="registration">
    <h2>Sign Up</h2>
    <form method="POST" action="?page=register">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <span class="error"><?php echo $nameErr; ?></span>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <span class="error"><?php echo $emailErr; ?></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?php echo $passwordErr; ?></span>

        <button type="submit">Register</button>
    </form>
    <?php 
    if (!empty($registrationSuccess)) {
        echo '<div class="success-message">' . $registrationSuccess . '</div>';
    }
    ?>
    <p>Already have an account? <a href="?page=register">Sign in here</a>.</p>
</section>
