<?php
$title = "Resources";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/user_navbar.php');
?> 
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6">
            <img src="../img/resources.jpg" class="img-fluid rounded" alt="Resources Image">
        </div>
        <div class="col-md-6 ">
            <h2 class="mb-4">View Resources</h2>
            <div class="resources-container mb-5">
                <?php
                // Include the common database connection file
                include '../utilities/dbconnection.php';

                // Fetch data from the database (replace 'resources' with your actual table name)
                $result = $conn->query("SELECT * FROM resources");

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row["Title"]; ?></h4>
                                <p class="card-text">Description: <?php echo $row["Description"]; ?></p>
                                <a href="<?php echo $row["Link"]; ?>" class="btn btn-primary">See More</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='resource-box mb-5'><p>No data available</p></div>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>

<!-- Bootstrap JS (optional, only if you need JavaScript components) -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('../utilities/footer.php') ?>
