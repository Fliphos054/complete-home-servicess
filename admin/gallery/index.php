<?php
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <h1>Gallery Management</h1>
    <a href="add.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add New Gallery Item</a>
    
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
                        <th>Image</th>
                        <th>Caption</th>
                        <th>Service</th>
                        <th>Before/After</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("
                        SELECT g.*, s.name as service_name 
                        FROM gallery g
                        LEFT JOIN services s ON g.service_id = s.id
                        ORDER BY g.id DESC
                    ");
                    while ($item = $stmt->fetch()):
                    ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td>
                            <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['caption']); ?>" style="width: 80px; height: 60px; object-fit: cover;">
                        </td>
                        <td><?php echo htmlspecialchars($item['caption']); ?></td>
                        <td><?php echo $item['service_name'] ? htmlspecialchars($item['service_name']) : 'N/A'; ?></td>
                        <td>
                            <?php if ($item['is_before_after']): ?>
                                <span class="badge bg-success">Yes</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">No</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
