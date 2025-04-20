<?php
require_once 'functions.php';
$services = getServices();
$pageTitle = "Our Work Gallery | Complete Home Services";
$headerClass = "page-header py-5";
$headerStyle = "background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('assets/images/gallery-bg.jpg'); background-size: cover;";
$lightboxCSS = true; // Flag to include lightbox CSS in header
include 'header.php';
?>

    <!-- Gallery Header -->
    <section class="<?= htmlspecialchars($headerClass) ?>" style="<?= htmlspecialchars($headerStyle) ?>">
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
                        <div class="btn-group flex-wrap" role="group">
                            <button type="button" class="btn btn-outline-primary filter-button active" data-filter="all">All Projects</button>
                            <?php foreach ($services as $service): 
                                $filterClass = strtolower(preg_replace('/[^a-z0-9]+/', '-', $service['name']));
                            ?>
                                <button type="button" class="btn btn-outline-primary filter-button" data-filter="<?= htmlspecialchars($filterClass) ?>">
                                    <?= htmlspecialchars($service['name']) ?>
                                </button>
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
                <?php
                // Sample gallery items - in a real app you would pull these from a database
                $galleryItems = [
                    [
                        'service' => 'parging',
                        'images' => [
                            ['full' => 'parging-1.jpg', 'thumb' => 'parging-1-thumb.jpg', 'title' => 'Parging Restoration', 'desc' => 'Parging Restoration - Before & After']
                        ]
                    ],
                    [
                        'service' => 'roof-cleaning',
                        'images' => [
                            ['full' => 'roof-1.jpg', 'thumb' => 'roof-1-thumb.jpg', 'title' => 'Roof Cleaning', 'desc' => 'Roof Cleaning - Residential Property'],
                            ['full' => 'roof-before.jpg', 'thumb' => 'roof-before-thumb.jpg', 'title' => 'Before: Roof Cleaning', 'desc' => 'Roof Before Cleaning'],
                            ['full' => 'roof-after.jpg', 'thumb' => 'roof-after-thumb.jpg', 'title' => 'After: Roof Cleaning', 'desc' => 'Roof After Cleaning', 'hidden' => true]
                        ]
                    ],
                    // Add other services similarly...
                ];
                
                foreach ($galleryItems as $item): 
                    $filterClass = strtolower(preg_replace('/[^a-z0-9]+/', '-', $item['service']));
                ?>
                    <?php foreach ($item['images'] as $image): ?>
                        <div class="col-lg-4 col-md-6 mb-4 filter <?= htmlspecialchars($filterClass) ?>">
                            <div class="card gallery-card h-100">
                                <a href="assets/images/gallery/<?= htmlspecialchars($image['full']) ?>" 
                                   data-lightbox="gallery-<?= htmlspecialchars($filterClass) ?>" 
                                   data-title="<?= htmlspecialchars($image['desc']) ?>"
                                   <?= isset($image['hidden']) ? 'style="display:none;"' : '' ?>>
                                    <img src="assets/images/gallery/<?= htmlspecialchars($image['thumb']) ?>" 
                                         class="card-img-top" 
                                         alt="<?= htmlspecialchars($image['title']) ?>">
                                    <div class="gallery-overlay">
                                        <div class="gallery-text">
                                            <i class="fas fa-search-plus fa-3x"></i>
                                            <h5><?= htmlspecialchars($image['title']) ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
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

<?php
// Additional scripts specific to this page
$additionalScripts = '
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/lightbox.min.js"></script>
    <script>
        $(document).ready(function(){
            // Gallery filtering
            $(".filter-button").on("click", function(){
                var filterValue = $(this).data("filter");
                $(".filter-button").removeClass("active");
                $(this).addClass("active");
                
                if(filterValue === "all") {
                    $(".filter").fadeIn(300);
                } else {
                    $(".filter").hide();
                    $(".filter." + filterValue).fadeIn(300);
                }
            });
            
            // Initialize lightbox
            if(typeof lightbox !== "undefined") {
                lightbox.option({
                    "resizeDuration": 200,
                    "wrapAround": true,
                    "showImageNumberLabel": true,
                    "positionFromTop": 100,
                    "alwaysShowNavOnTouchDevices": true
                });
            }
        });
    </script>';

include 'footer.php';
?>