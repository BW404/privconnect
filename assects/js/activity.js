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



let receiverId = null;

const userList = document.getElementById("user-list");
const chatUserName = document.getElementById("chat-user-name");
const chatMessages = document.getElementById("chat-messages");
const chatMessageInput = document.getElementById("chat-message-input");
const sendMessageBtn = document.getElementById("send-message-btn");

// Load users
function loadUsers() {
    fetch("chat.php?fetch_users=true")
        .then(res => res.json())
        .then(users => {
            users.forEach(user => {
                const userDiv = document.createElement("div");
                userDiv.className = "user";
                userDiv.textContent = user.name;
                userDiv.dataset.id = user.id;
                userDiv.dataset.name = user.name;
                userDiv.addEventListener("click", () => selectUser(userDiv));
                userList.appendChild(userDiv);
            });
        });
}

function selectUser(userDiv) {
    document.querySelectorAll(".user").forEach(u => u.classList.remove("active"));
    userDiv.classList.add("active");

    receiverId = parseInt(userDiv.dataset.id);
    chatUserName.textContent = userDiv.dataset.name;
    fetchMessages();
}

function fetchMessages() {
    if (!receiverId) return;
    fetch(`chat.php?fetch_messages=true&receiver_id=${receiverId}`)
        .then(res => res.json())
        .then(messages => {
            chatMessages.innerHTML = "";
            messages.forEach(msg => {
                const msgDiv = document.createElement("div");
                msgDiv.className = "message " + (msg.sender_id == receiverId ? "received" : "sent");
                msgDiv.textContent = msg.message;
                chatMessages.appendChild(msgDiv);
            });
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
}

sendMessageBtn.addEventListener("click", () => {
    const message = chatMessageInput.value.trim();
    if (!message || !receiverId) return;

    fetch("chat.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `send_message=true&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            chatMessageInput.value = "";
            fetchMessages();
        }
    });
});

// Auto refresh
setInterval(() => {
    if (receiverId) fetchMessages();
}, 2000);

loadUsers();

