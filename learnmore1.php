<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Project | Secure Share</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary: #38b6ff;
      --primary-dark: #0099e6;
      --secondary: #667eea;
      --dark: #23272f;
      --light: #f8f9fa;
      --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      --hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #e3f6ff 0%, #f0f8ff 50%, #ffffff 100%);
      color: var(--dark);
      min-height: 100vh;
      line-height: 1.6;
    }

    header {
      background: var(--gradient);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 40px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .logo h2 {
      font-size: 1.7rem;
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo i {
      font-size: 1.5rem;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      margin-left: 28px;
      font-weight: 500;
      transition: all 0.3s ease;
      padding: 8px 16px;
      border-radius: 6px;
    }

    nav a:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-2px);
    }

    .hero {
      text-align: center;
      padding: 60px 20px;
      background: var(--gradient);
      color: white;
      margin-bottom: 40px;
      clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
    }

    .hero h1 {
      font-size: 3rem;
      margin-bottom: 15px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
      opacity: 0.9;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .about-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 50px;
    }

    .card {
      background: #fff;
      border-radius: 16px;
      box-shadow: var(--card-shadow);
      padding: 30px;
      transition: all 0.3s ease;
      border-top: 4px solid var(--primary);
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: var(--hover-shadow);
    }

    .card h2 {
      color: var(--primary);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 1.5rem;
    }

    .team-members {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .member {
      text-align: center;
      padding: 15px;
      border-radius: 10px;
      background: var(--light);
      transition: all 0.3s ease;
    }

    .member:hover {
      background: var(--primary);
      color: white;
      transform: scale(1.05);
    }

    .member i {
      font-size: 2rem;
      margin-bottom: 10px;
      color: var(--primary);
    }

    .member:hover i {
      color: white;
    }

    .tech-stack {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }

    .tech-item {
      background: var(--light);
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: 600;
      color: var(--primary);
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }

    .tech-item:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-3px);
    }

    .guidance-section {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }

    .guide-card {
      flex: 1;
      background: var(--light);
      padding: 20px;
      border-radius: 12px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .guide-card:hover {
      background: var(--primary);
      color: white;
      transform: translateY(-5px);
    }

    .guide-card h3 {
      margin-bottom: 10px;
      color: var(--primary);
    }

    .guide-card:hover h3 {
      color: white;
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin: 50px 0;
    }

    .stat-card {
      background: white;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      box-shadow: var(--card-shadow);
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--hover-shadow);
    }

    .stat-card i {
      font-size: 2.5rem;
      color: var(--primary);
      margin-bottom: 15px;
    }

    .stat-card .number {
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
      margin-bottom: 10px;
    }

    footer {
      background: var(--dark);
      color: white;
      text-align: center;
      padding: 30px 20px;
      margin-top: 60px;
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin: 20px 0;
    }

    .social-links a {
      color: white;
      font-size: 1.5rem;
      transition: all 0.3s ease;
    }

    .social-links a:hover {
      color: var(--primary);
      transform: translateY(-3px);
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        padding: 16px 20px;
        text-align: center;
      }
      
      nav {
        margin-top: 15px;
      }
      
      nav a {
        margin: 0 10px;
        display: inline-block;
      }
      
      .hero h1 {
        font-size: 2.2rem;
      }
      
      .guidance-section {
        flex-direction: column;
      }
      
      .about-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Animation classes */
    .fade-in {
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.8s ease forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .delay-1 {
      animation-delay: 0.2s;
    }

    .delay-2 {
      animation-delay: 0.4s;
    }

    .delay-3 {
      animation-delay: 0.6s;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <h2><i class="fas fa-shield-alt"></i> Secure Share</h2>
    </div>
    <nav>
      <a href="index"><i class="fas fa-home"></i> Home</a>
      <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="#"><i class="fas fa-chart-bar"></i> Monitoring</a>
    </nav>
  </header>

  <section class="hero">
    <h1>About This Project</h1>
    <p>Secure File Transfer System - Developed as part of our Computer Networks course</p>
  </section>

  <div class="container">
    <div class="stats">
      <div class="stat-card fade-in">
        <i class="fas fa-users"></i>
        <div class="number">5</div>
        <div>Team Members</div>
      </div>
      <div class="stat-card fade-in delay-1">
        <i class="fas fa-code"></i>
        <div class="number">4</div>
        <div>Technologies</div>
      </div>
      <div class="stat-card fade-in delay-2">
        <i class="fas fa-clock"></i>
        <div class="number">12+</div>
        <div>Weeks of Development</div>
      </div>
      <div class="stat-card fade-in delay-3">
        <i class="fas fa-tasks"></i>
        <div class="number">100%</div>
        <div>Project Completion</div>
      </div>
    </div>

    <div class="about-grid">
      <div class="card fade-in">
        <h2><i class="fas fa-user-graduate"></i> Developed By</h2>
        <div class="team-members">
          <div class="member">
            <i class="fas fa-user"></i>
            <div>Kamarul Zaman</div>
          </div>
          <div class="member">
            <i class="fas fa-user"></i>
            <div>Amith</div>
          </div>
          <div class="member">
            <i class="fas fa-user"></i>
            <div>Mufsila</div>
          </div>
          <div class="member">
            <i class="fas fa-user"></i>
            <div>Abhishek</div>
          </div>
          <div class="member">
            <i class="fas fa-user"></i>
            <div>Nived</div>
          </div>
        </div>
      </div>

      <div class="card fade-in delay-1">
        <h2><i class="fas fa-chalkboard-teacher"></i> Guidance</h2>
        <div class="guidance-section">
          <div class="guide-card">
            <h3><i class="fas fa-user-tie"></i> Tutor</h3>
            <p>Sai Krishna Miss</p>
          </div>
          <div class="guide-card">
            <h3><i class="fas fa-user-tie"></i> Project Guide</h3>
            <p>Nihala Miss</p>
          </div>
        </div>
      </div>

      <div class="card fade-in delay-2">
        <h2><i class="fas fa-laptop-code"></i> Technology Stack</h2>
        <p>This project is built using the <strong>LAMP Stack</strong> with modern web technologies:</p>
        <div class="tech-stack">
          <div class="tech-item"><i class="fab fa-linux"></i> Linux</div>
          <div class="tech-item"><i class="fas fa-server"></i> Apache</div>
          <div class="tech-item"><i class="fas fa-database"></i> MySQL</div>
          <div class="tech-item"><i class="fab fa-php"></i> PHP</div>
          <div class="tech-item"><i class="fab fa-html5"></i> HTML5</div>
          <div class="tech-item"><i class="fab fa-css3-alt"></i> CSS3</div>
          <div class="tech-item"><i class="fab fa-js"></i> JavaScript</div>
        </div>
      </div>
    </div>

    <div class="card fade-in delay-3">
      <h2><i class="fas fa-book"></i> Project Context</h2>
      <p>This website was developed as part of our project for the subject <strong>Basic Concepts of Computer Networks</strong>. The project demonstrates practical implementation of network security principles, file transfer protocols, and web application development.</p>
      <p>Our Secure Share platform enables users to transfer files securely with encryption, user authentication, and real-time monitoring capabilities.</p>
    </div>
  </div>

  <footer>
    <div class="social-links">
      <a href="#"><i class="fab fa-github"></i></a>
      <a href="#"><i class="fab fa-linkedin"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-facebook"></i></a>
    </div>
    <p>&copy; 2025 Secure Share. All rights reserved.</p>
    <p>Developed with <i class="fas fa-heart" style="color: #ff4757;"></i> by Team Secure Share</p>
  </footer>

  <script>
    // Simple intersection observer for animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animationPlayState = 'running';
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
      el.style.animationPlayState = 'paused';
      observer.observe(el);
    });
  </script>
</body>
</html>
