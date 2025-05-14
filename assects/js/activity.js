const notificationPanel = document.getElementById("notification_panel");
const notificationIcon = document.getElementById("noti_icon");

notificationIcon.addEventListener("click", () => {
    // Toggle the 'active' class to show/hide the notification panel with animation
    notificationPanel.classList.toggle("active");
});



const userIcon = document.getElementById("user_icon");
const dropdownMenu = document.getElementById("dropdown_menu");

userIcon.addEventListener("click", () => {
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
});

// Close the dropdown when clicking outside
document.addEventListener("click", (event) => {
    if (!userIcon.contains(event.target)) {
        dropdownMenu.style.display = "none";
    }
});




const chatMessages = document.getElementById("chat-messages");
const chatMessageInput = document.getElementById("chat-message-input");
const sendMessageBtn = document.getElementById("send-message-btn");
const receiverId = 2; // Replace with dynamic receiver ID

// Fetch messages every 2 seconds
setInterval(fetchMessages, 2000);

function fetchMessages() {
    fetch(`chat.php?fetch_messages=true&receiver_id=${receiverId}`)
        .then(response => response.json())
        .then(messages => {
            chatMessages.innerHTML = "";
            messages.forEach(msg => {
                const messageDiv = document.createElement("div");
                messageDiv.classList.add("message");
                messageDiv.classList.add(msg.sender_id == receiverId ? "received" : "sent");
                messageDiv.textContent = msg.message;
                chatMessages.appendChild(messageDiv);
            });
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
}

// Send a message
sendMessageBtn.addEventListener("click", () => {
    const message = chatMessageInput.value.trim();
    if (message) {
        fetch("chat.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `send_message=true&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                chatMessageInput.value = "";
                fetchMessages();
            } else {
                alert("Failed to send message.");
            }
        });
    }
});


function startChat(userId, userName) {
    receiverId = userId; // Set the receiver ID to the selected user's ID
    document.getElementById("chat-user-name").textContent = userName; // Update the chat header
    fetchMessages(); // Fetch chat messages for the selected user
}



function fetchMessages() {
    fetch(`chat.php?fetch_messages=true&receiver_id=${receiverId}`)
        .then(response => response.json())
        .then(messages => {
            chatMessages.innerHTML = ""; // Clear previous messages
            messages.forEach(msg => {
                const messageDiv = document.createElement("div");
                messageDiv.classList.add("message");
                messageDiv.classList.add(msg.sender_id == receiverId ? "received" : "sent");
                messageDiv.textContent = msg.message;
                chatMessages.appendChild(messageDiv);
            });
            chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the latest message
        });
}


sendMessageBtn.addEventListener("click", () => {
    const message = chatMessageInput.value.trim();
    if (message) {
        fetch("chat.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `send_message=true&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                chatMessageInput.value = ""; // Clear the input field
                fetchMessages(); // Refresh the chat messages
            } else {
                alert("Failed to send message.");
            }
        });
    }
});