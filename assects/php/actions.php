<?php
require_once 'functions.php';
if(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    if($response['status'] == false) {
        $_SESSION['error'] = $response;
        header("Location: ../pages/login.php?signup");
        exit();
    }
    else{
    //    echo isEmailRegistered('taj3667@gmail.com');
    }
   
}