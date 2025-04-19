<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'service_id' => isset($_POST['service_id']) ? (int)$_POST['service_id'] : null,
        'message' => $_POST['message']
    ];
    
    if (saveContactSubmission($data)) {
        $success = true;
    } else {
        $error = true;
    }
}

$services = getServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Complete Home Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation (same as index.php) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- ... same nav as index.php ... -->
    </nav>

    <!-- Contact Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold">Contact Us</h1>
                    <p class="lead">Have questions or ready to schedule a service? Get in touch today!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            Thank you for your message! We'll get back to you soon.
                        </div>
                    <?php elseif (isset($error)): ?>
                        <div class="alert alert-danger">
                            There was an error submitting your message. Please try again.
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="mb-4">Send Us a Message</h2>
                    <form action="contact.php" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select" id="service" name="service_id">
                                        <option value="">Select a Service (Optional)</option>
                                        <?php foreach ($services as $service): ?>
                                            <option value="<?= $service['id'] ?>"><?= $service['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="service">Service Interested In</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" id="message" name="message" placeholder="Your Message" style="height: 150px" required></textarea>
                                    <label for="message">Your Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
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
                                    <strong>Phone:</strong> (123) 456-7890
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-envelope text-primary me-2 fa-lg"></i>
                                    <strong>Email:</strong> info@completehomeservices.com
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-clock text-primary me-2 fa-lg"></i>
                                    <strong>Hours:</strong> Mon-Fri: 8AM-6PM, Sat: 9AM-2PM
                                </li>
                            </ul>
                            <hr>
                            <h4 class="mb-3">Service Areas</h4>
                            <div class="service-areas">
                                <span class="badge bg-secondary me-2 mb-2">City 1</span>
                                <span class="badge bg-secondary me-2 mb-2">City 2</span>
                                <span class="badge bg-secondary me-2 mb-2">City 3</span>
                                <span class="badge bg-secondary me-2 mb-2">City 4</span>
                                <span class="badge bg-secondary me-2 mb-2">City 5</span>
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
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2152568362664!2d-73.98784468459382!3d40.74844047932881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1623251234567!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer (same as index.php) -->
    <footer class="bg-dark text-white py-4">
        <!-- ... same footer as index.php ... -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>