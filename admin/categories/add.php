<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $service_id = $_POST['service_id'] ?: null;
    
    try {
        $stmt = $pdo->prepare("INSERT INTO service_categories (name, service_id) VALUES (?, ?)");
        $stmt->execute([$name, $service_id]);
        
        $_SESSION['message'] = 'Category added successfully!';
        $_SESSION['message_type'] = 'success';
        
        if (isset($_GET['service_id'])) {
            header("Location: ../services/view.php?id=" . $_GET['service_id']);
        } else {
            header("Location: index.php");
        }
        exit();
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get services for dropdown
$services = $pdo->query("SELECT id, name FROM services ORDER BY name")->fetchAll();
?>

<div class="container">
    <h1>Add Service Category</h1>
    <a href="<?php echo isset($_GET['service_id']) ? '../services/view.php?id=' . $_GET['service_id'] : 'index.php'; ?>" class="btn btn-secondary mb-3">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="add.php<?php echo isset($_GET['service_id']) ? '?service_id=' . $_GET['service_id'] : ''; ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                
                <div class="mb-3">
                    <label for="service_id" class="form-label">Service (optional)</label>
                    <select class="form-select" id="service_id" name="service_id">
                        <option value="">-- Select Service --</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo isset($_GET['service_id']) && $_GET['service_id'] == $service['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($service['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Category</button>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>