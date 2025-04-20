<nav class="admin-nav">
    <div class="nav-header">
        <h2>Admin Panel</h2>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_name']); ?></p>
    </div>
    <ul class="nav-links">
        <li>
            <a href="<?php echo BASE_URL; ?>dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>services/index.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'services') !== false ? 'active' : ''; ?>">
                <i class="fas fa-concierge-bell"></i> Services
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>categories/index.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'categories') !== false ? 'active' : ''; ?>">
                <i class="fas fa-tags"></i> Categories
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>gallery/index.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'gallery') !== false ? 'active' : ''; ?>">
                <i class="fas fa-images"></i> Gallery
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>testimonials/index.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'testimonials') !== false ? 'active' : ''; ?>">
                <i class="fas fa-comment-alt"></i> Testimonials
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>submissions/contact.php" class="<?php echo strpos($_SERVER['REQUEST_URI'], 'submissions') !== false ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i> Messages
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>profile.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                <i class="fas fa-user-cog"></i> Profile
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL; ?>logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</nav>