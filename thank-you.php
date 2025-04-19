<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | PowerClean Tech Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation (same as about.php) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- ... same nav as about.php ... -->
    </nav>

    <!-- Thank You Header -->
    <section class="page-header py-5 bg-primary text-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4 fw-bold">Thank You!</h1>
                    <p class="lead">We've received your request and will be in touch shortly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Thank You Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <div class="thank-you-icon mb-4">
                        <i class="fas fa-check-circle fa-5x text-success"></i>
                    </div>
                    <h2 class="mb-4">Your Submission Was Successful</h2>
                    <p class="lead mb-4">A member of our team will review your request and contact you within 24 hours to discuss your project and provide a quote.</p>
                    
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h3 class="h4 mb-3">What Happens Next?</h3>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i> You'll receive a confirmation email with your request details</li>
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i> Our team will assess your requirements</li>
                                <li class="mb-2"><i class="fas fa-arrow-right text-primary me-2"></i> We'll contact you to discuss options and scheduling</li>
                                <li><i class="fas fa-arrow-right text-primary me-2"></i> You'll receive a detailed quote for your approval</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <p><strong>Need immediate assistance?</strong> Call us directly at <a href="tel:5551234567">(555) 123-4567</a></p>
                        <a href="index.php" class="btn btn-primary btn-lg mt-3">Back to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer (same as about.php) -->
    <footer class="bg-dark text-white py-4">
        <!-- ... same footer as about.php ... -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>