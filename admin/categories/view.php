<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("
    SELECT c.*, s.name as service_name 
    FROM service_categories c
    LEFT JOIN services s ON c.service_id = s.id
    WHERE c.id = ?
");
$stmt->execute([$id]);
$category = $stmt->fetch();

if (!$category) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Category Details</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Categories</a>
    
    <div class="card">
        <div class="card-header">
            <h5><?php echo htmlspecialchars($category['name']); ?></h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h5>Service</h5>
                <p><?php echo $category['service_name'] ? htmlspecialchars($category['service_name']) : 'Not assigned to any service'; ?></p>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="edit.php?id=<?php echo $category['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>