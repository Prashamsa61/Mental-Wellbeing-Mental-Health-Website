<?php
$title = "User Dashboard";
$styleSheetVariable = "../style/styles.css";
?>

<nav class="navbar navbar-expand-lg navbar-dark ">
    <a class="navbar-brand" href="../user/therapist_dashboard.php">Mental Wellbeing</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../appointment/appointmentRead.php">Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../feedback/feedbackRead.php">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../thought/thoughtsRead.php">Thoughts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../resources/resourcesCreate.php">Resources</a>
            </li>
        </ul>
    </div>
</nav>

