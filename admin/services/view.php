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
?>

<div class="container">
    <h1>Service Details</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Services</a>
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h2><?php echo htmlspecialchars($service['name']); ?></h2>
                    <p><strong>Icon:</strong> <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i> (<?php echo htmlspecialchars($service['icon']); ?>)</p>
                    <p><strong>Featured:</strong> 
                        <?php if ($service['featured']): ?>
                            <span class="badge bg-success">Yes</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">No</span>
                        <?php endif; ?>
                    </p>
                    <p><strong>Created:</strong> <?php echo date('M j, Y g:i a', strtotime($service['created_at'])); ?></p>
                    
                    <h4 class="mt-4">Description</h4>
                    <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-between mb-3">
                        <a href="edit.php?id=<?php echo $service['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                    
                    <h4>Categories</h4>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM service_categories WHERE service_id = ?");
                    $stmt->execute([$service['id']]);
                    $categories = $stmt->fetchAll();
                    
                    if ($categories):
                    ?>
                        <ul class="list-group mb-3">
                            <?php foreach ($categories as $category): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                    <a href="../categories/edit.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No categories found for this service.</p>
                    <?php endif; ?>
                    <a href="../categories/add.php?service_id=<?php echo $service['id']; ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                    
                    <h4 class="mt-4">Gallery Items</h4>
                    <?php
                    $stmt = $pdo->prepare("SELECT * FROM gallery WHERE service_id = ? LIMIT 3");
                    $stmt->execute([$service['id']]);
                    $galleryItems = $stmt->fetchAll();
                    
                    if ($galleryItems):
                    ?>
                        <div class="row g-2 mb-3">
                            <?php foreach ($galleryItems as $item): ?>
                                <div class="col-4">
                                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" class="img-thumbnail" alt="<?php echo htmlspecialchars($item['caption']); ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No gallery items found for this service.</p>
                    <?php endif; ?>
                    <a href="../gallery/add.php?service_id=<?php echo $service['id']; ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Gallery Item
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>