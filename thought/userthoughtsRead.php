<?php
$title = "Read the thoughts";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/user_navbar.php');

?> 

<div class="container thought-container mt-5 ">
    <h2 class="">Read Thoughts</h2>
    <div class="row">
        <?php
        // Include database connection file
        include '../utilities/dbconnection.php';

        // SQL query to retrieve thoughts
        $query = "SELECT * FROM thought WHERE ReplyContent IS NOT NULL";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check if there are any thoughts
        if (mysqli_num_rows($result) > 0) {
            // Loop through each thought
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class=" col-md-4 mt-5">
                    <div class="thought-card card bg-light rounded"> <!-- Add the card class here -->
                        <div class="card-body" style="background-color: #f0e6ed;"> <!-- Add the card-body class here -->
                            <p class="thought-content"><?php echo $row['Content']; ?></p>
                            <?php if (!empty($row['ReplyContent'])) { ?>
                                <p class="thought-content"><strong>Reply:</strong> <?php echo $row['ReplyContent']; ?></p>
                            <?php } else { ?>
                                <a href="thoughtsReply.php?thoughtId=<?php echo $row['ThoughtId']; ?>" class="btn btn-primary">Reply</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php
            }
        } else {
            echo "No thoughts found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</div>


<?php include('../utilities/footer.php') ?>
