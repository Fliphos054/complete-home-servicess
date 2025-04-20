<?php
include '../includes/header.php';
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    try {
        $stmt = $pdo->prepare("INSERT INTO services (name, description, icon, featured) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $icon, $featured]);
        
        $_SESSION['message'] = 'Service added successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<div class="container">
    <h1>Add New Service</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Services</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="add.php" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">Font Awesome Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-icon-name" required>
                    <small class="text-muted">Use Font Awesome icon classes (e.g., fas fa-home)</small>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured">
                    <label class="form-check-label" for="featured">Featured Service</label>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Service</button>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>