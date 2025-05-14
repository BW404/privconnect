<?php
include_once '../php/functions.php';
include '../php/header.php'; ?>
<body>
    <?php include '../php/nav.php'; ?>
    <div class="edit-profile-wrapper">
        <div class="notification-panel" id="notification_panel">
            <h4>Notifications</h4>
            <ul class="notification-list">
                <li>
                    <img src="../icons/notification.png" alt="Notification Icon">
                    <p><strong>Rachel</strong> liked your post.</p>
                </li>
                <li>
                    <img src="../icons/notification.png" alt="Notification Icon">
                    <p><strong>Derek</strong> commented on your photo.</p>
                </li>
                <li>
                    <img src="../icons/notification.png" alt="Notification Icon">
                    <p><strong>Maria</strong> shared your post.</p>
                </li>
            </ul>
        </div>
        <div class="edit-profile-container">
            <h2>Edit Profile</h2>
            <form method="POST" action="../php/actions.php?edit_profile" class="edit-profile-form">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-style" value="<?=$user['first_name']?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-style" value="<?=$user['last_name']?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-style" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-style" placeholder="Enter a new password">
                </div>
                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-style">
                </div>
                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>
    <script src="../js/activity.js"></script>
    <?php include '../php/footer.php'; ?>
</body>
</html>