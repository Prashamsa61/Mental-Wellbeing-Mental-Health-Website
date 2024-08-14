<?php
$title = "Navbar";
$styleSheetVariable = "../style/styles.css";
include('../utilities/header.php');

?> 

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="../user/user_dashboard.php">Mental Wellbeing</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../thought/thoughtsCreate.php">Thoughts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../appointment/appointmentCreate.php">Book an Appointment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../resources/resourcesRead.php">Resources</a>
            </li>
        </ul>
    </div>
</nav>

