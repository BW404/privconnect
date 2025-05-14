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

