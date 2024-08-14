<?php
// Start the session
session_start();

// Include database connection file
include '../utilities/dbconnection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request and sanitize inputs
    $content = htmlspecialchars(trim($_POST['content']));

    // Get the user ID from the session
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // SQL query to insert data into the thought table using prepared statement
        $query = "INSERT INTO thought (UserId, Content) VALUES (?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "is", $userId, $content);

            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                // Thought created successfully
                echo "Thought created successfully";
            } else {
                // Error in query execution
                echo "Error creating thought: " . mysqli_stmt_error($stmt);
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
$title = "Create Thought";
$styleSheetVariable = "../style/styles.css";
?> 
<?php
include("../utilities/header.php");
include("../utilities/user_navbar.php");
?>
<div class="container mt-5 ">
  <div class="row justify-content-center">
    <div class="col-md-8"style="margin-top: 100px;">
      <div class="container thought-container">
        <h2>Share your thought</h2>
        <form action="thoughtsCreate.php" method="POST">
          <div class="form-group">
            <textarea id="content" class="form-control" name="content" rows="4" cols="50" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button><br><br>
          <a href='./userthoughtsRead.php'style="color: #f5b0b3;">Read other's thought?</a>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('../utilities/footer.php'); ?>
