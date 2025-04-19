<?php
require_once 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$service_id = $_GET['id'];
$service = getServiceById($service_id);
$service_testimonials = getTestimonials($service_id);

if (!$service) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $service['name'] ?> | Complete Home Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation (same as index.php) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- ... same nav as index.php ... -->
    </nav>

    <!-- Service Header -->
    <section class="service-header py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/services/<?= strtolower(str_replace(' ', '-', $service['name'])) ?>.jpg'); background-size: cover;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold"><?= $service['name'] ?></h1>
                    <p class="lead"><?= $service['description'] ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">About Our <?= $service['name'] ?> Service</h2>
                    <div class="service-content">
                        <?php if ($service['name'] === 'Marble Installation'): ?>
                            <div class="mb-4">
                                <h4>Featured Marble Styles</h4>
                                <div id="tiktokMarbleGallery" class="row g-3">
                                    <!-- This would be populated via JavaScript with TikTok API -->
                                </div>
                                <div class="alert alert-info mt-3">
                                    <i class="fas fa-info-circle me-2"></i> Check out our TikTok for the latest marble trends!
                                </div>
                            </div>
                        <?php elseif ($service['name'] === 'Smart Home Solutions'): ?>
                            <div class="mb-4">
                                <h4>Smart Home Packages</h4>
                                <div class="accordion" id="smartHomeAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#basicPackage">
                                                Basic Smart Home Package
                                            </button>
                                        </h2>
                                        <div id="basicPackage" class="accordion-collapse collapse show" data-bs-parent="#smartHomeAccordion">
                                            <div class="accordion-body">
                                                <ul>
                                                    <li>Smart lighting for 5 rooms</li>
                                                    <li>Smart thermostat</li>
                                                    <li>2 smart plugs</li>
                                                    <li>Basic security camera (1 unit)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- More packages would go here -->
                                </div>
                            </div>
                        <?php endif; ?>

                        <h3>Our Process</h3>
                        <div class="process-steps">
                            <div class="step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h5>Consultation</h5>
                                    <p>We discuss your needs and assess your property.</p>
                                </div>
                            </div>
                            <!-- More steps would go here -->
                        </div>

                        <h3 class="mt-5">Why Choose Us</h3>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Experienced professionals</li>
                            <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Quality materials and equipment</li>
                            <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> Satisfaction guaranteed</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h4 class="card-title">Get a Free Quote</h4>
                            <form action="submit_quote.php" method="POST">
                                <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="message" rows="3" placeholder="Tell us about your project"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Request Quote</button>
                            </form>
                        </div>
                    </div>

                    <?php if (!empty($service_testimonials)): ?>
                    <div class="card mt-4 shadow">
                        <div class="card-body">
                            <h4 class="card-title">What Clients Say</h4>
                            <?php foreach ($service_testimonials as $testimonial): ?>
                                <div class="testimonial-item mb-3">
                                    <div class="mb-2">
                                        <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                            <i class="fas fa-star text-warning"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="mb-2">"<?= $testimonial['content'] ?>"</p>
                                    <p class="text-muted mb-0">- <?= $testimonial['client_name'] ?></p>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Other Services You Might Like</h2>
            <div class="row g-4">
                <?php 
                $all_services = getServices();
                shuffle($all_services);
                $related_services = array_slice($all_services, 0, 3);
                foreach ($related_services as $related): 
                    if ($related['id'] != $service_id):
                ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="<?= $related['icon'] ?> fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title"><?= $related['name'] ?></h5>
                                <p class="card-text"><?= substr($related['description'], 0, 80) ?>...</p>
                                <a href="service.php?id=<?= $related['id'] ?>" class="btn btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer (same as index.php) -->
    <footer class="bg-dark text-white py-4">
        <!-- ... same footer as index.php ... -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php if ($service['name'] === 'Marble Installation'): ?>
    <script>
        // TikTok integration for marble styles
        document.addEventListener('DOMContentLoaded', function() {
            // This would be replaced with actual TikTok API calls
            const marbleGallery = document.getElementById('tiktokMarbleGallery');
            const marbleStyles = [
                { name: 'Carrara White', image: 'marble1.jpg', tiktok: '#' },
                { name: 'Calacatta Gold', image: 'marble2.jpg', tiktok: '#' },
                { name: 'Statuario', image: 'marble3.jpg', tiktok: '#' }
            ];
            
            marbleStyles.forEach(marble => {
                const col = document.createElement('div');
                col.className = 'col-md-4';
                col.innerHTML = `
                    <div class="card">
                        <img src="assets/images/marble/${marble.image}" class="card-img-top" alt="${marble.name}">
                        <div class="card-body">
                            <h5 class="card-title">${marble.name}</h5>
                            <a href="${marble.tiktok}" target="_blank" class="btn btn-sm btn-outline-dark">
                                <i class="fab fa-tiktok me-1"></i> View on TikTok
                            </a>
                        </div>
                    </div>
                `;
                marbleGallery.appendChild(col);
            });
        });
    </script>
    <?php endif; ?>
</body>
</html>