
<?php global $user;
$user = $_SESSION['userdata'];
?>

<nav>        
        <div class="nav-left">
            <h2 class="logo"><a href="#">Priv<span>Connect</span></a></h2>
            <ul>
                <li id="noti_icon" class="icons-nav"><img src="../icons/notification.png" alt="notification"></li>
                <li class="icons-nav"><img src="../icons/inbox.png" alt="inbox"></li>
            </ul>
        </div>
        <div class="nav-right">
            <div class="search-box">
                <img src="../icons/search.png" alt="search">
                <input type="text" placeholder="Search">
            </div>
            <div class="nav-user-icon online" id="user_icon">
                <img src="../photos/profile/<?=$user['profile_pic']?>" alt="profile-pic">
                <div class="dropdown-menu" id="dropdown_menu">
                    <a href="../pages/edit_profile.php">Profile</a>
                    <a href="#">Settings</a>
                    <a href="../../logout.php">Logout</a>
                </div>
            </div>

    </nav>