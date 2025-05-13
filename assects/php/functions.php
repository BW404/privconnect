<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'actions.php';

function validateSignupForm($form_data) {
    $response = array('status'=> true);
    
    // Validate password

    if (empty($form_data['password'])) {
        $response['msg'] = "Password is required.";
        $response['status'] = false;
        $response['field'] = "password";
    } elseif (strlen($form_data['password']) < 8) {
        $response['msg'] = "Password must be at least 8 characters long.";
        $response['status'] = false;
        $response['field'] = "password";
    }

    // Validate username
    if (empty($form_data['username'])) {
        $response['msg'] = "Username is required.";
        $response['status'] = false;
        $response['field'] = "username";
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $form_data['username'])) {
        $response['msg'] = "Only letters and numbers allowed in username.";
        $response['status'] = false;
        $response['field'] = "username";
    }

    // Validate email
    if (empty($form_data['email'])) {
        $response['msg'] = "Email is required.";
        $response['status'] = false;
        $response['field'] = "email";
    } elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
        $response['msg'] = "Invalid email format.";
        $response['status'] = false;
        $response['field'] = "email";
    }

    // Validate last name
    if (empty($form_data['last_name'])) {
        $response['msg'] = "Last name is required.";
        $response['status'] = false;
        $response['field'] = "last_name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['last_name'])) {
        $response['msg'] = "Only letters and white space allowed in last name.";
        $response['status'] = false;
        $response['field'] = "last_name";
    }
                

    // Validate first name
    if (empty($form_data['first_name'])) {
        $response['msg'] = "First name is required.";
        $response['status'] = false;
        $response['field'] = "first_name";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['first_name'])) {
        $response['msg'] = "Only letters and white space allowed in first name.";
        $response['status'] = false;
        $response['field'] = "first_name";
    }

    // error for duplicate email
    if (isEmailRegistered($form_data['email'])) {
        $response['msg'] = "Email id already registred.";
        $response['status'] = false;
        $response['field'] = "email";
    } 

    // error for duplicate username
    if (isUsernameRegistered($form_data['username'])) {
        $response['msg'] = "Username already registred.";
        $response['status'] = false;
        $response['field'] = "username";
    }



    return $response;

}

// Function to check if email is already registered
function isEmailRegistered($email) {
    global $conn;
    $query = "SELECT count(*) as row FROM users WHERE email = '$email'";
    $run = mysqli_query($conn, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];


}
// Function to check if username is already registered
function isUsernameRegistered($username) {
    global $conn;
    $query = "SELECT count(*) as row FROM users WHERE username = '$username'";
    $run = mysqli_query($conn, $query);
    $return_data = mysqli_fetch_assoc($run);
    return $return_data['row'];
}

// for creating a new user
function createUser($form_data) {
    global $conn;
    $hashed_password = password_hash($form_data['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO users (first_name,last_name,gender,email,username,password) VALUES ('".$form_data['first_name']."', '".$form_data['last_name']."', '".$form_data['gender']."', '".$form_data['email']."', '".$form_data['username']."', '".$hashed_password."')";
    $run = mysqli_query($conn, $query);
    return $run;
}


// Function to validate login form
function validateLoginForm($form_data) {
    $response = array('status'=> true);
    
    // Validate password
    if (empty($form_data['password'])) {
        $response['msg'] = "Password is required.";
        $response['status'] = false;
        $response['field'] = "password";
    }

    // Validate username
    if (empty($form_data['username'])) {
        $response['msg'] = "Username is required.";
        $response['status'] = false;
        $response['field'] = "username";
    } 

    return $response;

}

fun