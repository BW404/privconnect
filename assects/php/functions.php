<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'actions.php';

function validateSignupForm($form_data) {
    $response = array();
    
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
    return $response;

}

function showError($field){
    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        if($error['field'] == $field){
            echo '<p class="error-message">'.$error['msg'].'</p>';
            unset($_SESSION['error']);
        }
    }
}



