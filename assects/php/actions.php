<?php
require_once 'functions.php';
if(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    if($response['status'] == false) {
    echo isEmailRegistered('test@gmail.com');
        $_SESSION['error'] = $response;
        header("Location: ../pages/login.php?signup");
        exit();
    }
}