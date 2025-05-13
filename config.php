<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'privconnect_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>    

dsf