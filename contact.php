<?php
require_once 'functions.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'email' => filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL),
        'phone' => htmlspecialchars(trim($_POST['phone'])),
        'service_id' => isset($_POST['service_id']) ? (int)$_POST['service_id'] : null,
        'message' => htmlspecialchars(trim($_POST['message']))
    ];
    
    // Validate required fields
    if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            if (saveContactSubmission($data)) {
                $success = true;
            } else {
                $error = "There was an error submitting your message. Please try again.";
            }
        } else {
            $error = "Please enter a valid email address.";
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}

$services = getServices();
$pageTitle = "Contact Us | Complete Home Services";
$headerClass = "page-header py-5 bg-primary text-white";
include 'header.php';
?>

    <!-- Contact Form -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> Thank you for your message! We'll get back to you soon.
                        </div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="mb-4">Send Us a Message</h2>
                    <form action="contact.php" method="POST" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" 
                                           placeholder="Your Name" value="<?= isset($data['name']) ? htmlspecialchars($data['name']) : '' ?>" required>
                                    <label for="name">Your Name *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="Email Address" value="<?= isset($data['email']) ? htmlspecialchars($data['email']) : '' ?>" required>
                                    <label for="email">Email Address *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           placeholder="Phone Number" value="<?= isset($data['phone']) ? htmlspecialchars($data['phone']) : '' ?>">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="service" name="service_id">
                                        <option value="">Select a Service (Optional)</option>
                                        <?php foreach ($services as $service): ?>
                                            <option value="<?= htmlspecialchars($service['id']) ?>" 
                                                <?= (isset($data['service_id']) && $data['service_id'] == $service['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($service['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="service">Service Interested In</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" 
                                              placeholder="Your Message" style="height: 150px" required><?= isset($data['message']) ? htmlspecialchars($data['message']) : '' ?></textarea>
                                    <label for="message">Your Message *</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg px-4">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                            <div class="col-12">
                                <small class="text-muted">* Required fields</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="card shadow h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Contact Information</h3>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2 fa-lg"></i>
                                    <strong>Address:</strong> 123 Service St, Your City, ST 12345
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-phone text-primary me-2 fa-lg"></i>
                                    <strong>Phone:</strong> <a href="tel:1234567890">(123) 456-7890</a>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-envelope text-primary me-2 fa-lg"></i>
                                    <strong>Email:</strong> <a href="mailto:info@completehomeservices.com">info@completehomeservices.com</a>
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-clock text-primary me-2 fa-lg"></i>
                                    <strong>Hours:</strong> Mon-Fri: 8AM-6PM, Sat: 9AM-2PM
                                </li>
                            </ul>
                            <hr>
                            <h4 class="mb-3">Service Areas</h4>
                            <div class="service-areas">
                                <?php
                                $serviceAreas = ['KItchener', 'Waterloo', 'cambridge', 'Guelph', 'Brantford'];
                                foreach ($serviceAreas as $area):
                                ?>
                                    <span class="badge bg-secondary me-2 mb-2"><?= htmlspecialchars($area) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map -->
    <section class="py-0">
        <div class="container-fluid p-0">
            <div class="map-container ratio ratio-16x9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2152568362664!2d-73.98784468459382!3d40.74844047932881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1623251234567!5m2!1sen!2sus" 
                        allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

<?php
include 'footer.php';
?>