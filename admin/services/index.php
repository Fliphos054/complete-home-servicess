<?php
include '../includes/header.php';
include '../includes/navbar.php';

// Verify database connection and data
try {
    $stmt = $pdo->query("SELECT id, name, icon, featured, created_at FROM services ORDER BY created_at DESC");
    if (!$stmt->rowCount()) {
        echo "<div class='alert alert-warning'>No services found in database</div>";
    }
} catch (PDOException $e) {
    die("<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>");
}
?>

<div class="container">
    <h1>Services Management</h1>
    <a href="add.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add New Service</a>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); unset($_SESSION['message_type']); ?>
        </div>
    <?php endif; ?>
    
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Name</th>
                        <th width="10%">Icon</th>
                        <th width="10%">Featured</th>
                        <th width="15%">Created</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($service = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo $service['id']; ?></td>
                        <td><?php echo htmlspecialchars($service['name']); ?></td>
                        <td class="text-center">
                            <?php if (!empty($service['icon'])): ?>
                                <i class="<?php echo htmlspecialchars($service['icon']); ?> fa-lg"></i>
                            <?php else: ?>
                                <span class="text-muted">N/A</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if ($service['featured']): ?>
                                <span class="badge bg-success p-2">Yes</span>
                            <?php else: ?>
                                <span class="badge bg-secondary p-2">No</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('M j, Y', strtotime($service['created_at'])); ?></td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="edit.php?id=<?php echo $service['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="view.php?id=<?php echo $service['id']; ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="delete.php" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>