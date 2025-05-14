$loggedInUserId = $_SESSION['user_id'];

// Fetch messages
if (isset($_GET['fetch_messages']) && isset($_GET['receiver_id'])) {
    $receiverId = intval($_GET['receiver_id']);
    $stmt = $conn->prepare("SELECT * FROM messages WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?) ORDER BY timestamp ASC");
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

// Send message
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['send_message'])) {
    $receiverId = intval($_POST['receiver_id']);
    $message = trim($_POST['message']);

    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $loggedInUserId, $receiverId, $message);
        $stmt->execute();
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "msg" => "Empty message"]);
    }
    exit;
}

// Fetch user list
if (isset($_GET['fetch_users'])) {
    $result = $conn->query("SELECT id, name FROM users WHERE id != $loggedInUserId");
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
    exit;
}
?>