<?php
require_once 'functions.php';

// Send a message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $sender_id = $_SESSION['userdata']['id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";
    $run = mysqli_query($conn, $query);

    if ($run) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
    }
    exit();
}

// Fetch messages
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_messages'])) {
    $sender_id = $_SESSION['userdata']['id'];
    $receiver_id = $_GET['receiver_id'];

    $query = "SELECT * FROM messages WHERE 
              (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR 
              (sender_id = '$receiver_id' AND receiver_id = '$sender_id') 
              ORDER BY timestamp ASC";
    $run = mysqli_query($conn, $query);
    $messages = mysqli_fetch_all($run, MYSQLI_ASSOC);

    echo json_encode($messages);
    exit();
}
?>