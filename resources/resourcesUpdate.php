<?php
// Include database connection file
include '../utilities/dbconnection.php';

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Retrieve data from the POST request and sanitize inputs
    $resource_id = htmlspecialchars(trim($_POST['resource_id']));
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    $link = htmlspecialchars(trim($_POST['link']));

    // SQL query to update the resource
    $query = "UPDATE resources SET Title = ?, Description = ?, Link = ? WHERE ResourcesID = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $link, $resource_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Resource updated successfully
            echo "Resource updated successfully";
        } else {
            // Error in query execution
            echo "Error updating resource: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error in preparing statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} 

// Close the database connection
mysqli_close($conn);
?>

<?php
$title = "Update Resource";
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
                <h2>Update Resource</h2>
                <form action="resourcesUpdate.php" method="POST">
                    <div class="form-group">
                        <label for="resource_id">Resource ID:</label>
                        <input type="text" id="resource_id" name="resource_id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="title">New Title:</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">New Description:</label>
                        <textarea id="description" name="description" rows="4" cols="50" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">New Link:</label>
                        <input type="text" id="link" name="link" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
  
<?php include('../utilities/footer.php') ?>
