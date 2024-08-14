<?php
$title = "View Feedback";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/therapist_navbar.php');
?> 

<div class="container mt-5 feedback-container mb-7">
    <h2 class="mb-4">Read Feedbacks</h2> 
    <div class="row">
        <?php
        // Include database connection file
        include "../utilities/dbconnection.php";

        // Retrieve feedbacks data
        $feedbacksQuery = "SELECT Content FROM feedback";
        $stmtFeedbacks = $conn->prepare($feedbacksQuery);
        $stmtFeedbacks->execute();
        $feedbacksResult = $stmtFeedbacks->get_result();

        // Check if there are any feedbacks
        if ($feedbacksResult->num_rows > 0) {
            // Output feedbacks in a grid
            while ($row = $feedbacksResult->fetch_assoc()) {
                echo '<div class="col-md-4 mt-3 ">
                        <div class="card bg-light rounded">
                        <div class="card-body" style="background-color: #f0e6ed;"> 
                            <p>' . $row['Content'] . '</p>
                        </div>
                        </div>
                    </div>';
            }
        } else {
            echo '<p>No feedbacks found.</p>';
        }

        // Close the statement and connection
        $stmtFeedbacks->close();
        $conn->close();
        ?>
    </div>
</div>
<div class=m-5>
<br>
</div>

<?php include('../utilities/footer.php') ?>
