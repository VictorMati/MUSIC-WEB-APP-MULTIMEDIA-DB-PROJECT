<?php 
require_once 'functions.php';
require_once 'database.php';

// Initialize variables to hold error messages
$emailErr = $passwordErr = $loginErr = "";

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Call the login function
    $db = new Database();
    $conn = $db->connect();
    if (login($conn, $email, $password)) {
        // Redirect to home page upon successful login
        header("Location: index");
        exit();
    } else {
        $loginErr = "Invalid email or password";
    }
}
?>

<link rel="stylesheet" href="/public/css/login.css">

<section class="login">
    <h2>Sign in</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
        <span class="error"><?php echo $emailErr; ?></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?php echo $passwordErr; ?></span>

        <button type="submit">Login</button>
    </form>
    <span class="error"><?php echo $loginErr; ?></span>

    <!-- Add "Already have an account?" link -->
    <p>Already have an account? <a href="/app/pages/register.php">Sign up here</a>.</p>
</section>
