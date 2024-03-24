<?php 
require_once 'h_functions.php';
require_once 'database.php';

// Initialize variables to hold error messages
$emailErr = $passwordErr = $loginErr = "";

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

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

    // Call the login function
    $db = new Database();
    $conn = $db->connect();
    if (login($conn, $email, $password)) {

        header("Location: ?page=home");
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
    <p>don't have an account? <a href="?page=register">Sign up here</a>.</p>
</section>
