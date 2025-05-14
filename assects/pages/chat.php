<?php
session_start();
include_once 'db.php'; // make sure DB connection is here
include_once 'functions.php'; // helper functions if needed

$loggedInUserId = $_SESSION['user_id']; // Replace with your actual session user ID

// Fetch messages
if (isset($_GET['fetch_messages']) && isset($_GET['receiver_id'])) {
    $receiverId = $_GET['receiver_id'];
    $stmt = $conn->prepare("SELECT * FROM messages WHERE 
        (sender_id = ? AND receiver_id = ?) OR 
        (sender_id = ? AND receiver_id = ?) 
        ORDER BY created_at ASC");
    $stmt->bind_param("iiii", $loggedInUserId, $receiverId, $receiverId, $loggedInUserId);
    $stmt->execute();
    $result = $stmt->get_result();

    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
    echo json_encode($messages);
    exit;
}

// Send a message
if (isset($_POST['send_message']) && isset($_POST['receiver_id']) && isset($_POST['message'])) {
    $receiverId = $_POST['receiver_id'];
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $loggedInUserId, $receiverId, $message);
        $stmt->execute();
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Empty message"]);
    }
    exit;
}
?>
