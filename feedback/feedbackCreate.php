<?php
session_start(); // Start the session
include "../utilities/dbconnection.php";

// Retrieve appointments data for the current user
$userId = $_SESSION['user_id']; // Get the user ID from the session
$appointmentsQuery = "SELECT AppointmentId, Date, Time, Status FROM appointment WHERE UserId = ?";
$stmtAppointments = $conn->prepare($appointmentsQuery);
$stmtAppointments->bind_param("i", $userId);
$stmtAppointments->execute();
$appointmentsResult = $stmtAppointments->get_result();

$appointments = $appointmentsResult->fetch_all(MYSQLI_ASSOC);
$stmtAppointments->close();

// Check if the user has any appointments
$hasAppointments = !empty($appointments);

// Process feedback form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_feedback'])) {
    $feedbackContent = $_POST['feedback_content'];
    $appointmentId = $_POST['appointment_id'];

    // Insert feedback into the 'feedback' table
    $insertFeedbackQuery = "INSERT INTO feedback (UserId, AppointmentId, Date, Content) VALUES (?, ?, CURRENT_DATE, ?)";
    $stmtInsertFeedback = $conn->prepare($insertFeedbackQuery);
    $stmtInsertFeedback->bind_param("iss", $userId, $appointmentId, $feedbackContent);

    if ($stmtInsertFeedback->execute()) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error submitting feedback: " . $stmtInsertFeedback->error;
    }

    $stmtInsertFeedback->close();
}

// Close the connection
$conn->close();
?>

<?php

$title = "Create Feedback";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/user_navbar.php');
?> 

<div class="container mt-5 feedback-container">
    <h2 class="mb-4">Give Feedback</h2>

    <?php if ($hasAppointments): ?>
        <!-- Feedback Content -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="appointment_id" value="<?php echo $appointments[0]['AppointmentId']; ?>">
            <div class="form-group">
                <label for="feedback_content">Feedback Content:</label>
                <textarea name="feedback_content" class="form-control" required></textarea>
            </div>

            <button type="submit" name="submit_feedback" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <p>No appointments found. You need to have an appointment to give feedback.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and Popper.js (for Bootstrap components that require JS) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php include('../utilities/footer.php') ?>