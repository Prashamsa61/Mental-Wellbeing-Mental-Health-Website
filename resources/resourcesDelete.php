
<?php
// Include database connection file
include '../utilities/dbconnection.php';

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Retrieve resource ID from the POST request and sanitize input
    $resource_id = htmlspecialchars(trim($_POST['resource_id']));

    // SQL query to delete the resource
    $query = "DELETE FROM resources WHERE ResourcesID = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "i", $resource_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Resource deleted successfully
            echo "Resource deleted successfully";
        } else {
            // Error in query execution
            echo "Error deleting resource: " . mysqli_stmt_error($stmt);
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
$title = "Delete Resources";
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
    <h2>Delete Resource</h2>
    <form action="resourcesDelete.php" method="POST">
        <div class="form-group">
            <label for="resource_id">Resource ID:</label>
            <input type="text" id="resource_id" name="resource_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
</div>
</div>
</div>
</div>

<?php include('../utilities/footer.php') ?>