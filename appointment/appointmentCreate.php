<?php
session_start(); // Start the session
include "../utilities/dbconnection.php";

// Fetch user names from the 'users' table
$userQuery = "SELECT UserId, Name FROM user";
$userResult = $conn->query($userQuery);
$users = $userResult->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedUserId = $_POST['UserId'];
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];
    $status = 'Pending'; // Set initial status as Pending

    // Use prepared statement to prevent SQL injection
    $sql = $conn->prepare("INSERT INTO appointment (UserId, Date, Time, Status) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss", $selectedUserId, $date, $time, $status);

    if ($sql->execute()) {
        // Store the appointment ID in a session variable
        $_SESSION['appointment_id'] = $conn->insert_id;
        echo "Appointment created successfully";
    } else {
        echo "Error: " . $sql->error;
    }
    
    $sql->close();
    $conn->close();
}
?>
<?php
$title = "Book an Appointment";
$styleSheetVariable = "/style/styles.css";
?>
<?php
include('../utilities/header.php');

include '../utilities/user_navbar.php';
?> 
<div class="container mt-5 app-container" >

<div class="row justify-content-center">
    <!-- Photo Section -->
    <div class="col-md-6">
        <img src="../img/appoint.jpg" alt="Appointment Image" class="img-fluid">
    </div>

    <!-- Form Section -->
    <div class="col-md-6 mb-5">
        <h2 class="mb-4">Book an Appointment</h2>

        <!-- Appointment Form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- User selection dropdown -->
            <div class="form-group">
                <label for="user_id"> Enter your Name:</label>
                <input type="text" name="UserId" value="<?php echo $_SESSION['user_id']; ?>" hidden>
                <input type="text" name="user_name" class="form-control" required>
            </div>

            <!-- Appointment Date -->
            <div class="form-group">
                <label for="appointment_date">Appointment Date:</label>
                <input type="date" name="appointment_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required readonly>
            </div>

            <!-- Appointment Time -->
            <div class="form-group">
                <label for="appointment_time">Appointment Time:</label>
                <input type="time" name="appointment_time" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Book Appointment</button>
        </form>
    </div>
</div>

<a href="../feedback/feedbackCreate.php">Give a feedback ??</a>
</div>
<?php 
include("../utilities/footer.php") ?>
