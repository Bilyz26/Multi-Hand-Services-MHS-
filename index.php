<?php
session_start();
?>
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
                <h1>ServicePro</h1>
            </div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#services">Services</a>
                <a href="#request">Request Service</a>
                <a href="#contact">Contact</a>
                <div class="language-selector">
                    <select id="language" onchange="changeLanguage()">
                        <option value="en">English</option>
                        <option value="de">Deutsch</option>
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
                <h1>Professional Services at Your Doorstep</h1>
                <p>Quality, Reliability, and Excellence in Every Service</p>
                <a href="#request" class="cta-button">Request Service</a>
            </div>
        </section>

        <section id="services" class="services">
            <h2>Our Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <i class="fas fa-broom"></i>
                    <h3>Cleaning</h3>
                    <p>Professional cleaning services for homes and offices</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-truck"></i>
                    <h3>Moving Help</h3>
                    <p>Reliable moving assistance for a stress-free relocation</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-leaf"></i>
                    <h3>Garden Work</h3>
                    <p>Expert garden maintenance and landscaping</p>
                </div>
                <div class="service-card">
                    <i class="fas fa-wall"></i>
                    <h3>Wall Building</h3>
                    <p>Professional wall construction and repair services</p>
                </div>
            </div>
        </section>

        <section id="request" class="request-form">
            <h2>Request a Service</h2>
            <form id="serviceForm" action="process_form.php" method="POST">
                <div class="form-group">
                    <label for="service">Select Service*</label>
                    <select name="service" id="service" required>
                        <option value="">Choose a service...</option>
                        <option value="cleaning">Cleaning</option>
                        <option value="moving">Moving Help</option>
                        <option value="garden">Garden Work</option>
                        <option value="wall">Wall Building</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group" id="otherServiceGroup" style="display: none;">
                    <label for="otherService">Specify Other Service*</label>
                    <input type="text" name="otherService" id="otherService">
                </div>

                <div class="form-group">
                    <label for="date">Preferred Date*</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="time">Preferred Time</label>
                    <input type="time" name="time" id="time">
                </div>

                <div class="form-group">
                    <label for="name">Full Name*</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number*</label>
                    <input type="tel" name="phone" id="phone" required>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" rows="2"></textarea>
                </div>

                <div class="form-group">
                    <label for="message">Additional Details</label>
                    <textarea name="message" id="message" rows="4"></textarea>
                </div>

                <button type="submit" class="submit-button">Submit Request</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="contact-info">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i> +1234567890</p>
                <p><i class="fas fa-envelope"></i> info@servicepro.com</p>
                <a href="https://wa.me/1234567890" class="whatsapp-button">
                    <i class="fab fa-whatsapp"></i> Contact via WhatsApp
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 ServicePro. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
