<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM testimonials WHERE id = ?");
$stmt->execute([$id]);
$testimonial = $stmt->fetch();

if (!$testimonial) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_name = trim($_POST['client_name']);
    $content = trim($_POST['content']);
    $rating = (int)$_POST['rating'];
    $service_id = $_POST['service_id'] ?: null;
    
    try {
        $stmt = $pdo->prepare("
            UPDATE testimonials 
            SET client_name = ?, content = ?, rating = ?, service_id = ?
            WHERE id = ?
        ");
        $stmt->execute([$client_name, $content, $rating, $service_id, $id]);
        
        $_SESSION['message'] = 'Testimonial updated successfully!';
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
    <h1>Edit Testimonial</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Testimonials</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="edit.php?id=<?php echo $id; ?>" method="post">
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo htmlspecialchars($testimonial['client_name']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Testimonial Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($testimonial['content']); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <select class="form-select" id="rating" name="rating" required>
                        <option value="5" <?php echo $testimonial['rating'] == 5 ? 'selected' : ''; ?>>★★★★★ (5)</option>
                        <option value="4" <?php echo $testimonial['rating'] == 4 ? 'selected' : ''; ?>>★★★★☆ (4)</option>
                        <option value="3" <?php echo $testimonial['rating'] == 3 ? 'selected' : ''; ?>>★★★☆☆ (3)</option>
                        <option value="2" <?php echo $testimonial['rating'] == 2 ? 'selected' : ''; ?>>★★☆☆☆ (2)</option>
                        <option value="1" <?php echo $testimonial['rating'] == 1 ? 'selected' : ''; ?>>★☆☆☆☆ (1)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="service_id" class="form-label">Service (optional)</label>
                    <select class="form-select" id="service_id" name="service_id">
                        <option value="">-- Select Service --</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo $service['id'] == $testimonial['service_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($service['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Testimonial</button>
            </form>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>