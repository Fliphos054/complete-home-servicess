<?php
include '../includes/header.php';
include '../includes/navbar.php';

// Get all categories with service names
$stmt = $pdo->query("
    SELECT c.*, s.name as service_name 
    FROM service_categories c
    LEFT JOIN services s ON c.service_id = s.id
    ORDER BY c.name
");
$categories = $stmt->fetchAll();
?>

<div class="container">
    <h1>Service Categories</h1>
    <a href="add.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add New Category</a>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo $category['service_name'] ? htmlspecialchars($category['service_name']) : 'N/A'; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $category['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>