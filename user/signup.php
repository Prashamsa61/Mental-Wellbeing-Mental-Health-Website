<?php
include '../utilities/dbconnection.php';

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Initialize variables
$name = $email = $password = $userType = $gender = $contactNum = '';
$errorMessage = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"]; // Store the password as plain text
    $userType = sanitizeInput($_POST["userType"]); // Get the user type from the form
    $gender = sanitizeInput($_POST["gender"]);
    $contactNum = sanitizeInput($_POST["contactNum"]);

    // Insert data into the database
    $sql = "INSERT INTO user (Name, Email, Password, UserType, Gender, ContactNum)
            VALUES ('$name', '$email', '$password', '$userType', '$gender', '$contactNum')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the login page
        header("Location: ./login.php");
        exit();
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<?php
$title='SignUp Page';
$styleSheetVariable='../style/styles.css';
include '../utilities/header.php';

?>
<div class="container mt-5">
    
    <div class="signup-container">
    <h3>User Registration</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="userType">User Type:</label>
            <select class="form-control" name="userType" required>
                <option value="patient">Patient</option>
                <option value="therapist">Therapist</option>
            </select>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="contactNum">Contact Number:</label>
            <input type="text" class="form-control" name="contactNum" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>

    <?php if ($errorMessage != '') : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</div>
