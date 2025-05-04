<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Services - Your Trusted Partner</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="#home">
                    <img src="LOGO/mhs.png" alt="MHS Logo" class="logo-img">
                </a>
            </div>
            <button class="menu-toggle" aria-label="Toggle Menu">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links">
                <a href="#home" data-translate="nav_home">Home</a>
                <a href="#services" data-translate="nav_services">Services</a>
                <a href="#request" data-translate="nav_request">Request Service</a>
                <a href="#contact" data-translate="nav_contact">Contact</a>
                <div class="language-selector">
                    <select id="language" onchange="changeLanguage(this.value)">
                        <option value="en">English</option>
                        <option value="de" selected>Deutsch</option>
                        <option value="ar">عربي</option>
                    </select>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="hero">
            <div id="heroSlideshow">
                <div class="hero-slide active" style="background-image: url('images/cleaning.jpg')"></div>
                <div class="hero-slide" style="background-image: url('images/builder.jpg')"></div>
                <div class="hero-slide" style="background-image: url('images/gardner.jpg')"></div>
                <div class="hero-slide" style="background-image: url('images/movingWorker.jpg')"></div>
                <div class="hero-slide" style="background-image: url('images/painter.jpg')"></div>
            </div>
            <div class="hero-content">
                <h1 data-translate="hero_title">Professional Services at Your Doorstep</h1>
                <p data-translate="hero_subtitle">Quality, Reliability, and Excellence in Every Service</p>
                <a href="#request" class="cta-button" data-translate="hero_cta">Request Service</a>
            </div>
        </section>

        <section id="services" class="services">
            <h2 data-translate="services_title">Our Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <i class="fas fa-broom"></i>
                    <h3 data-translate="service_cleaning">Cleaning</h3>
                    <p data-translate="service_cleaning_desc">Professional cleaning services for homes and offices</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-truck"></i>
                    <h3 data-translate="service_moving">Moving Help</h3>
                    <p data-translate="service_moving_desc">Reliable moving assistance for a stress-free relocation</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-leaf"></i>
                    <h3 data-translate="service_garden">Garden Work</h3>
                    <p data-translate="service_garden_desc">Expert garden maintenance and landscaping</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-wall"></i>
                    <h3 data-translate="service_wall">Wall Building</h3>
                    <p data-translate="service_wall_desc">Professional wall construction and repair services</p>
                </div>
            </div>
        </section>

        <section id="request" class="request-form">
            <div class="form-container">
                <?php if(isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success">
                        <?php 
                        echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-error">
                        <?php 
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <h2 data-translate="form_title">Request a Service</h2>
                <p class="form-subtitle" data-translate="form_subtitle">Tell us about your service needs and we'll get back to you quickly</p>
                
                <form id="serviceForm" action="process_form.php" method="POST">
                    <div class="form-grid">
                        <div class="form-group service-selection full-width">
                            <label for="service" class="required-field" data-translate="form_service">Select Service</label>
                            <select name="service" id="service" required>
                                <option value="" data-translate="form_service_placeholder">Choose a service...</option>
                                <option value="cleaning" data-translate="option_cleaning">Cleaning</option>
                                <option value="moving" data-translate="option_moving">Moving Help</option>
                                <option value="garden" data-translate="option_garden">Garden Work</option>
                                <option value="wall" data-translate="option_wall">Wall Building</option>
                                <option value="other" data-translate="option_other">Other</option>
                            </select>
                        </div>

                        <div class="form-group full-width" id="otherServiceGroup" style="display: none;">
                            <label for="otherService" class="required-field" data-translate="form_other_service">Specify Other Service</label>
                            <input type="text" name="otherService" id="otherService">
                        </div>

                        <div class="form-group">
                            <label for="date" class="required-field" data-translate="form_date">Preferred Date</label>
                            <input type="date" name="date" id="date" required min="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="time" data-translate="form_time">Preferred Time</label>
                            <input type="time" name="time" id="time">
                        </div>

                        <div class="form-group">
                            <label for="name" class="required-field" data-translate="form_name">Full Name</label>
                            <input type="text" name="name" id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="required-field" data-translate="form_phone">Phone Number</label>
                            <input type="tel" name="phone" id="phone" required pattern="[+]?[0-9\s-()]{8,}" title="Please enter a valid phone number">
                        </div>

                        <div class="form-group">
                            <label for="email" class="required-field" data-translate="form_email">Email</label>
                            <input type="email" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="address" class="required-field" data-translate="form_address">Service Address</label>
                            <textarea name="address" id="address" rows="2" required></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="message" data-translate="form_message">Additional Notes</label>
                            <textarea name="message" id="message" rows="3"></textarea>
                        </div>

                        <div class="form-group submit-group">
                            <button type="submit" class="submit-button" data-translate="form_submit">
                                <span>Request Service</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="footer-content">
            <div class="contact-info">
                <h3 data-translate="footer_contact">Contact Us</h3>
                <p><i class="fas fa-phone"></i> +1234567890</p>
                <p><i class="fas fa-envelope"></i> multihandservices@gmail.com</p>
                <a href="https://wa.me/1234567890" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> <span data-translate="whatsapp_button">Contact via WhatsApp</span>
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 ServicePro. <span data-translate="footer_rights">All rights reserved.</span></p>
        </div>
    </footer>

    <script src="js/translations.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
