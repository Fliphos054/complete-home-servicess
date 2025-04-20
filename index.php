<?php include 'header.php'; ?>

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

<?php include 'footer.php'; ?>