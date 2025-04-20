<?php
include '../includes/config.php';
requireAuth();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['message'] = 'Service deleted successfully!';
        $_SESSION['message_type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Error deleting service: ' . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }
}

header("Location: index.php");
exit();
?>