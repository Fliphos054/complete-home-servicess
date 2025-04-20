<?php
include '../includes/header.php';
include '../includes/navbar.php';

// Assuming you have a table for quote submissions (similar to contact_submissions)
// You might need to create this table if it doesn't exist

// Handle quote deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM quote_submissions WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['message'] = 'Quote request deleted successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: quotes.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// View single quote
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("
        SELECT q.*, s.name as service_name 
        FROM quote_submissions q
        LEFT JOIN services s ON q.service_id = s.id
        WHERE q.id = ?
    ");
    $stmt->execute([$id]);
    $quote = $stmt->fetch();
    
    if (!$quote) {
        header("Location: quotes.php");
        exit();
    }
} else {
    // List all quotes
    $stmt = $pdo->query("
        SELECT q.*, s.name as service_name 
        FROM quote_submissions q
        LEFT JOIN services s ON q.service_id = s.id
        ORDER BY q.submitted_at DESC
    ");
    $quotes = $stmt->fetchAll();
}
?>

<div class="container">
    <h1>Quote Requests</h1>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($quote)): ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Quote Request from <?php echo htmlspecialchars($quote['name']); ?></h5>
                <div>
                    <a href="mailto:<?php echo htmlspecialchars($quote['email']); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-reply"></i> Reply
                    </a>
                    <a href="quotes.php?delete=<?php echo $quote['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this quote request?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($quote['email']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> <?php echo htmlspecialchars($quote['phone'] ?: 'N/A'); ?></p>
                    </div>
                </div>
                
                <?php if ($quote['service_name']): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Service:</strong> <?php echo htmlspecialchars($quote['service_name']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="row mb-3">
                    <div class="col-12">
                        <p><strong>Project Details:</strong></p>
                        <div class="border p-3 bg-light">
                            <?php echo nl2br(htmlspecialchars($quote['message'])); ?>
                        </div>
                    </div>
                </div>
                
                <?php if ($quote['project_date']): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p><strong>Preferred Project Date:</strong> <?php echo date('M j, Y', strtotime($quote['project_date'])); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-footer text-muted">
                Submitted on <?php echo date('M j, Y g:i a', strtotime($quote['submitted_at'])); ?>
            </div>
        </div>
        
        <a href="quotes.php" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i> Back to Quotes</a>
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
                        <?php foreach ($quotes as $quote): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($quote['name']); ?></td>
                            <td><?php echo htmlspecialchars($quote['email']); ?></td>
                            <td><?php echo $quote['service_name'] ? htmlspecialchars($quote['service_name']) : 'N/A'; ?></td>
                            <td><?php echo date('M j, Y', strtotime($quote['submitted_at'])); ?></td>
                            <td>
                                <a href="quotes.php?id=<?php echo $quote['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                <a href="quotes.php?delete=<?php echo $quote['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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