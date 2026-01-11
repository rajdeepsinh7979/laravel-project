<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmers Portal</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary-color: #2e7d32;
      --secondary-color: #66bb6a;
      --accent-color: #4caf50;
      --light-color: #f4f9f4;
      --dark-color: #1b5e20;
      --text-color: #333;
      --light-text: #555;
      --login-color: #ffb300; 
      --register-color: #ffb300;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--light-color);
      color: var(--text-color);
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    a {
      text-decoration: none;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
      100% { transform: translateY(0px); }
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      padding: 15px 50px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .navbar.scrolled {
      padding: 10px 50px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .navbar .brand {
      font-size: 1.8rem;
      font-weight: 700;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar .brand i {
      font-size: 2rem;
      animation: float 3s ease-in-out infinite;
    }

    .navbar .menu {
      display: flex;
    }

    .navbar .menu a {
      color: white;
      margin: 0 15px;
      font-weight: 500;
      position: relative;
      transition: color 0.3s ease;
    }

    .navbar .menu a::after {
      content: "";
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: #ffe082;
      transition: width 0.3s ease;
    }

    .navbar .menu a:hover {
      color: #ffe082;
    }

    .navbar .menu a:hover::after {
      width: 100%;
    }

    .navbar .buttons a {
      margin-left: 10px;
      padding: 8px 18px;
      border-radius: 25px;
      font-weight: 600;
      transition: all 0.3s;
    }

    .navbar .buttons a.login {
      background: var(--login-color);
      color: white;
      box-shadow: 0 4px 8px rgba(0, 172, 193, 0.3);
    }

    .navbar .buttons a.login:hover {
      background: #ffca28;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(255, 179, 0, 0.3);
    }

    .navbar .buttons a.register {
      background:#ffca28;
      color: white;
      box-shadow: 0 4px 8px rgba(255, 179, 0, 0.3);
    }

    .navbar .buttons a.register:hover {
      background: #ffa000;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(255, 179, 0, 0.4);
    }

    /* Mobile Menu Toggle */
    .menu-toggle {
      display: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url("{{ asset('storage/uploads/1756964494_wheat.jpg') }}") center/cover no-repeat;
      color: white;
      text-align: center;
      padding: 200px 50px 200px;
      position: relative;
      overflow: hidden;

    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle at 30% 80%, rgba(46, 125, 50, 0.3), transparent 70%);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      animation: fadeIn 1s ease-out;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero p {
      font-size: 1.3rem;
      margin-bottom: 30px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .btn-custom {
      background: var(--accent-color);
      color: white;
      padding: 14px 35px;
      border-radius: 30px;
      font-weight: bold;
      transition: all 0.3s;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(76, 175, 80, 0.3);
    }

    .btn-custom:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(76, 175, 80, 0.4);
    }

    /* Sections */
    section {
      padding: 80px 20px;
      max-width: 1200px;
      margin: auto;
    }

    h2 {
      text-align: center;
      font-size: 2.8rem;
      color: var(--primary-color);
      position: relative;
      margin-bottom: 20px;
    }

    h2::after {
      content: "";
      display: block;
      width: 80px;
      height: 4px;
      background: var(--accent-color);
      margin: 12px auto 0;
      border-radius: 2px;
    }

    p.text-center {
      text-align: center;
      max-width: 800px;
      margin: auto;
      font-size: 1.1rem;
      color: var(--light-text);
      line-height: 1.8;
    }

    /* Cards */
    .row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin-top: 50px;
    }

    .card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      overflow: hidden;
      width: 250px;
      transition: all 0.4s ease;
      position: relative;
    }

    .card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .card:hover {
      transform: translateY(-15px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .card:hover img {
      transform: scale(1.1);
    }

    .card-body {
      padding: 25px;
      text-align: center;
    }

    .card-body h5 {
      font-size: 1.5rem;
      color: var(--primary-color);
      margin-bottom: 10px;
    }

    .card-body p {
      color: var(--light-text);
      font-size: 1rem;
    }

    /* Services */
    .services .card {
      width: 300px;
      text-align: center;
      padding: 40px 20px;
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      transition: all 0.4s ease;
    }

    .services .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .services .card i {
      font-size: 3.5rem;
      color: var(--accent-color);
      margin-bottom: 20px;
      transition: all 0.3s ease;
    }

    .services .card:hover i {
      transform: scale(1.1);
      color: var(--primary-color);
    }

    /* Team */
    .team-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      width: 280px;
      text-align: center;
      transition: all 0.3s;
    }

    .team-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .team-card .team-img {
      width: 100%;
      height: 280px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 5rem;
    }

    .team-card h5 {
      color: var(--primary-color);
      margin: 20px 0 5px;
      font-size: 1.6rem;
    }

    .team-card p {
      color: var(--light-text);
      font-size: 1rem;
      margin-bottom: 20px;
    }

    .team-card .social-links {
      display: flex;
      justify-content: center;
      gap: 15px;
      padding-bottom: 20px;
    }

    .team-card .social-links a {
      color: var(--primary-color);
      font-size: 1.2rem;
      transition: all 0.3s;
    }

    .team-card .social-links a:hover {
      color: var(--accent-color);
      transform: scale(1.2);
    }

    /* Contact Form */
    .contact-form {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 1rem;
      outline: none;
      transition: all 0.3s;
      font-family: 'Poppins', sans-serif;
    }

    .contact-form input:focus, .contact-form textarea:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .contact-form button {
      background: var(--accent-color);
      color: white;
      padding: 14px 30px;
      border: none;
      border-radius: 30px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
      font-size: 1rem;
      width: 100%;
    }

    .contact-form button:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(76, 175, 80, 0.3);
    }

    /* Footer */
    footer {
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      color: white;
      text-align: center;
      padding: 40px 20px;
      margin-top: 50px;
    }

    .footer-content {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 0 auto 30px;
    }

    .footer-section {
      margin: 20px;
      min-width: 200px;
    }

    .footer-section h3 {
      margin-bottom: 15px;
      font-size: 1.3rem;
    }

    .footer-section p, .footer-section a {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 10px;
      display: block;
      transition: color 0.3s;
    }

    .footer-section a:hover {
      color: white;
    }

    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }

    .social-icons a {
      color: white;
      font-size: 1.5rem;
      transition: all 0.3s;
    }

    .social-icons a:hover {
      transform: translateY(-5px);
      color: #ffe082;
    }

    .copyright {
      border-top: 1px solid rgba(255, 255, 255, 0.2);
      padding-top: 20px;
      margin-top: 20px;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .navbar .menu {
        display: none;
      }
      
      .menu-toggle {
        display: block;
      }
      
      .navbar.active .menu {
        display: flex;
        flex-direction: column;
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: var(--primary-color);
        padding: 20px;
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
      }
      
      .navbar .buttons {
        margin-top: 15px;
      }
      
      .hero h1 {
        font-size: 2.5rem;
      }
    }

    @media (max-width: 768px) {
      .row {
        flex-direction: column;
        align-items: center;
      }
      
      .hero {
        padding: 150px 20px 150px;
      }
      
      .hero h1 {
        font-size: 2.2rem;
      }
      
      .hero p {
        font-size: 1.1rem;
      }
      
      .footer-content {
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar" id="navbar">
    <a href="#" class="brand"><i class="fas fa-seedling" style="color:#ffca28;"></i> Farmers Portal</a>
    <div class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars"></i>
    </div>
    <div class="menu">
      <a href="#about">About</a>
      <a href="#products">Products</a>
      <a href="#services">Services</a>
      <a href="#team">Team</a>
      <a href="#contact">Contact</a>
      <div class="buttons">
        <a href="{{ route('login') }}" class="login">Login</a>
        <a href="{{ route('register') }}" class="register">Register</a>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-content">
      <h1>Welcome to Farmers Portal</h1>
      <p>Connecting Farmers and Buyers for Better Agriculture</p>
      <a href="{{ route('login') }}" class="btn-custom"><i class="fas fa-seedling"style="color:#ffca28;"></i> Get Started</a>
    </div>
  </section>

  <!-- About -->
  <section id="about">
    <h2>About Us</h2>
    <p class="text-center">
      Our platform connects farmers directly with buyers, cutting out middlemen and ensuring fair prices for agricultural products.
      Buyers get fresh, organic produce straight from the source, while farmers gain access to a wider market.
      Together, we are building a stronger agricultural community.
    </p>
  </section>

  <!-- Featured Products -->
  <section id="products">
    <h2>Featured Products</h2>
    <div class="row">
      <div class="card">
        <img src="{{ asset('storage/uploads/1756964494_wheat.jpg') }}" alt="Wheat">
        <div class="card-body">
          <h5>Wheat</h5>
          <p>Freshly harvested golden wheat from local farms.</p>
        </div>
      </div>
      <div class="card">
        <img src="{{ asset('storage/uploads/1756964414_rice.jpg') }}" alt="Rice">
        <div class="card-body">
          <h5>Rice</h5>
          <p>High-quality rice grains grown with care.</p>
        </div>
      </div>
      <div class="card">
        <img src="{{ asset('storage/uploads/vegetables.jpg') }}" alt="Vegetables">
        <div class="card-body">
          <h5>Vegetables</h5>
          <p>Organic and healthy vegetables from trusted farmers.</p>
        </div>
      </div>
      <div class="card">
        <img src="{{ asset('storage/uploads/1756964730_milk.jpg') }}" alt="Milk">
        <div class="card-body">
          <h5>Milk</h5>
          <p>Fresh and healthy milk from trusted farmers.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section id="services">
    <h2>Our Services</h2>
    <div class="row services">
      <div class="card">
        <i class="fas fa-seedling"></i>
        <h5>Direct Farming</h5>
        <p>Connecting farmers directly to buyers for better deals.</p>
      </div>
      <div class="card">
        <i class="fas fa-truck"></i>
        <h5>Fast Delivery</h5>
        <p>Ensuring fresh produce reaches your doorstep quickly.</p>
      </div>
      <div class="card">
        <i class="fas fa-chart-line"></i>
        <h5>Market Insights</h5>
        <p>Helping farmers with real-time market analysis.</p>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section id="team">
    <h2>Our Team</h2>
    <div class="row">
      <div class="team-card">
        <div class="team-img">
          <i class="fas fa-user-tie"></i>
        </div>
        <h5>Rajdeep Jadeja</h5>
        <p>Founder & CEO</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
      </div>
      <div class="team-card">
        <div class="team-img">
          <i class="fas fa-user-tie"></i>
        </div>
        <h5>Faraz Saiyad</h5>
        <p>Operations Head</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
      </div>
      <div class="team-card">
        <div class="team-img">
          <i class="fas fa-user-tie"></i>
        </div>
        <h5>Anonymous</h5>
        <p>Marketing Lead</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact">
    <h2>Contact Us</h2>
    <p class="text-center">Have questions or want to join us? Send a message!</p>
    <div class="contact-form">
      <form action="#" method="post">
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Your Email" required>
        <textarea placeholder="Your Message" rows="6" required></textarea>
        <button type="submit"><i class="fas fa-paper-plane"></i> Send Message</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>About Us</h3>
        <p>Connecting farmers directly with buyers for better agriculture.</p>
      </div>
      <div class="footer-section">
        <h3>Quick Links</h3>
        <a href="#about">About</a>
        <a href="#products">Products</a>
        <a href="#services">Services</a>
        <a href="#team">Team</a>
      </div>
      <div class="footer-section">
        <h3>Contact Info</h3>
        <p><i class="fas fa-map-marker-alt"></i>  Farm Road, Agriculture City,Gondal</p>
        <p><i class="fas fa-phone"></i> +91 99041 XXXXX</p>
        <p><i class="fas fa-envelope"></i> info@farmersportal.com</p>
      </div>
    </div>
    <div class="social-icons">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-linkedin"></i></a>
    </div>
    <div class="copyright">
      <p>© 2026 Farmers Portal | Connecting Farmers & Buyers</p>
    </div>
  </footer>

  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.getElementById('navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Mobile menu toggle
    document.getElementById('menuToggle').addEventListener('click', function() {
      document.getElementById('navbar').classList.toggle('active');
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });

    // Form submission
    document.querySelector('.contact-form form').addEventListener('submit', function(e) {
      e.preventDefault();
      alert('Thank you for your message! We will get back to you soon.');
      this.reset();
    });
  </script>
</body>
</html>