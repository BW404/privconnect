const notificationPanel = document.getElementById("notification_panel");
const notificationIcon = document.getElementById("noti_icon");

notificationIcon.addEventListener("click", () => {
    // Toggle the 'active' class to show/hide the notification panel with animation
    notificationPanel.classList.toggle("active");
});