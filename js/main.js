document.addEventListener('DOMContentLoaded', function() {
    // Debug logging
    console.log('Translations object available:', typeof translations !== 'undefined');
    
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

    // Language switching functionality
    function updateContent(lang) {
        if (typeof translations === 'undefined') {
            console.error('Translations not loaded!');
            return;
        }

        console.log('Switching to language:', lang);
        console.log('Available translations:', translations[lang]);
        
        const elements = document.querySelectorAll('[data-translate]');
        console.log('Found elements to translate:', elements.length);
        
        elements.forEach(element => {
            const key = element.getAttribute('data-translate');
            console.log('Translating element:', key, 'to language:', lang);
            
            if (translations[lang] && translations[lang][key]) {
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.placeholder = translations[lang][key];
                } else if (element.tagName === 'OPTION') {
                    element.text = translations[lang][key];
                } else {
                    element.textContent = translations[lang][key];
                }
                console.log('Successfully translated:', key);
            } else {
                console.log('Translation missing for key:', key);
            }
        });

        // Update select options
        const serviceSelect = document.getElementById('service');
        if (serviceSelect) {
            Array.from(serviceSelect.options).forEach(option => {
                const key = option.getAttribute('data-translate');
                if (key && translations[lang][key]) {
                    option.text = translations[lang][key];
                }
            });
        }

        // Update document direction for Arabic
        document.documentElement.dir = lang === 'ar' ? 'rtl' : 'ltr';
        document.documentElement.lang = lang;

        // Store the language preference
        localStorage.setItem('preferred_language', lang);
    }

    // Load saved language preference
    const savedLang = localStorage.getItem('preferred_language') || 'en';
    document.getElementById('language').value = savedLang;
    updateContent(savedLang);

    // Make language change function globally available
    window.changeLanguage = function(lang) {
        updateContent(lang);
    };

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

    // Form validation and submission
    const form = document.getElementById('serviceForm');
    const formMessage = document.createElement('div');
    formMessage.id = 'formMessage';
    form.appendChild(formMessage);

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic form validation
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phoneRegex = /^\+?[\d\s-]{8,}$/;

        if (!emailRegex.test(email)) {
            showMessage('<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Please enter a valid email address</div>');
            return;
        }

        if (!phoneRegex.test(phone)) {
            showMessage('<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> Please enter a valid phone number</div>');
            return;
        }

        // Show loading message
        showMessage('<div class="alert alert-info"><i class="fas fa-spinner fa-spin"></i> Sending your request...</div>');

        // Submit form using AJAX
        fetch('process_form.php', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            showMessage(data.message);
            if (data.success) {
                form.reset(); // Clear form on success
                if (otherServiceGroup) {
                    otherServiceGroup.style.display = 'none';
                }
            }
        })
        .catch(error => {
            showMessage('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> An error occurred. Please try again.</div>');
            console.error('Error:', error);
        });
    });

    function showMessage(message) {
        formMessage.innerHTML = message;
        formMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Date validation - prevent past dates
    const dateInput = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);
});
