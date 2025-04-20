<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Debugging output (visible only if login fails)
    $debug_info = "";
    $debug_info .= "Trying to login with:\n";
    $debug_info .= "Username: " . htmlspecialchars($username) . "\n";
    $debug_info .= "Password: " . htmlspecialchars($password) . "\n\n";

    try {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        $debug_info .= "Database results:\n";
        $debug_info .= print_r($admin, true) . "\n\n";

        if ($admin) {
            $debug_info .= "Password verification: " . (password_verify($password, $admin['password_hash']) ? "SUCCESS" : "FAILED") . "\n";
            $debug_info .= "Stored hash: " . $admin['password_hash'] . "\n";
            
            // =============================================
            // TEMPORARY BYPASS - REMOVE AFTER TESTING
            // Allows login with either:
            // 1. Correct password hash OR
            // 2. Exact password match 'password123'
            if (password_verify($password, $admin['password_hash']) || $password === 'password123') {
            // =============================================
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                
                // Update last login
                $update = $pdo->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
                $update->execute([$admin['id']]);
                
                header("Location: dashboard.php");
                exit();
            }
        }

        // If we reach here, login failed
        $error = "Invalid username or password.";
        error_log("Login failed:\n" . $debug_info); // Log to server error log
        
    } catch (PDOException $e) {
        $error = "Database error occurred. Please try again.";
        error_log("Database error during login: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .debug-info {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 10px;
            margin-top: 20px;
            font-family: monospace;
            white-space: pre-wrap;
            display: none; /* Hidden by default */
        }
    </style>
</head>
<body class="login-page">
    <div class="login-container">
        <h1><i class="fas fa-lock"></i> Admin Login</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
                <button type="button" onclick="document.querySelector('.debug-info').style.display='block'" 
                        style="float:right; background:none; border:none; color:#fff; cursor:pointer">
                    <i class="fas fa-bug"></i>
                </button>
            </div>
            <div class="debug-info">
                <?php echo isset($debug_info) ? nl2br(htmlspecialchars($debug_info)) : 'No debug information available'; ?>
                <hr>
                <small>Technical information above is visible because login failed.</small>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-key"></i> Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>