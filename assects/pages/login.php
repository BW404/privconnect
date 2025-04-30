<?php
// Include database configuration
include('../php/config.php');

// Start session
session_start();

// Initialize error variable
$error = "";

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.html'); // Redirect to dashboard if logged in
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Prepare and execute SQL statement to check credentials
        $stmt = $conn->prepare("SELECT user_id, password FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the hashed password
            if (password_verify($password, $user['password'])) {
                // User found, set session variables
                $_SESSION['user_id'] = $user['user_id'];
                header('Location: dashboard.html'); // Redirect to dashboard
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}

// Handle signup form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $full_name = $_POST['full_name'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($full_name) || empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement to insert new user
        $stmt = $conn->prepare("INSERT INTO user (full_name, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $username, $hashed_password);
        if ($stmt->execute()) {
            header('Location: login.php'); // Redirect to login page after successful signup
            exit;
        } else {
            $error = "Error creating account. Please try again.";
        }
    }
}

// Close database connection
if (isset($conn)) {
    $conn->close();
}
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
                                                <?php if (!empty($error)): ?>
                                                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
                                                <?php endif; ?>
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
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" name="last_name" class="form-style" placeholder="Last Name" autocomplete="off">
                                                    <i class="input-icon material-icons">perm_identity</i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <select name="gender" class="form-style">
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="1">Male</option>
                                                        <option value="2">Female</option>
                                                    </select>
                                                    <i class="input-icon material-icons">wc</i>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <input type="text" name="username" class="form-style" placeholder="Username" autocomplete="off">
                                                    <i class="input-icon material-icons">alternate_email</i>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name="eamil" class="form-style" placeholder="email" autocomplete="off">
                                                    <i class="input-icon material-icons">email</i>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-style" placeholder="Create Password" autocomplete="off">
                                                    <i class="input-icon material-icons">lock</i>
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
</body>
</html>