<?php
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="container">
    <h1>Testimonials Management</h1>
    <a href="add.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Add New Testimonial</a>
    
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
                        <th>Client Name</th>
                        <th>Rating</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("
                        SELECT t.*, s.name as service_name 
                        FROM testimonials t
                        LEFT JOIN services s ON t.service_id = s.id
                        ORDER BY t.id DESC
                    ");
                    while ($testimonial = $stmt->fetch()):
                    ?>
                    <tr>
                        <td><?php echo $testimonial['id']; ?></td>
                        <td><?php echo htmlspecialchars($testimonial['client_name']); ?></td>
                        <td>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'text-warning' : 'text-secondary'; ?>"></i>
                            <?php endfor; ?>
                        </td>
                        <td><?php echo $testimonial['service_name'] ? htmlspecialchars($testimonial['service_name']) : 'N/A'; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <form action="delete.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
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