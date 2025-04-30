<?php
// Include database configuration
include('../php/config.php');

// // Start session
// session_start();

// Close database connection
if (isset($conn)) {
    $conn->close();
}
// print_r($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrivConnect Login / Signup</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
</head>
<body>
    <section>
        <div class="container">
            <div class="row full-screen align-items-center">
                <div class="left">
                    <span class="line"></span>
                    <h2>Priv<span>Connect</span></h2>
                    <p>PrivConnect helps you securely connect and share with the people who matter most in your life.</p>
                </div>
                <div class="right">
                    <div class="form">
                        <div class="text-center">
                            <h6><span>Log In</span> <span>Sign Up</span></h6>
                            <input type="checkbox" class="checkbox" id="reg-log">
                            <label for="reg-log"></label>
                            <div class="card-3d-wrap">
                                <div class="card-3d-wrapper">
                                    <!-- Login Form -->
                                    <div class="card-front">
                                        <div class="center-wrap">
                                            <h4 class="heading">Log In</h4>
                                            <form method="POST" action="../php/actions.php?login">
               
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-style" placeholder="Username" autocomplete="off">
                                                    <i class="input-icon material-icons">alternate_email</i>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-style" placeholder="Password" autocomplete="off">
                                                    <i class="input-icon material-icons">lock</i>
                                                </div>
                                                <button type="submit" name="login" class="btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Signup Form -->
                                    <div class="card-back">
                                        <div class="center-wrap">
                                            <h4 class="heading">Sign Up</h4>
                                            <form method="POST" action="../php/actions.php?signup">
                                                <div class="form-group">
                                                    <input type="text" name="first_name" class="form-style" placeholder="First Name" autocomplete="off">
                                                    <i class="input-icon material-icons">perm_identity</i>
                                                    <!-- show error -->
                                                    <?php
                                                        if(isset($_SESSION['error'])){
                                                        $error = $_SESSION['error'];
                                                        if($error['field'] == "first_name"){
                                                            echo '<p class="error-message">'.$error['msg'].'</p>';
                                                        }
                                                    }
                                                        ?>

                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="last_name" class="form-style" placeholder="Last Name" autocomplete="off">
                                                    <i class="input-icon material-icons">perm_identity</i>
                                                </div>
                                                <!-- show error -->
                                                <?php
                                                    if(isset($_SESSION['error'])){
                                                    $error = $_SESSION['error'];
                                                    if($error['field'] == "last_name"){
                                                        echo '<p class="error-message">'.$error['msg'].'</p>';
                                                    }
                                                }
                                                    ?>
                                                

                                                <div class="form-group">
                                                    <select name="gender" class="form-style">
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                    <i class="input-icon material-icons">wc</i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input type="text" name="email" class="form-style" placeholder="email" autocomplete="off">
                                                    <i class="input-icon material-icons">email</i>

                                                    <!-- show error -->
                                                    <?php
                                                        if(isset($_SESSION['error'])){
                                                        $error = $_SESSION['error'];
                                                        if($error['field'] == "email"){
                                                            echo '<p class="error-message">'.$error['msg'].'</p>';
                                                        }
                                                    }
                                                        ?>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-style" placeholder="Username" autocomplete="off">
                                                    <i class="input-icon material-icons">alternate_email</i>

                                                    <!-- show error -->
                                                    <?php
                                                        if(isset($_SESSION['error'])){
                                                        $error = $_SESSION['error'];
                                                        if($error['field'] == "username"){
                                                            echo '<p class="error-message">'.$error['msg'].'</p>';
                                                        }
                                                    }
                                                        ?>
                                                </div>

                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-style" placeholder="Create Password" autocomplete="off">
                                                    <i class="input-icon material-icons">lock</i>
                                                    <!-- show error -->
                                                    <?php
                                                        if(isset($_SESSION['error'])){
                                                        $error = $_SESSION['error'];
                                                        if($error['field'] == "password"){
                                                            echo '<p class="error-message">'.$error['msg'].'</p>';
                                                        }
                                                    }
                                                        ?>
                                                </div>
                                                <button type="submit" name="signup" class="btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>
    <?php
    unset($_SESSION['error']);
    ?>
</body>
</html>