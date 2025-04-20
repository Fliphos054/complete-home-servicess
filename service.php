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

$pageTitle = htmlspecialchars($service['name']) . " | Complete Home Services";
$headerClass = "service-header py-5";
$headerStyle = "background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/services/" . 
               htmlspecialchars(strtolower(str_replace(' ', '-', $service['name']))) . ".jpg'); background-size: cover;";
$customScripts = $service['name'] === 'Marble Installation' ? true : false;

include 'header.php';
?>

    <!-- Service Details -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">About Our <?= htmlspecialchars($service['name']) ?> Service</h2>
                    <div class="service-content">
                        <?php if ($service['name'] === 'Marble Installation'): ?>
                            <div class="mb-4">
                                <h4>Featured Marble Styles</h4>
                                <div id="tiktokMarbleGallery" class="row g-3">
                                    <!-- Populated via JavaScript -->
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
                                <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['id']) ?>">
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
                                    <p class="mb-2">"<?= htmlspecialchars($testimonial['content']) ?>"</p>
                                    <p class="text-muted mb-0">- <?= htmlspecialchars($testimonial['client_name']) ?></p>
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
                                <i class="<?= htmlspecialchars($related['icon']) ?> fa-3x mb-3 text-primary"></i>
                                <h5 class="card-title"><?= htmlspecialchars($related['name']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($related['description'], 0, 80)) ?>...</p>
                                <a href="service.php?id=<?= htmlspecialchars($related['id']) ?>" class="btn btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                endforeach; ?>
            </div>
        </div>
    </section>

<?php
// Additional scripts for Marble Installation
if ($customScripts) {
    $additionalScripts = '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const marbleGallery = document.getElementById("tiktokMarbleGallery");
            const marbleStyles = [
                { name: "Carrara White", image: "marble1.jpg", tiktok: "#" },
                { name: "Calacatta Gold", image: "marble2.jpg", tiktok: "#" },
                { name: "Statuario", image: "marble3.jpg", tiktok: "#" }
            ];
            
            marbleStyles.forEach(marble => {
                const col = document.createElement("div");
                col.className = "col-md-4";
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
    </script>';
}

include 'footer.php';