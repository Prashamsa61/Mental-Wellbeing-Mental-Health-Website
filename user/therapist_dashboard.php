<?php
include '../utilities/dbconnection.php';

// Fetch list of patients from user table
$sqlPatients = "SELECT * FROM user WHERE UserType = 'patient'";
$resultPatients = $conn->query($sqlPatients);
?>
<?php

$title = "Therapist Dashboard";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include '../utilities/header.php' ;
include '../utilities/therapist_navbar.php' ;
?> 

<div class="container therapist-container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-sm-5 col-md-6">
            <div class="image-fluid  ">
                <img src="../img/therapist.jpg" alt="Therapist Dashboard Image" class="img-fluid rounded-circle mt-4 ">
            </div>
        </div>

        <div class="col-sm-5 col-md-6 ">
            <div class="quote-container mt-4 ml-4">
            <h1 class="mt-5  text-sm-left"><b>Welcome  Doctor !</h1></b>
               <br> <blockquote class="blockquote">
                    <p class="mb-0 small">Your work is not just about what you do, but who you are. Your presence, your empathy, and your compassion are the greatest tools you possess.</p>
                </blockquote>
            </div>
            <!-- Button to toggle the list of patients -->
            <button class="btn btn-primary mt-4 ml-4" id="togglePatients">View Patients</button>

            <!-- List of Patients (initially hidden) -->
            <div class="card mt-4 " id="patientList" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">List of Patients</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        while ($rowPatient = $resultPatients->fetch_assoc()) {
                            echo '<li class="list-group-item">' . $rowPatient['Name'] . ' - ' . $rowPatient['Gender'] . ' - ' . $rowPatient['ContactNum'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
        </div>
    </div>
</div>
</div>



<script>
    // Function to toggle the visibility of the patient list
    function togglePatients() {
        var patientList = document.getElementById('patientList');
        if (patientList.style.display === 'none') {
            patientList.style.display = 'block';
        } else {
            patientList.style.display = 'none';
        }
    }

    // Add event listener to the button
    document.getElementById('togglePatients').addEventListener('click', togglePatients);
</script>

<?php
include '../utilities/footer.php'?>
