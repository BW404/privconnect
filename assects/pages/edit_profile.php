<?php
include_once '../php/functions.php';
include '../php/header.php'; ?>
<body>
    <?php include '../php/nav.php'; ?>
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        <form method="POST" action="../php/actions.php?edit_profile" class="edit-profile-form">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-style" placeholder="Enter your first name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-style" placeholder="Enter your last name" required>
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
    <?php include '../php/footer.php'; ?>
</body>
</html>