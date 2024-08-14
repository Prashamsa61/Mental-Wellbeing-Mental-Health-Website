<?php
// Start the session
session_start();

// Include database connection file
include '../utilities/dbconnection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request and sanitize inputs
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $link = htmlspecialchars(trim($_POST['link']));

    // Get the user ID from the session
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // SQL query to insert data into the resources table using prepared statement
        $query = "INSERT INTO resources (UserId, Title, Description, Link) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "isss", $userId, $title, $description, $link);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                // Resource created successfully
                echo "Resource created successfully";
            } else {
                // Error in query execution
                echo "Error creating resource: " . mysqli_stmt_error($stmt);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Error in preparing statement
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        // Error: User ID not set in session
        echo "Error: User ID not set in session";
    }

    // Close the database connection
    mysqli_close($conn);
} 
?>

<?php
$title = "Create Resources";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/therapist_navbar.php');
?> 
<div class="container mt-5 ">
<div class="row justify-content-center">
<div class="col-md-6">
            <div class="resources-container">
    <h2>Create Resource</h2>
    <form action="resourcesCreate.php" method="POST">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" cols="50" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  
</div>
<div class="mt-3 ">
    <a href="resourcesUpdate.php" class="btn btn-primary m-2">Update Resources</a>
    <a href="resourcesDelete.php" class="btn btn-primary m-2">Delete Resources</a>
    <a href="ViewResources.php" class="btn btn-primary m-2 ">View Resources</a>
</div>


</div>
</div>
</div>

    <?php include('../utilities/footer.php') ?>
