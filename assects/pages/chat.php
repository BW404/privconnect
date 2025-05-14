<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fetch_messages'])) {
    session_start();
    $sender_id = $_SESSION['userdata']['id'];
    $receiver_id = $_GET['receiver_id'];

    $query = "SELECT * FROM messages WHERE 
              (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR 
              (sender_id = '$receiver_id' AND receiver_id = '$sender_id') 
              ORDER BY timestamp ASC";
    $run = mysqli_query($conn, $query);

    if (!$run) {
        http_response_code(500);
        echo json_encode(['error' => 'Database query failed']);
        exit();
    }

    $messages = mysqli_fetch_all($run, MYSQLI_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($messages);
    exit();
}