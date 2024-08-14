<?php
include("../utilities/dbconnection.php");
// Fetch resources from the database
$query = "SELECT * FROM resources";
$result = mysqli_query($conn, $query);

?>
<?php

$title = "View Resources";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/therapist_navbar.php');
?> 

<div class="container mt-5 ">
    <h2 >Resources</h2>
    <br>
    <div class="table-responsive ">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Resource ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['ResourcesId'] . "</td>";
                    echo "<td>" . $row['Title'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "<td>" . $row['Link'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No resources found</td></tr>";
            }
            ?>
        </tbody>
    </table>
        </div>
</div>

<?php
include '../utilities/footer.php'?>


<?php
// Close the database connection
mysqli_close($conn);
?>
