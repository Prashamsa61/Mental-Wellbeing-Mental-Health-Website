<?php

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$dbname = '23140743';


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {


}

?>