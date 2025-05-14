<?php
require_once 'assects/php/functions.php';

echo "<pre>";
print_r(getPosts());





if(isset($_SESSION['Auth']) && $_SESSION['Auth'] == true) {
    // User is already logged in, redirect to dashboard
    header('Location: assects\pages\dashboard.php');
    exit;
}
// Redirect to login page
header('Location: assects\pages\login.php');
exit;
?>