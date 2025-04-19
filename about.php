<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | PowerClean Tech Solutions</title>
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
            <a class="navbar-brand" href="index.php">PowerClean Tech Solutions</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
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
                    <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- About Header -->
    <section class="page-header py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/about-bg.jpg'); background-size: cover;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold">Our Story</h1>
                    <p class="lead">From humble beginnings to industry leaders in property services and smart technology</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="mb-4">The PowerClean Tech Solutions Journey</h2>
                    <p>Founded in 2015 by brothers Michael and David Chen, PowerClean Tech Solutions began as a small power washing operation with just one truck and a dream. What started as a weekend business serving local homeowners quickly grew into a full-service property maintenance company.</p>
                    <p>In 2018, we expanded our services to include parging and roof cleaning after noticing how many clients needed these complementary services. Our commitment to quality work and customer satisfaction helped us grow through word-of-mouth referrals.</p>
                    <p>The turning point came in 2020 when we installed smart home technology in our own office and realized how these solutions could benefit our clients. This led to the creation of our Smart Home Solutions division, combining our expertise in property maintenance with cutting-edge technology.</p>
                    <p>Today, PowerClean Tech Solutions employs over 50 dedicated professionals serving residential and commercial clients across the region. We're proud to have maintained our family-owned values while embracing innovation to deliver comprehensive property care.</p>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow">
                        <img src="assets/images/founders.jpg" class="card-img-top" alt="PowerClean Tech Solutions Founders">
                        <div class="card-body">
                            <p class="card-text text-center"><em>Michael and David Chen, Founders of PowerClean Tech Solutions</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Values -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Our Mission & Values</h2>
                <p class="lead">What drives us every day</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-bullseye fa-3x mb-3 text-primary"></i>
                            <h3 class="h4">Our Mission</h3>
                            <p>To enhance property value and quality of life through exceptional maintenance services and smart technology solutions, delivered with integrity and innovation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-eye fa-3x mb-3 text-primary"></i>
                            <h3 class="h4">Our Vision</h3>
                            <p>To be the most trusted name in integrated property services, recognized for our technical expertise, environmental responsibility, and transformative results.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="fas fa-hand-holding-heart fa-3x mb-3 text-primary"></i>
                            <h3 class="h4">Our Values</h3>
                            <ul class="list-unstyled text-start">
                                <li><i class="fas fa-check text-success me-2"></i> Integrity in all we do</li>
                                <li><i class="fas fa-check text-success me-2"></i> Innovation through technology</li>
                                <li><i class="fas fa-check text-success me-2"></i> Environmental responsibility</li>
                                <li><i class="fas fa-check text-success me-2"></i> Community commitment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Meet Our Leadership Team</h2>
                <p class="lead">The people behind PowerClean Tech Solutions</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card team-card h-100 border-0 shadow-sm">
                        <img src="assets/images/team/michael.jpg" class="card-img-top" alt="Michael Chen">
                        <div class="card-body text-center">
                            <h3 class="h4">Michael Chen</h3>
                            <p class="text-muted">CEO & Co-Founder</p>
                            <p>With a background in civil engineering, Michael oversees our technical operations and service innovation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card h-100 border-0 shadow-sm">
                        <img src="assets/images/team/david.jpg" class="card-img-top" alt="David Chen">
                        <div class="card-body text-center">
                            <h3 class="h4">David Chen</h3>
                            <p class="text-muted">COO & Co-Founder</p>
                            <p>David manages our daily operations and client relationships, ensuring seamless service delivery.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card h-100 border-0 shadow-sm">
                        <img src="assets/images/team/sarah.jpg" class="card-img-top" alt="Sarah Johnson">
                        <div class="card-body text-center">
                            <h3 class="h4">Sarah Johnson</h3>
                            <p class="text-muted">Director of Smart Solutions</p>
                            <p>Sarah leads our smart home division, bringing 10 years of home automation experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Milestones -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h2>Our Milestones</h2>
                <p class="lead">Key moments in our growth journey</p>
            </div>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">2015</div>
                    <div class="timeline-content">
                        <h3>Company Founded</h3>
                        <p>Launched with basic power washing services for residential clients in the local area.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2017</div>
                    <div class="timeline-content">
                        <h3>First Commercial Contract</h3>
                        <p>Secured our first major commercial client, a 20-building apartment complex.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2019</div>
                    <div class="timeline-content">
                        <h3>Expanded Service Offerings</h3>
                        <p>Added parging, roof cleaning, and snow removal services to our portfolio.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2021</div>
                    <div class="timeline-content">
                        <h3>Smart Solutions Launch</h3>
                        <p>Introduced our smart home technology division, combining maintenance with modern tech.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-date">2023</div>
                    <div class="timeline-content">
                        <h3>50+ Employee Milestone</h3>
                        <p>Grew our team to over 50 professionals serving the tri-state area.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Involvement -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <h2 class="mb-4">Giving Back to Our Community</h2>
                    <p>At PowerClean Tech Solutions, we believe in supporting the communities that have supported us. Each year, we dedicate time and resources to several important initiatives:</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <strong>Clean Schools Program:</strong> Providing free power washing services to local schools</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <strong>Veterans Housing Initiative:</strong> Discounted services for veteran-owned properties</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <strong>Eco-Education:</strong> Hosting workshops on sustainable property maintenance</li>
                        <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <strong>Seasonal Drives:</strong> Organizing food and coat drives for local shelters</li>
                    </ul>
                    <p>In 2024 alone, we've contributed over 500 hours of pro bono services to community organizations and nonprofits.</p>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="card shadow">
                        <img src="assets/images/community.jpg" class="card-img-top" alt="Community Involvement">
                        <div class="card-body">
                            <p class="card-text text-center"><em>Our team volunteering at the annual Community Clean Day</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>PowerClean Tech Solutions</h5>
                    <p>Comprehensive property services and smart technology solutions for residential and commercial clients.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
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
                        <li><i class="fas fa-phone me-2"></i> (555) 123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i> info@powercleantech.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Service Drive, Tech City, TC 10101</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> PowerClean Tech Solutions. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>