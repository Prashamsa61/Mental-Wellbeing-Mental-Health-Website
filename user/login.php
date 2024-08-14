<?php
session_start(); // Start the session

include('../utilities/dbconnection.php');

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$email = $password = '';
$errorMessage = ''; // Initialize the variable here

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];

    // Check if the user exists in the user table
    $sql = "SELECT * FROM user WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['Password'];
        $userType = $row['userType'];

        // Verify the password
        if ($password === $storedPassword) {
            // Store the user's ID in the session variable
            $_SESSION['user_id'] = $row['UserId'];


            // Redirect based on user type
            if ($userType === 'therapist') {
                // Redirect to therapist dashboard
                header("Location: therapist_dashboard.php");
                exit();
            } elseif ($userType === 'patient') {
                // Redirect to user dashboard
                header("Location: user_dashboard.php");
                exit();
            } else {
                $errorMessage = "Invalid user type.";
            }
        } else {
            $errorMessage = "Invalid email or password.";
            error_log("Invalid password for email: $email"); // Log the error
        }
    } else {
        $errorMessage = "Invalid email or password.";
        error_log("User not found with email: $email"); // Log the error
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<?php
$title='login Page';
$styleSheetVariable='../style/styles.css';
include '../utilities/header.php';

?>
    <div class="login-container">
        <h2>User Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
            <p>Don't Have an Account? <a href="signup.php">Sign Up</a></p>
            
        </form>
