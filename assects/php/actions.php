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

    $response = validateUpdateForm($_POST,$_FILES);
    updateUser($_POST,$_FILES);
    
    // print_r($_POST);
    // print_r($_FILES);


}




// for managing add post
if (isset($_GET['addpost'])) {
    // print_r($_POST);
    // print_r($_FILES);
    if(createPost($_POST,$_FILES)){
        $_SESSION['success'] = "Post created successfully.";
        header("Location: ../pages/dashboard.php");
        exit();
    }
    else{
        $_SESSION['error'] = "Error creating post.";
        header("Location: ../pages/dashboard.php");
        exit();
    }
}

// Chat API handlers
session_start();

if (!isset($_SESSION['userdata'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$userId = $_SESSION['userdata']['id'];

// Fetch users for chat
if (isset($_GET['fetch_users']) && $_GET['fetch_users'] == 'true') {
    $users = getAllUsers();
    echo json_encode($users);
    exit();
}

// Fetch messages with a specific user
if (isset($_GET['fetch_messages']) && $_GET['fetch_messages'] == 'true' && isset($_GET['receiver_id'])) {
    $receiverId = intval($_GET['receiver_id']);
    $messages = getChatMessages($userId, $receiverId);
    echo json_encode($messages);
    exit();
}

// Send a new message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message']) && $_POST['send_message'] == 'true') {
    $receiverId = intval($_POST['receiver_id']);
    $message = trim($_POST['message']);
    if ($message !== '') {
        $success = sendMessage($userId, $receiverId, $message);
        if ($success) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Message is empty']);
    }
    exit();
}


