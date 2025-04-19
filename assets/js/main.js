// Main JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Contact form validation
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const email = this.querySelector('[name="email"]');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!emailRegex.test(email.value)) {
                e.preventDefault();
                email.classList.add('is-invalid');
                const feedback = email.nextElementSibling || document.createElement('div');
                feedback.className = 'invalid-feedback';
                feedback.textContent = 'Please enter a valid email address';
                email.parentNode.appendChild(feedback);
            }
        });
    }
    
    // Service calculator for power washing
    const powerWashCalculator = document.getElementById('powerWashCalculator');
    if (powerWashCalculator) {
        const areaInput = powerWashCalculator.querySelector('[name="area"]');
        const surfaceSelect = powerWashCalculator.querySelector('[name="surface"]');
        const resultDiv = powerWashCalculator.querySelector('.calculator-result');
        
        const calculateEstimate = () => {
            const area = parseFloat(areaInput.value) || 0;
            const surfaceMultiplier = parseFloat(surfaceSelect.value) || 1;
            const estimate = (area * surfaceMultiplier * 0.5).toFixed(2);
            resultDiv.textContent = `Estimated Cost: $${estimate}`;
            resultDiv.style.display = 'block';
        };
        
        areaInput.addEventListener('input', calculateEstimate);
        surfaceSelect.addEventListener('change', calculateEstimate);
    }
    
    // Snow removal season calculator
    const snowCalculator = document.getElementById('snowCalculator');
    if (snowCalculator) {
        const propertySize = snowCalculator.querySelector('[name="property_size"]');
        const drivewayLength = snowCalculator.querySelector('[name="driveway_length"]');
        const seasonResult = snowCalculator.querySelector('.season-result');
        
        const calculateSeasonEstimate = () => {
            const size = parseFloat(propertySize.value) || 0;
            const length = parseFloat(drivewayLength.value) || 0;
            const estimate = (size * 50 + length * 20).toFixed(2);
            seasonResult.textContent = `Seasonal Estimate: $${estimate}`;
            seasonResult.style.display = 'block';
        };
        
        propertySize.addEventListener('input', calculateSeasonEstimate);
        drivewayLength.addEventListener('input', calculateSeasonEstimate);
    }
});