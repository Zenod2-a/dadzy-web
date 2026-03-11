<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DAdzy - A New Advertising Agency. We help brands find their voice.">
    <title>DAdzy | A New Advertising Agency</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="images/favicon.svg" type="image/svg+xml">
</head>
<body>
    <div class="cosmic-bg" id="cosmicBg"></div>
    
    <header class="header" id="header">
        <div class="container">
            <nav class="nav">
                <a href="index.php" class="logo">
                    <span>DAdzy</span>
                    <i class="fas fa-sparkles"></i>
                </a>
                <ul class="nav-links">
                    <li><a href="#home" class="nav-link">Home</a></li>
                    <li><a href="#about" class="nav-link">About</a></li>
                    <li><a href="#services" class="nav-link">Services</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
                <a href="#contact" class="btn btn-primary">Get in Touch</a>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>
    
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>

    <section class="hero" id="home">
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span class="dot"></span>
                    <i class="fas fa-rocket"></i>
                    A New Journey Begins
                    <i class="fas fa-sparkles"></i>
                </div>
                <h1>
                    <span>DAdzy</span>
                    <span class="text-secondary">We Help Brands</span>
                    <span class="text-faded">Find Their Voice</span>
                </h1>
                <p class="hero-subtitle">
                    We're a new advertising agency with fresh ideas and a passion for helping businesses grow. 
                    Be among our first clients and let's build something amazing together.
                </p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary">
                        Be Our First Client <i class="fas fa-arrow-up-right"></i>
                    </a>
                    <a href="#services" class="btn btn-outline">
                        What We Offer
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-value">Fresh</span>
                         <br/>
                        <span class="stat-label">Ideas</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">Bold</span>
                            <br/>
                        <span class="stat-label">Vision</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">Ready</span>
                            <br/>
                        <span class="stat-label">To Start</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="clients">
        <div class="container">
            <p class="clients-title">
                <i class="fas fa-sparkles"></i>
                Who We Want to Work With
                <i class="fas fa-sparkles"></i>
            </p>
            <div class="clients-grid">
                <div class="client-item">
                    <i class="fas fa-briefcase"></i>
                    <span>Startups</span>
                </div>
                <div class="client-item">
                    <i class="fas fa-building"></i>
                    <span>Small Businesses</span>
                </div>
                <div class="client-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>E-commerce</span>
                </div>
                <div class="client-item">
                    <i class="fas fa-utensils"></i>
                    <span>Restaurants</span>
                </div>
                <div class="client-item">
                    <i class="fas fa-dumbbell"></i>
                    <span>Fitness</span>
                </div>
                <div class="client-item">
                    <i class="fas fa-sparkles"></i>
                    <span>And More...</span>
                </div>
            </div>
        </div>
    </section>

    <section class="services" id="services">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">
                    <i class="fas fa-sparkles"></i>
                    Our Services
                </span>
                <h2 class="section-title">What we can<br><span>do for you</span></h2>
                <p class="section-subtitle">
                    From brand identity to marketing strategy, we offer a full range of services to help your business grow.
                </p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <span class="service-number">01</span>
                    <div class="service-icon"><i class="fas fa-palette"></i></div>
                    <h3>Brand Identity</h3>
                    <p>Logo design, color palettes, typography, and brand guidelines that define who you are.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">02</span>
                    <div class="service-icon"><i class="fas fa-share-nodes"></i></div>
                    <h3>Social Media Management</h3>
                    <p>Content creation, posting, and engagement to build your community on social platforms.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">03</span>
                    <div class="service-icon"><i class="fas fa-bullhorn"></i></div>
                    <h3>Paid Advertising</h3>
                    <p>Strategic ad campaigns on Google, Facebook, Instagram, and more to reach new customers.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">04</span>
                    <div class="service-icon"><i class="fas fa-pen-nib"></i></div>
                    <h3>Content Marketing</h3>
                    <p>Blog posts, articles, newsletters, and storytelling that connects with your audience.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">05</span>
                    <div class="service-icon"><i class="fas fa-crosshairs"></i></div>
                    <h3>Marketing Strategy</h3>
                    <p>Comprehensive marketing plans tailored to your goals, audience, and budget.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">06</span>
                    <div class="service-icon"><i class="fas fa-globe"></i></div>
                    <h3>Website Design</h3>
                    <p>Modern, responsive websites that showcase your brand and convert visitors.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="service-card">
                    <span class="service-number">07</span>
                    <div class="service-icon"><i class="fas fa-chart-bar"></i></div>
                    <h3>Analytics & Reporting</h3>
                    <p>Track performance, understand your audience, and optimize for better results.</p>
                    <a href="#contact" class="service-link">Get started <i class="fas fa-arrow-up-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="container">
            <div class="about-content">
                <span class="section-badge">
                    <i class="fas fa-sparkles"></i>
                    Our Beginning
                </span>
                <h2 class="section-title">Every great journey<br><span>starts with a first step</span></h2>
                <p>
                    DAdzy is just getting started. We're a team of passionate individuals ready to help businesses 
                    tell their story and reach their audience. This is our beginning, and we want you to be part of it.
                </p>
                <p>
                    We may be new, but we bring fresh energy, creative thinking, and an unwavering commitment to every project. 
                    Be among our first clients and experience the dedication of a team that's eager to prove itself.
                </p>
                <div class="values-grid">
                    <div class="value-card">
                        <i class="fas fa-lightbulb"></i>
                        <h4>Fresh Ideas</h4>
                        <p>New perspectives for every project</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-heart"></i>
                        <h4>Passion</h4>
                        <p>Dedicated to your success</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-crosshairs"></i>
                        <h4>Focus</h4>
                        <p>Results that matter to you</p>
                    </div>
                    <div class="value-card">
                        <i class="fas fa-rocket"></i>
                        <h4>Ambition</h4>
                        <p>Growing together with you</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feedback" id="feedback">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">
                    <i class="fas fa-sparkles"></i>
                    Your Thoughts
                </span>
                <h2 class="section-title">Help us<br><span>get better</span></h2>
                <p class="section-subtitle">We're a new agency and we're always looking to improve. Share your thoughts with us.</p>
            </div>
            <form class="feedback-form" id="feedbackForm">
                <input type="hidden" name="rating" id="rating" value="0">
                <div class="rating-section">
                    <label>How do you feel about our concept?</label>
                    <div class="rating-stars">
                        <button type="button" data-rating="1"><i class="fas fa-star"></i></button>
                        <button type="button" data-rating="2"><i class="fas fa-star"></i></button>
                        <button type="button" data-rating="3"><i class="fas fa-star"></i></button>
                        <button type="button" data-rating="4"><i class="fas fa-star"></i></button>
                        <button type="button" data-rating="5"><i class="fas fa-star"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="feedback-name">Your Name</label>
                    <input type="text" id="feedback-name" name="name" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <label for="feedback-email">Email Address</label>
                    <input type="email" id="feedback-email" name="email" placeholder="example@email.com">
                </div>
                <div class="form-group">
                    <label for="feedback-message">Your Thoughts</label>
                    <textarea id="feedback-message" name="feedback" placeholder="What do you think about our agency?"></textarea>
                </div>
                <button type="submit" class="btn btn-primary form-submit">
                    Share Your Thoughts <i class="fas fa-comment"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <span class="section-badge">
                        <i class="fas fa-sparkles"></i>
                        Get In Touch
                    </span>
                    <h2 class="section-title">Be our<br><span>first client</span></h2>
                    <p>
                        We're just getting started and excited to work with businesses like yours. 
                        Reach out and let's discuss how we can help you grow.
                    </p>
                    <div class="contact-items">
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span>Email us</span>
                                <a href="mailto:dadzy74@gmail.com">dadzy74@gmail.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span>Call us</span>
                                <a href="tel:+919155322282">+91 9155322282</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span>Alternate</span>
                                <a href="tel:+917989953154">+91 7989953154</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <span>Based in</span>
                                <p>Hyderabad, India</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>Let's Start a Conversation</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" id="name" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="example@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" name="company" placeholder="Company Name">
                        </div>
                        <div class="form-group">
                            <label for="budget">Budget Range</label>
                            <select id="budget" name="budget">
                                <option value="">Select budget range</option>
                                <option value="Under ₹5,000">Under ₹5,000</option>
                                <option value="₹5,000 - ₹15,000">₹5,000 - ₹15,000</option>
                                <option value="₹15,000 - ₹30,000">₹15,000 - ₹30,000</option>
                                <option value="₹30,000 - ₹50,000">₹30,000 - ₹50,000</option>
                                <option value="₹50,000+">₹50,000+</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Tell Us About Your Project *</label>
                            <textarea id="message" name="message" placeholder="What do you need help with?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary form-submit">
                            Send Message <i class="fas fa-arrow-up-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-cta">
                    <h2>Ready to start<br><span>your journey?</span></h2>
                    <p>We're a new agency with fresh ideas. Be among our first clients.</p>
                    <a href="#contact" class="footer-link">Get In Touch <i class="fas fa-arrow-up-right"></i></a>
                </div>
                <div class="footer-links">
                    <div class="footer-col">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Services</h4>
                        <ul>
                            <li><a href="#services">Brand Identity</a></li>
                            <li><a href="#services">Social Media</a></li>
                            <li><a href="#services">Digital Marketing</a></li>
                            <li><a href="#services">Website Design</a></li>
                        </ul>
                    </div>
                    <div class="footer-col">
                        <h4>Contact</h4>
                        <ul>
                            <li><a href="mailto:dadzy74@gmail.com">dadzy74@gmail.com</a></li>
                            <li><a href="tel:+919155322282">+91 9155322282</a></li>
                            <li><a href="tel:+917989953154">+91 7989953154</a></li>
                            <li>Hyderabad, India</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-team">
                <div class="team-member">
                    <span class="team-role">Founder</span>
                    <span class="team-name">Aaban Hoda</span>
                </div>
                <div class="team-member">
                    <span class="team-role">Co-Founder</span>
                    <span class="team-name">Gaurav Panday</span>
                </div>
                <div class="team-member">
                    <span class="team-role">CEO</span>
                    <span class="team-name">Munesh Singh</span>
                </div>
            </div>
            <div class="footer-thanks">
                <p class="thanks-text">THANK YOU FOR VISITING</p>
                <p class="thanks-brand">DAdzy</p>
            </div>
            <div class="footer-bottom">
                <p><i class="fas fa-rocket"></i> © <?php echo date('Y'); ?> DAdzy. Just getting started.</p>
            </div>
        </div>
    </footer>
    
    <script src="js/main.js"></script>
</body>
</html>
