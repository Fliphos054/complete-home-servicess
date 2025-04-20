<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM service_categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $service_id = $_POST['service_id'] ?: null;
    
    try {
        $stmt = $pdo->prepare("UPDATE service_categories SET name = ?, service_id = ? WHERE id = ?");
        $stmt->execute([$name, $service_id, $id]);
        
        $_SESSION['message'] = 'Category updated successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get services for dropdown
$services = $pdo->query("SELECT id, name FROM services ORDER BY name")->fetchAll();
?>

<div class="container">
    <h1>Edit Category</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Categories</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="edit.php?id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="service_id" class="form-label">Service (optional)</label>
                    <select class="form-select" id="service_id" name="service_id">
                        <option value="">-- Select Service --</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo $service['id'] == $category['service_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($service['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Category</button>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>