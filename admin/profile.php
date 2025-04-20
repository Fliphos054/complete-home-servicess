<?php
include 'includes/header.php';
include 'includes/navbar.php';

$admin_id = $_SESSION['admin_id'];
$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $username = trim($_POST['username']);
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);
    
    $errors = [];
    
    // Validate username
    if ($username != $admin['username']) {
        $check = $pdo->prepare("SELECT id FROM admins WHERE username = ?");
        $check->execute([$username]);
        if ($check->fetch()) {
            $errors[] = "Username is already taken.";
        }
    }
    
    // Validate password change
    if (!empty($new_password)) {
        if (!password_verify($current_password, $admin['password_hash'])) {
            $errors[] = "Current password is incorrect.";
        } elseif ($new_password != $confirm_password) {
            $errors[] = "New passwords do not match.";
        } elseif (strlen($new_password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
    }
    
    if (empty($errors)) {
        try {
            $update_data = [
                'full_name' => $full_name,
                'username' => $username,
                'id' => $admin_id
            ];
            
            $sql = "UPDATE admins SET full_name = :full_name, username = :username";
            
            if (!empty($new_password)) {
                $update_data['password_hash'] = password_hash($new_password, PASSWORD_DEFAULT);
                $sql .= ", password_hash = :password_hash";
            }
            
            $sql .= " WHERE id = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($update_data);
            
            $_SESSION['admin_name'] = $full_name;
            $_SESSION['message'] = 'Profile updated successfully!';
            $_SESSION['message_type'] = 'success';
            header("Location: profile.php");
            exit();
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<div class="container">
    <h1>Admin Profile</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Profile Information</h5>
                </div>
                <div class="card-body">
                    <form action="profile.php" method="post">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo htmlspecialchars($admin['full_name']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password (required for changes)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password (leave blank to keep current)</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Account Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Account Created</label>
                        <p><?php echo date('M j, Y g:i a', strtotime($admin['created_at'])); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Last Login</label>
                        <p><?php echo $admin['last_login'] ? date('M j, Y g:i a', strtotime($admin['last_login'])) : 'Never logged in'; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>