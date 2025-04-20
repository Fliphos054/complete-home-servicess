<?php
include '../../includes/header.php';
include '../../includes/navbar.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM gallery WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = $_POST['service_id'] ?: null;
    $caption = trim($_POST['caption']);
    $is_before_after = isset($_POST['is_before_after']) ? 1 : 0;
    
    $image_path = $item['image_path'];
    $before_image = $item['before_image'];
    
    // Handle main image update
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../../assets/uploads/gallery/';
        $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $file_name = 'gallery_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // Delete old image if it exists
            if ($image_path && file_exists('../../' . $image_path)) {
                unlink('../../' . $image_path);
            }
            $image_path = 'assets/uploads/gallery/' . $file_name;
        } else {
            $error = "Failed to upload image.";
        }
    }
    
    // Handle before image update
    if ($is_before_after && isset($_FILES['before_image']) && $_FILES['before_image']['error'] == UPLOAD_ERR_OK) {
        $file_ext = pathinfo($_FILES['before_image']['name'], PATHINFO_EXTENSION);
        $file_name = 'before_' . time() . '.' . $file_ext;
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['before_image']['tmp_name'], $target_path)) {
            // Delete old before image if it exists
            if ($before_image && file_exists('../../' . $before_image)) {
                unlink('../../' . $before_image);
            }
            $before_image = 'assets/uploads/gallery/' . $file_name;
        } else {
            $error = "Failed to upload before image.";
        }
    } elseif (!$is_before_after && $before_image) {
        // Delete before image if unchecked
        if (file_exists('../../' . $before_image)) {
            unlink('../../' . $before_image);
        }
        $before_image = null;
    }
    
    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("
                UPDATE gallery 
                SET service_id = ?, image_path = ?, caption = ?, is_before_after = ?, before_image = ?
                WHERE id = ?
            ");
            $stmt->execute([$service_id, $image_path, $caption, $is_before_after, $before_image, $id]);
            
            $_SESSION['message'] = 'Gallery item updated successfully!';
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
    <h1>Edit Gallery Item</h1>
    <a href="index.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Back to Gallery</a>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-body">
            <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="service_id" class="form-label">Service (optional)</label>
                    <select class="form-select" id="service_id" name="service_id">
                        <option value="">-- Select Service --</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?php echo $service['id']; ?>" <?php echo $service['id'] == $item['service_id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($service['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" class="form-control" id="caption" name="caption" value="<?php echo htmlspecialchars($item['caption']); ?>">
                </div>
                
                <div class="mb-3 image-upload">
                    <label for="image" class="form-label">Current Image</label>
                    <div class="image-preview mb-2" style="width: 200px; height: 150px; background-image: url('../../<?php echo htmlspecialchars($item['image_path']); ?>'); background-size: cover; background-position: center;"></div>
                    <input type="file" class="form-control" id="image" name="image">
                    <small class="text-muted">Leave blank to keep current image</small>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_before_after" name="is_before_after" <?php echo $item['is_before_after'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="is_before_after">This is a Before/After item</label>
                </div>
                
                <div class="mb-3 before-after-field" style="<?php echo !$item['is_before_after'] ? 'display: none;' : ''; ?>">
                    <label for="before_image" class="form-label">Before Image</label>
                    <?php if ($item['is_before_after'] && $item['before_image']): ?>
                        <div class="image-preview mb-2" style="width: 200px; height: 150px; background-image: url('../../<?php echo htmlspecialchars($item['before_image']); ?>'); background-size: cover; background-position: center;"></div>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="before_image" name="before_image">
                    <small class="text-muted">Leave blank to keep current image</small>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Gallery Item</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('is_before_after').addEventListener('change', function() {
    document.querySelector('.before-after-field').style.display = this.checked ? 'block' : 'none';
});
</script>

<?php include '../../includes/footer.php'; ?>