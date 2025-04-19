<?php
require_once 'functions.php';
$services = getServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Work Gallery | PowerClean Tech Solutions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
    <!-- Navigation (same as about.php) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- ... same nav as about.php ... -->
    </nav>

    <!-- Gallery Header -->
    <section class="page-header py-5" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/gallery-bg.jpg'); background-size: cover;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center text-white">
                    <h1 class="display-4 fw-bold">Our Work Gallery</h1>
                    <p class="lead">See the transformative results we deliver for our clients</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Filters -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary filter-button active" data-filter="all">All Projects</button>
                            <?php foreach ($services as $service): ?>
                                <button type="button" class="btn btn-outline-primary filter-button" data-filter="<?= strtolower(str_replace(' ', '-', $service['name'])) ?>"><?= $service['name'] ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row gallery-grid">
                <!-- Parging Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter parging">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/parging-1.jpg" data-lightbox="gallery" data-title="Parging Restoration - Before & After">
                            <img src="assets/images/gallery/parging-1-thumb.jpg" class="card-img-top" alt="Parging Restoration">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Parging Restoration</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Roof Cleaning Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter roof-cleaning">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/roof-1.jpg" data-lightbox="gallery" data-title="Roof Cleaning - Residential Property">
                            <img src="assets/images/gallery/roof-1-thumb.jpg" class="card-img-top" alt="Roof Cleaning">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Roof Cleaning</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Power Washing Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter powerwashing">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/powerwash-1.jpg" data-lightbox="gallery" data-title="Driveway Power Washing">
                            <img src="assets/images/gallery/powerwash-1-thumb.jpg" class="card-img-top" alt="Power Washing">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Driveway Cleaning</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Apartment Cleaning Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter aptplaza-cleansing">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/apt-1.jpg" data-lightbox="gallery" data-title="Apartment Complex Cleaning">
                            <img src="assets/images/gallery/apt-1-thumb.jpg" class="card-img-top" alt="Apartment Cleaning">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Apartment Complex</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Snow Removal Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter snow-removal">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/snow-1.jpg" data-lightbox="gallery" data-title="Commercial Snow Removal">
                            <img src="assets/images/gallery/snow-1-thumb.jpg" class="card-img-top" alt="Snow Removal">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Snow Removal</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Marble Installation Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter marble-installation">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/marble-1.jpg" data-lightbox="gallery" data-title="Luxury Marble Installation">
                            <img src="assets/images/gallery/marble-1-thumb.jpg" class="card-img-top" alt="Marble Installation">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Marble Installation</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Smart Home Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter smart-home-solutions">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/smart-1.jpg" data-lightbox="gallery" data-title="Smart Home Control Panel">
                            <img src="assets/images/gallery/smart-1-thumb.jpg" class="card-img-top" alt="Smart Home">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Smart Home Setup</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Before/After Examples -->
                <div class="col-lg-4 col-md-6 mb-4 filter parging">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/parging-before.jpg" data-lightbox="before-after-1" data-title="Parging Before">
                            <img src="assets/images/gallery/parging-before-thumb.jpg" class="card-img-top" alt="Parging Before">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Before: Parging Repair</h5>
                                </div>
                            </div>
                        </a>
                        <a href="assets/images/gallery/parging-after.jpg" data-lightbox="before-after-1" data-title="Parging After" style="display:none;"></a>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 filter roof-cleaning">
                    <div class="card gallery-card h-100">
                        <a href="assets/images/gallery/roof-before.jpg" data-lightbox="before-after-2" data-title="Roof Before Cleaning">
                            <img src="assets/images/gallery/roof-before-thumb.jpg" class="card-img-top" alt="Roof Before">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <i class="fas fa-search-plus fa-3x"></i>
                                    <h5>Before: Roof Cleaning</h5>
                                </div>
                            </div>
                        </a>
                        <a href="assets/images/gallery/roof-after.jpg" data-lightbox="before-after-2" data-title="Roof After Cleaning" style="display:none;"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Ready to Transform Your Property?</h2>
            <p class="lead mb-4">View more examples of our work and get inspired for your next project.</p>
            <a href="contact.php" class="btn btn-light btn-lg me-2">Get a Free Quote</a>
            <a href="services.php" class="btn btn-outline-light btn-lg">Explore Our Services</a>
        </div>
    </section>

    <!-- Footer (same as about.php) -->
    <footer class="bg-dark text-white py-4">
        <!-- ... same footer as about.php ... -->
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/lightbox-plus-jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        // Gallery filtering
        $(document).ready(function(){
            $(".filter-button").click(function(){
                const value = $(this).attr('data-filter');
                
                $(".filter-button").removeClass("active");
                $(this).addClass("active");
                
                if(value == "all") {
                    $(".filter").show();
                } else {
                    $(".filter").not('.'+value).hide();
                    $(".filter").filter('.'+value).show();
                }
            });
            
            // Initialize lightbox
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true,
                'showImageNumberLabel': true,
                'positionFromTop': 100
            });
        });
    </script>
</body>
</html>