<?php
$title = "User Dashboard";
$styleSheetVariable = "../style/styles.css";
?>

<?php
include('../utilities/header.php');
include('../utilities/user_navbar.php');
?> 
<div class="container d-flex align-items-center justify-content-center mt-4 mb-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <img src="../img/User.png" class="img-fluid rounded-circle mt-5" alt="pic">
        </div>
        <div class=" user-content col-md-6  align-items-center justify-content-center mt-5 mb-5">
            <h1 class="user-dashboard-text-left mt-5">You Are Not Alone</h1>
            <p class="justify-content small">Within each of us lies an incredible capacity for resilience, strength, and growth. Even in our darkest moments, we possess the power to overcome adversity and emerge stronger than before. Embracing our journey toward mental wellbeing is not just about healing wounds; it's about unleashing our inner potential and embracing the beauty of our own complexity.</p>
        </div>
    </div>
</div> 

<?php
include ('../utilities/footer.php')
?>
