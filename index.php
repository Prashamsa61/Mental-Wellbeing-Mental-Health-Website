<?php
// Check if the user is searching for user_dashboard or therapist_dashboard
if (isset($_GET['search']) && ($_GET['search'] == 'user_dashboard' || $_GET['search'] == 'therapist_dashboard')) {
    // Redirect to the appropriate dashboard
    header('Location: ' . $_GET['search'] . '.php');
    exit;
} else {
    // Redirect to the signup page if the search is not valid
    header('Location: user/login.php');
    exit;
}
?>
