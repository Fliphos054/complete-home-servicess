<?php
require_once 'functions.php';
$services = getServices(true); // Get featured services
$testimonials = getTestimonials();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Home Services | Parging, Roof Cleaning, Power Washing & More</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Complete Home Services</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach (getServices() as $service): ?>
                                <li><a class="dropdown-item" href="service.php?id=<?= $service['id'] ?>"><?= $service['name'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 text-white fw-bold">Complete Home & Property Services</h1>
                    <p class="lead text-white">From parging to smart home solutions - we've got you covered!</p>
                    <a href="#services" class="btn btn-primary btn-lg me-2">Our Services</a>
                    <a href="contact.php" class="btn btn-outline-light btn-lg">Get a Quote</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Featured Services -->
    <section id="services" class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Our Featured Services</h2>
                <p class="lead">Professional solutions for your home and business</p>
            </div>
            <div class="row g-4">
                <?php foreach ($services as $service): ?>
                <div class="col-md-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center">
                            <i class="<?= $service['icon'] ?> fa-3x mb-3 text-primary"></i>
                            <h3 class="card-title"><?= $service['name'] ?></h3>
                            <p class="card-text"><?= substr($service['description'], 0, 100) ?>...</p>
                            <a href="service.php?id=<?= $service['id'] ?>" class="btn btn-outline-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center mb-5">What Our Clients Say</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($testimonials as $index => $testimonial): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="testimonial-item text-center">
                                    <div class="mb-4">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="lead mb-4">"<?= $testimonial['content'] ?>"</p>
                                    <h5 class="mb-1"><?= $testimonial['client_name'] ?></h5>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Transform Your Property?</h2>
            <p class="lead mb-4">Contact us today for a free estimate on any of our services.</p>
            <a href="contact.php" class="btn btn-light btn-lg">Get Your Free Quote</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Complete Home Services</h5>
                    <p>Providing comprehensive property services for residential and commercial clients.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-white">Home</a></li>
                        <li><a href="services.php" class="text-white">Services</a></li>
                        <li><a href="gallery.php" class="text-white">Gallery</a></li>
                        <li><a href="about.php" class="text-white">About Us</a></li>
                        <li><a href="contact.php" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone me-2"></i> (123) 456-7890</li>
                        <li><i class="fas fa-envelope me-2"></i> info@completehomeservices.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Service St, Your City</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Complete Home Services. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>