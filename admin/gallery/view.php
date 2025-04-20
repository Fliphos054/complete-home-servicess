<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("
    SELECT g.*, s.name as service_name 
    FROM gallery g
    LEFT JOIN services s ON g.service_id = s.id
    WHERE g.id = ?
");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Gallery Item Details</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
    
    <div class="card">
        <div class="card-header">
            <h5><?php echo htmlspecialchars($item['caption'] ?: 'Gallery Item #' . $item['id']); ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Main Image</h4>
                    <img src="../../<?php echo htmlspecialchars($item['image_path']); ?>" class="img-fluid rounded mb-3" alt="<?php echo htmlspecialchars($item['caption']); ?>">
                    
                    <h5>Caption</h5>
                    <p><?php echo htmlspecialchars($item['caption'] ?: 'No caption'); ?></p>
                    
                    <h5>Service</h5>
                    <p><?php echo $item['service_name'] ? htmlspecialchars($item['service_name']) : 'Not assigned to any service'; ?></p>
                </div>
                
                <div class="col-md-6">
                    <?php if ($item['is_before_after']): ?>
                        <h4>Before Image</h4>
                        <?php if ($item['before_image']): ?>
                            <img src="../../<?php echo htmlspecialchars($item['before_image']); ?>" class="img-fluid rounded mb-3" alt="Before image">
                        <?php else: ?>
                            <div class="alert alert-warning">No before image uploaded</div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this gallery item?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>