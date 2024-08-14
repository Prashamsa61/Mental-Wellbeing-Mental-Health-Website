<?php
// Include database connection file
include '../utilities/dbconnection.php';

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Retrieve data from the POST request and sanitize inputs
    $thoughtId = htmlspecialchars(trim($_POST['thoughtId']));
    $replyContent = htmlspecialchars(trim($_POST['replyContent']));

    // SQL query to insert reply into the thought table
    $query = "UPDATE thought SET ReplyContent = ? WHERE ThoughtId = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "si", $replyContent, $thoughtId);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Reply added successfully
            echo "Reply added successfully";
        } else {
            // Error in query execution
            echo "Error adding reply: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} 
?>

<?php

$title = "Reply thoughts";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/therapist_navbar.php');
?> 
    <div class="container mt-5 ">
    <div class="row justify-content-center">
    <div class="col-md-6" style="margin-top: 100px;">
    <div class="container thought-container">
   
    <form action="thoughtsReply.php" method="POST" class="thought_form">
        <?php
        // Check if thoughtId is set in the URL
        if (isset($_GET['thoughtId'])) {
            // Output a hidden input field for thoughtId if it's set
            echo '<input type="hidden" id="thoughtId" name="thoughtId" value="' . htmlspecialchars($_GET['thoughtId']) . '">';
        }
        ?>
        <label for="replyContent">Reply Content:</label><br>
        <textarea id="replyContent" class="form-control" name="replyContent" rows="4" cols="50" required></textarea><br><br>
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>
    </div>
    </div>
    </div>
    </div>
    
<?php include('../utilities/footer.php') ?>
