<?php
require_once 'functions.php';
// for signup
if(isset($_GET['signup'])) {
    $response=validateSignupForm($_POST);
    if($response['status'] == false) {
        $_SESSION['error'] = $response;
        header("Location: ../pages/login.php?signup");
        exit();
    }
    else{
        if(createUser($_POST)){
            $_SESSION['success'] = "Account created successfully.";
            header("Location: ../pages/login.php?signup");
            exit();
        }
        else{
            $_SESSION['error'] = "Error creating account.";
            header("Location: ../pages/login.php?signup");
            exit();
        }
    }
   
}

// for login
if(isset($_GET['login'])) {

    

    // $response=validateLoginForm($_POST);
    // if($response['status'] == false) {
    //     $_SESSION['error'] = $response;
    //     header("Location: ../pages/login.php?login");
    //     exit();
    // }
    // else{
    //     if(loginUser($_POST)){
    //         $_SESSION['success'] = "Login successful.";
    //         header("Location: ../pages/dashboard.php");
    //         exit();
    //     }
    //     else{
    //         $_SESSION['error'] = "Error logging in.";
    //         header("Location: ../pages/login.php?login");
    //         exit();
    //     }
    // }
   
}
