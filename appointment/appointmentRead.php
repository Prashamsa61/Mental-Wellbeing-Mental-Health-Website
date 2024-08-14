<?php
// Process form submission
include "../utilities/dbconnection.php";

// Initialize the message variable
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_appointment'])) {
    $appointmentId = $_POST['appointment_id'];

    // Update the status to Confirmed
    $updateStatusQuery = "UPDATE appointment SET Status = 'Confirmed' WHERE AppointmentId = ?";
    $stmt = $conn->prepare($updateStatusQuery);
    $stmt->bind_param("i", $appointmentId);

    if ($stmt->execute()) {
        $message = "Appointment confirmed successfully";
    } else {
        $message = "Error updating status: " . $stmt->error;
    }

    $stmt->close();
}

// Retrieve appointments data
$appointmentsQuery = "SELECT appointment.AppointmentId, user.Name AS UserName, appointment.Date, appointment.Time, appointment.Status 
                      FROM appointment 
                      JOIN user ON appointment.UserId = user.UserId";

$appointmentsResult = $conn->query($appointmentsQuery);

if ($appointmentsResult->num_rows > 0) {
    $appointments = $appointmentsResult->fetch_all(MYSQLI_ASSOC);
} else {
    $appointments = [];
}

// Close the result set
$appointmentsResult->close();
?>

<?php

$title = "Appointments Booked";

$styleSheetVariable = "../styles.css";
?>
<?php
include('../utilities/header.php');
include('../utilities/therapist_navbar.php');
?> 

<div class="container mt-5">
    <h2 class="mb-4">View Appointments</h2>

    <!-- Display Alert Message -->
    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo strpos($message, "Error") !== false ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
            <?php echo $message; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Appointments Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead >
            <tr>
                <th>Appointment ID</th>
                <th>User Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($appointments as $appointment): ?>
                <tr>
                    <td><?php echo $appointment['AppointmentId']; ?></td>
                    <td><?php echo $appointment['UserName']; ?></td>
                    <td><?php echo $appointment['Date']; ?></td>
                    <td><?php echo $appointment['Time']; ?></td>
                    <td><?php echo $appointment['Status']; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['AppointmentId']; ?>">
                            <button type="submit" name="confirm_appointment" class="btn btn-success btn-sm">Confirm</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include("../utilities/footer.php")?>