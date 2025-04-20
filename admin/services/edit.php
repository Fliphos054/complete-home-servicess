<?php
include '../includes/header.php';
include '../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM services WHERE id = ?");
$stmt->execute([$id]);
$service = $stmt->fetch();

if (!$service) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $icon = trim($_POST['icon']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    
    try {
        $stmt = $pdo->prepare("UPDATE services SET name = ?, description = ?, icon = ?, featured = ? WHERE id = ?");
        $stmt->execute([$name, $description, $icon, $featured, $id]);
        
        $_SESSION['message'] = 'Service updated successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<div class="container">
    <h1>Edit Service</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Services</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="edit.php?id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Service Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($service['name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="5" required><?php echo htmlspecialchars($service['description']); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="icon" class="form-label">Font Awesome Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?php echo htmlspecialchars($service['icon']); ?>" required>
                    <small class="text-muted">Use Font Awesome icon classes (e.g., fas fa-home)</small>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="featured" name="featured" <?php echo $service['featured'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="featured">Featured Service</label>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Service</button>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>