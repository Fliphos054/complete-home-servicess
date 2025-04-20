<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("
    SELECT t.*, s.name as service_name 
    FROM testimonials t
    LEFT JOIN services s ON t.service_id = s.id
    WHERE t.id = ?
");
$stmt->execute([$id]);
$testimonial = $stmt->fetch();

if (!$testimonial) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h1>Testimonial Details</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Testimonials</a>
    
    <div class="card">
        <div class="card-header">
            <h5>Testimonial from <?php echo htmlspecialchars($testimonial['client_name']); ?></h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h5>Rating</h5>
                <div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'text-warning' : 'text-secondary'; ?> fa-lg"></i>
                    <?php endfor; ?>
                    <span class="ms-2">(<?php echo $testimonial['rating']; ?>/5)</span>
                </div>
            </div>
            
            <div class="mb-4">
                <h5>Service</h5>
                <p><?php echo $testimonial['service_name'] ? htmlspecialchars($testimonial['service_name']) : 'Not associated with any service'; ?></p>
            </div>
            
            <div class="mb-4">
                <h5>Testimonial Content</h5>
                <div class="border p-3 bg-light rounded">
                    <?php echo nl2br(htmlspecialchars($testimonial['content'])); ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="edit.php?id=<?php echo $testimonial['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $testimonial['id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this testimonial?')">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>