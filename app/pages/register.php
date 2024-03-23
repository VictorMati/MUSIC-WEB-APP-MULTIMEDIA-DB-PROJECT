<?php 
require_once 'functions.php';
require_once 'database.php';

// Initialize variables to hold error messages
$nameErr = $emailErr = $passwordErr = $registrationSuccess = "";

// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize user inputs
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

    // Call the register function
    $db = new Database();
    $conn = $db->connect();
    if (register($conn, $name, $email, $password)) {
        $registrationSuccess = "Signup successful. You are now logged in.";
        // Start a session upon successful registration
        session_start();
        $_SESSION["user_name"] = $name;
        $_SESSION["user_email"] = $email;
        // Redirect to home page or any other desired page
        header("Location: index.php");
        exit();
    } else {
        $registrationSuccess = "";
    }
}
?>

<link rel="stylesheet" href="/public/css/register.css">

<section class="registration">
    <h2>Sign Up</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
</section>
