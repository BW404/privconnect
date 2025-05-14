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

    // check user exists
    if (!checkUser($form_data)['status']) {
        $response['msg'] = "Incorrect username or password.";
        $response['status'] = false;
        $response['field'] = "checkuser";
    }
    else{
        $response['user'] = checkUser($form_data);
    }




    return $response;

}


function checkUser($form_data) {
    global $conn;

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $form_data['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the password
            if (password_verify($form_data['password'], $row['password'])) {
                // Set status to true and return user data
                $row['status'] = true;
                mysqli_stmt_close($stmt);
                return $row;
            } else {
                // Password does not match
                $response = [
                    'msg' => "Invalid password.",
                    'status' => false,
                    'field' => "password",
                    'data' => $form_data
                ];
                mysqli_stmt_close($stmt);
                return $response;
            }
        } else {
            // Username does not exist
            $response = [
                'msg' => "Username does not exist.",
                'status' => false,
                'field' => "username",
                'data' => $form_data
            ];
            mysqli_stmt_close($stmt);
            return $response;
        }
    } else {
        // Log or handle the error
        error_log("MySQL Error: " . mysqli_error($conn));
    }

    return false;
}



// Function to validate update profile form

function validateUpdateForm($form_data,$file_data) {
    $response = array('status'=> true);
    

    // // Validate username
    // if (empty($form_data['username'])) {
    //     $response['msg'] = "Username is required.";
    //     $response['status'] = false;
    //     $response['field'] = "username";
    // } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $form_data['username'])) {
    //     $response['msg'] = "Only letters and numbers allowed in username.";
    //     $response['status'] = false;
        // $response['field'] = "username";
    // }

    // // Validate email
    // if (empty($form_data['email'])) {
    //     $response['msg'] = "Email is required.";
    //     $response['status'] = false;
    //     $response['field'] = "email";
    // } elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
    //     $response['msg'] = "Invalid email format.";
    //     $response['status'] = false;
    //     $response['field'] = "email";
    // }

    // // Validate last name
    // if (empty($form_data['last_name'])) {
    //     $response['msg'] = "Last name is required.";
    //     $response['status'] = false;
    //     $response['field'] = "last_name";
    // } elseif (!preg_match("/^[a-zA-Z ]*$/", $form_data['last_name'])) {
    //     $response['msg'] = "Only letters and white space allowed in last name.";
    //     $response['status'] = false;
    //     $response['field'] = "last_name";
    // }
                

    // // Validate first name
    // if (empty($form_data['first_name'])) {
    //     $response['msg'] = "First name is required.";
    //     $response['status'] = false;
    //     $response['field'] = "first_name";
    // }

    $response['status'] = true;

    return $response;
}