<?php
include '../includes/header.php';
include '../includes/navbar.php';

// Handle message deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM contact_submissions WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['message'] = 'Message deleted successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: contact.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// View single message
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("
        SELECT c.*, s.name as service_name 
        FROM contact_submissions c
        LEFT JOIN services s ON c.service_id = s.id
        WHERE c.id = ?
    ");
    $stmt->execute([$id]);
    $message = $stmt->fetch();
    
    if (!$message) {
        header("Location: contact.php");
        exit();
    }
    
    // Mark as read (you could add a 'read' column to the table)
    // $pdo->prepare("UPDATE contact_submissions SET is_read = 1 WHERE id = ?")->execute([$id]);
} else {
    // List all messages
    $stmt = $pdo->query("
        SELECT c.*, s.name as service_name 
        FROM contact_submissions c
        LEFT JOIN services s ON c.service_id = s.id
        ORDER BY c.submitted_at DESC
    ");
    $messages = $stmt->fetchAll();
}
?>

<div class="container">
    <h1>Contact Submissions</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($message)): ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Message from <?php echo htmlspecialchars($message['name']); ?></h5>
                <div>
                    <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-reply"></i> Reply
                    </a>
                    <a href="contact.php?delete=<?php echo $message['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($message['phone'] ?: 'N/A'); ?></p>
                    </div>
                </div>
                
                <?php if ($message['service_name']): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Service:</strong> <?php echo htmlspecialchars($message['service_name']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="row">
                    <div class="col-12">
                        <p><strong>Message:</strong></p>
                        <div class="border p-3 bg-light">
                            <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                Submitted on <?php echo date('M j, Y g:i a', strtotime($message['submitted_at'])); ?>
            </div>
        </div>
        
        <a href="contact.php" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Back to Messages</a>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($msg['name']); ?></td>
                            <td><?php echo htmlspecialchars($msg['email']); ?></td>
                            <td><?php echo $msg['service_name'] ? htmlspecialchars($msg['service_name']) : 'N/A'; ?></td>
                            <td><?php echo date('M j, Y', strtotime($msg['submitted_at'])); ?></td>
                            <td>
                                <a href="contact.php?id=<?php echo $msg['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="contact.php?delete=<?php echo $msg['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>