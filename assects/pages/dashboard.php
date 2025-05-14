<?php
include_once '../php/actions.php';
include '../php/header.php';?>
<body>
    <?php include '../php/nav.php';?>

    <div class="container">
        <div class="left-sidebar">
                     
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

            <div class="sidebar-title">
                <h4>
                    Following
                </h4>
              </div>

            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-2.png" alt="">
                </div>
                <p>Roy Clark</p>
            </div>
            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-2.png" alt="">
                </div>
                <p>Roy Clark</p>
            </div>
            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-2.png" alt="">
                </div>
                <p>Roy Clark</p>
            </div>









        </div>
        <div class="main-content">


            <div class="write-post-container">
                <div class="user-profile">
                    <img src="../photos/profile/<?=$user['profile_pic']?>" alt="">
                    <div>
                        <p><?=$user['first_name']." ". $user['last_name']?></p>
                        <small>
                            Public
                            <i class="fas fa-caret-down"></i>
                        </small>
                    </div>
                </div>
                <form method="post" action="../php/actions.php?addpost" enctype="multipart/form-data">
                <div class="post-input-conatiner">
                    <textarea rows="3" name="post_text" placeholder="What's you mind, Jhon?"></textarea>
                    <div class="add-post-links">
                    <a href="#" onclick="document.getElementById('fileInput').click();">
                    <img src="../icons/photo.png" alt="">Photo/Video
                    </a>
                    <input type="file" id="fileInput" name="post_image" style="display: none;" accept="image/*">
                        <button type="submit" class="post-btn">Post</button>
                    </div>
                </div>
                </form>
            </div>




            <?php 
            // Fetch posts from the database
            $posts=getPosts();
            echo "<pre>";
print_r(getPosts());
echo "</pre>";
            foreach($posts as $post) {
                // Display each post
                echo '<div class="post-container">';
                echo '<div class="post-row">';
                echo '<div class="user-profile">';
                echo '<img src="../photos/profile/'.$post['profile_pic'].'" alt="">';
                echo '<div>';
                echo '<p>'.$post['first_name'].' '.$post['last_name'].'</p>';
                echo '<span>'.$post['created_at'].'</span>';
                echo '</div>';
                echo '</div>';
                echo '<a href="#"> <i class="fas fa-ellipsis-v"></i></a>';
                echo '</div>';

                echo '<p class="post-text">'.$post['post_text'];
                if($post['post_img']) {
                    echo '<img src="../photos/posts/'.$post['post_img'].'" alt="" class="post-img">';
                }
                
                echo '<div class="post-row">';
                echo '<div class="activity-icons">';
                // echo '<div><img src="../icons/like.png" alt="">'.$post['likes'].'</div>';
                // echo '<div><img src="../icons/comments.png" alt="">'.$post['comments'].'</div>';
                // echo '<div><img src="../icons/share.png" alt="">'.$post['shares'].'</div>';
                echo '</div>';
                echo '<div class="post-profile-icon">';
                echo '<img src="./Socialbook_img/profile-pic.png" alt=""><i class="fas fa-caret-down"></i>';
                echo '</div>';
                echo '</div>';
            }
            ?>








            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="../icons/profile-pic.png" alt="">
                        <div>
                            <p>John singh</p>
                            <span>
                                November 12, 02:00A.M
                            </span>
                        </div>
                    </div>
                    <a href="#"> <i class="fas fa-ellipsis-v"></i></a>
                </div>

                <p class="post-text">Happy Birthday Ella <br><a href="#">#birthday-special</a></p>
                <img src="../icons/member-1.jpg" alt="" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div>
                            <img src="../icons/like.png" alt="">897K
                        </div>
                        <div>
                            <img src="../icons/comments.png" alt="">458K
                        </div>
                        <div>
                            <img src="../icons/share.png" alt="">243k
                        </div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="./Socialbook_img/profile-pic.png" alt=""><i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
            <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="../icons/profile-pic.png" alt="">
                        <div>
                            <p>John singh</p>
                            <span>
                                November 12, 02:00A.M
                            </span>
                        </div>
                    </div>
                    <a href="#"> <i class="fas fa-ellipsis-v"></i></a>
                </div>

                <p class="post-text">Happy Birthday Ella <br><a href="#">#birthday-special</a></p>
                <img src="../icons/member-1.jpg" alt="" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div>
                            <img src="../icons/like.png" alt="">897K
                        </div>
                        <div>
                            <img src="../icons/comments.png" alt="">458K
                        </div>
                        <div>
                            <img src="../icons/share.png" alt="">243k
                        </div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="./Socialbook_img/profile-pic.png" alt=""><i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
          <div class="post-container">
                <div class="post-row">
                    <div class="user-profile">
                        <img src="../icons/profile-pic.png" alt="">
                        <div>
                            <p>John singh</p>
                            <span>
                                November 12, 02:00A.M
                            </span>
                        </div>
                    </div>
                    <a href="#"> <i class="fas fa-ellipsis-v"></i></a>
                </div>

                <p class="post-text">Happy Birthday Ella <br><a href="#">#birthday-special</a></p>
                <img src="../icons/member-1.jpg" alt="" class="post-img">

                <div class="post-row">
                    <div class="activity-icons">
                        <div>
                            <img src="../icons/like.png" alt="">897K
                        </div>
                        <div>
                            <img src="../icons/comments.png" alt="">458K
                        </div>
                        <div>
                            <img src="../icons/share.png" alt="">243k
                        </div>
                    </div>
                    <div class="post-profile-icon">
                        <img src="./Socialbook_img/profile-pic.png" alt=""><i class="fas fa-caret-down"></i>
                    </div>
                </div>
            </div>
            
            <button type="button" class="load-more-btn">Load More</button>
        </div>
       
        <div class="right-sidebar">


             <div class="sidebar-title">
                <h4>
                    Conversation
                </h4>
                <a href="#">
                    Hide Chat
                </a>
            </div>
            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-2.png" alt="">
                </div>
                <p>Roy Clark</p>
            </div>
            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-3.png" alt="">
                </div>
                <p>Sieena Watson</p>
            </div>
            <div class="online-list">
                <div class="online">
                    <img src="../icons/member-4.png" alt="">
                </div>
                <p>Ben Taylor</p>
            </div>
        </div>
    </div>
    <script src="../js/activity.js"></script>

    <?php include '../php/footer.php';?>
