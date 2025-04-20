<?php
include '../includes/header.php';
include '../includes/navbar.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'] ?: null;
    $caption = trim($_POST['caption']);
    $is_before_after = isset($_POST['is_before_after']) ? 1 : 0;
    
    // Handle file upload
    $image_path = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../../assets/uploads/gallery/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $file_name = 'gallery_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            $image_path = 'assets/uploads/gallery/' . $file_name;
        } else {
            $error = "Failed to upload image.";
        }
    } else {
        $error = "Please select an image to upload.";
    }
    
    // Handle before image if this is a before/after item
    $before_image = null;
    if ($is_before_after && isset($_FILES['before_image']) && $_FILES['before_image']['error'] == UPLOAD_ERR_OK) {
        $file_ext = pathinfo($_FILES['before_image']['name'], PATHINFO_EXTENSION);
        $file_name = 'before_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['before_image']['tmp_name'], $target_path)) {
            $before_image = 'assets/uploads/gallery/' . $file_name;
        } else {
            $error = "Failed to upload before image.";
        }
    }
    
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO gallery (service_id, image_path, caption, is_before_after, before_image)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$service_id, $image_path, $caption, $is_before_after, $before_image]);
            
            $_SESSION['message'] = 'Gallery item added successfully!';
            $_SESSION['message_type'] = 'success';
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}

// Get services for dropdown
$services = $pdo->query("SELECT id, name FROM services ORDER BY name")->fetchAll();
?>

<div class="container">
    <h1>Add Gallery Item</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="add.php" method="post" enctype="multipart/form-data">
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
                
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control" id="caption" name="caption">
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    <small class="text-muted">Upload the main image for this gallery item</small>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_before_after" name="is_before_after">
                    <label class="form-check-label" for="is_before_after">This is a Before/After item</label>
                </div>
                
                <div class="mb-3 before-after-field" style="display: none;">
                    <label for="before_image" class="form-label">Before Image</label>
                    <input type="file" class="form-control" id="before_image" name="before_image">
                    <small class="text-muted">Upload the "before" image for comparison</small>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Gallery Item</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('is_before_after').addEventListener('change', function() {
    document.querySelector('.before-after-field').style.display = this.checked ? 'block' : 'none';
});
</script>

<?php include '../includes/footer.php'; ?>