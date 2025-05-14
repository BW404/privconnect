<?php
require_once 'functions.php';
// session_start();
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
if (isset($_GET['login'])) {
    $response = validateLoginForm($_POST);

    if ($response['status'] == false) {
        $_SESSION['error'] = $response;
        $_SESSION['msg'] = "Invalid Username or password";
        $_SESSION['field'] = 'invalid';

        header("Location: ../pages/login.php?login");
        exit();
    } else {
            $_SESSION['Auth'] = true;
            $_SESSION['userdata'] = $response['user'];
            echo "<pre>";
            print_r($_SESSION['userdata']);
            echo "</pre>";
            header("Location: ../pages/dashboard.php");
            exit();
        }
    
}


if (isset($_GET['updateprofile'])) {
    // print_r($_POST);
    // print_r($_FILES);

    // update data to the database if profile picture is not updated then keeep the old one and of teh password is not updated then keep the old one. do not validate the fprm 
    // if the form is not valid then return the error
    $response = validateUpdateForm($_POST,$_FILES);
    // if ($response['status'] == false) {
    //     $_SESSION['error'] = $response;
    //     header("Location: ../pages/edit_profile.php?updateprofile");
    //     exit();
    // } else {
    //     // update the data to the database
    //     if (updateUser($_POST,$_FILES)) {
    //         $_SESSION['success'] = "Profile updated successfully.";
    //         header("Location: ../pages/edit_profile.php?updateprofile");
    //         exit();
    //     } else {
    //         $_SESSION['error'] = "Error updating profile.";
    //         header("Location: ../pages/edit_profile.php?updateprofile");
    //         exit();
    //     }
    updateUser($_POST,$_FILES)
    
    // print_r($_POST);
    // print_r($_FILES);


}


