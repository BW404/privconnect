<?php
require_once 'config.php';
require_once 'functions.php';
require_once 'actions.php';

// existing functions unchanged...

// Function to get chat messages between two users
function getChatMessages($userId, $receiverId) {
    global $conn;
    $query = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iiii", $userId, $receiverId, $receiverId, $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $messages;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return [];
    }
}

// Function to send a message
function sendMessage($senderId, $receiverId, $message) {
    global $conn;
    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iis", $senderId, $receiverId, $message);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $success;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}

// Function to get all users except current user (already exists as getAllUsers)
function getAllUsers() {
    global $conn;
    $current_user_id = $_SESSION['userdata']['id']; // Get the logged-in user's ID

    $query = "SELECT id, first_name, last_name, profile_pic FROM users WHERE id != ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $current_user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $users;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return [];
    }
}
