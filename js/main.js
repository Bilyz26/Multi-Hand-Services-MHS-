document.addEventListener('DOMContentLoaded', function() {
    // Slideshow functionality
    const slides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;
    const slideInterval = 3000; // 3 seconds

    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Start the slideshow
    setInterval(nextSlide, slideInterval);

    // Service type dropdown handler
    const serviceSelect = document.getElementById('service');
    const otherServiceGroup = document.getElementById('otherServiceGroup');
    const otherServiceInput = document.getElementById('otherService');

    serviceSelect.addEventListener('change', function() {
        if (this.value === 'other') {
            otherServiceGroup.style.display = 'block';
            otherServiceInput.required = true;
        } else {
            otherServiceGroup.style.display = 'none';
            otherServiceInput.required = false;
        }
    });

    // Form validation
    const form = document.getElementById('serviceForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic form validation
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^\+?[\d\s-]{8,}$/;

        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address');
            return;
        }

        if (!phoneRegex.test(phone)) {
            alert('Please enter a valid phone number');
            return;
        }

        // If validation passes, submit the form
        this.submit();
    });

    // Date validation - prevent past dates
    const dateInput = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);

    // Language switcher
    function changeLanguage() {
        const lang = document.getElementById('language').value;
        // Here you would implement the language switching logic
        console.log('Language changed to:', lang);
        // This would typically involve loading language-specific content
        // For now, we'll just log the change
    }

    // Make changeLanguage function globally available
    window.changeLanguage = changeLanguage;
});
