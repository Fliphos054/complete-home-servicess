<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container">
    <h1>Dashboard</h1>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div class="stat-info">
                <h3>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM services");
                    echo $stmt->fetchColumn();
                    ?>
                </h3>
                <p>Services</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-images"></i>
            </div>
            <div class="stat-info">
                <h3>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM gallery");
                    echo $stmt->fetchColumn();
                    ?>
                </h3>
                <p>Gallery Items</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-comment-alt"></i>
            </div>
            <div class="stat-info">
                <h3>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM testimonials");
                    echo $stmt->fetchColumn();
                    ?>
                </h3>
                <p>Testimonials</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon bg-danger">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-info">
                <h3>
                    <?php 
                    $stmt = $pdo->query("SELECT COUNT(*) FROM contact_submissions");
                    echo $stmt->fetchColumn();
                    ?>
                </h3>
                <p>Messages</p>
            </div>
        </div>
    </div>
    
    <div class="recent-activity">
        <h2>Recent Contact Submissions</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("
                    SELECT c.*, s.name as service_name 
                    FROM contact_submissions c
                    LEFT JOIN services s ON c.service_id = s.id
                    ORDER BY submitted_at DESC LIMIT 5
                ");
                while ($row = $stmt->fetch()):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo $row['service_name'] ? htmlspecialchars($row['service_name']) : 'N/A'; ?></td>
                    <td><?php echo date('M j, Y g:i a', strtotime($row['submitted_at'])); ?></td>
                    <td>
                        <a href="../submissions/contact.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>