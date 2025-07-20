<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AIUB Homepage Clone</title>
  <link rel="stylesheet" href="style.css" />
  <script src="script.js"></script>
  <link rel="icon" type="image/png" href="image/aiublogo.png">
</head>
<body>
  <!-- Header -->
  <header class="top-header">
    <!-- Top Info Bar -->
    <div class="top-info-bar">
      <div class="left-text">
        American International University-Bangladesh
      </div>
      <div class="right-links">
        <span class="icon">🔍</span>
        <a href="login.php">Admin Login</a> 
        <a href="student_login.php">Student Login</a>
        <a href="webmail.php">Web Mail</a> 
        <a href="contact_us.php">Contact Us</a>
        
      </div>
    </div>

    <div class="main-header">
      <img src="image/aiublogo.png" alt="AIUB Logo" class="logo" />
      <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="academic.php">Academic</a>
        <a href="administration.php">Administration</a>
        <a href="admission.php">Admission</a>
        <a href="research.php">Research</a>
        <a href="notice.php">Notice</a>
        <a href="contact_us.php">contact</a>
      </nav>
    </div>
  </header>

  <!-- Hero Banner -->
  <section class="hero">
    <img src="image/campus-drone-shot-25-june-2024.webp" alt="Hero Banner" />
  </section>

  <!-- Find & Notice Section -->
  <section class="find-notice">
    <div class="find">
      <h2>Find Your Program</h2>
      <img src="image/_ASI9870.jpg" alt="Find Program" />
    </div>
    <div class="notice">
      <h2><a href="notice.php">Notice</a></h2>
      <ul>
        <li><a href="notice24-25.php">On Campus Make Up Class 17 and 24 May 2025</a></li>
        <li><a href="notice24-25.php">Admission Test Written Exam Summer 2024-25</a></li>
        <li><a href="notice24-25.php">On Campus Make Up Class 25 and 30 May 2025</a></li>
      </ul>
    </div>
  </section>

  <!-- News Section -->
<!-- News Section -->
<section class="news">
  <h2>News and Events</h2>
  <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; padding: 10px;">
    <?php
    $conn = new mysqli("localhost", "root", "", "aiub_db");
    $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 6");
    while ($row = $result->fetch_assoc()):
    ?>
      <div style="width: 200px; text-align: center; background: #fff; border-radius: 8px; box-shadow: 0 0 5px rgba(0,0,0,0.1); padding: 8px;">
        <a href="<?= $row['image_path'] ?>" target="_blank">
          <img src="<?= $row['image_path'] ?>" alt="<?= htmlspecialchars($row['title']) ?>" style="width: 100%; height: auto; border-radius: 6px;" />
        </a>
        <p style="font-size: 14px; margin-top: 6px;"><?= htmlspecialchars($row['title']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</section>



  <!-- Faculties Section -->
  <section class="faculties">
  <h2>Faculties</h2>
  <div class="faculty-grid" style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
    <?php
    $conn = new mysqli("localhost", "root", "", "aiub_db");
    $result = $conn->query("SELECT * FROM faculties ORDER BY created_at ASC");
    while ($row = $result->fetch_assoc()):
    ?>
      <div style="width: 200px; text-align: center;">
        <img src="<?= $row['image_path'] ?>" alt="<?= htmlspecialchars($row['name']) ?>" style="width: 100%; border-radius: 6px;" />
        <p style="font-weight: bold; margin-top: 5px;"><?= htmlspecialchars($row['name']) ?></p>
      </div>
    <?php endwhile; ?>
  </div>
</section>


  <!-- Discover Section -->
  <section class="discover">
    <h2>Discover</h2>
    <img src="image/fba-banner-2.png" alt="Library" />
  </section>

  <!-- Talents Section -->
  <section class="talents">
    <h2>Talents of AIUB</h2>
    <img src="image/news3.jpeg" alt="Talented Students" />
  </section>

  <!-- Facts Section -->
  <section class="facts">
    <h2>Facts and Figures</h2>
    <div class="facts-grid">
      <div>5 Faculties</div>
      <div>21 Programs</div>
      <div>39,460 Alumni</div>
    </div>
  </section>

  <!-- Campus Life & Research -->
  <section class="campus-research">
    <h2>Campus Life</h2>
    <img src="image/_ASI9870.jpg" alt="Campus Life" />
    <h2>Research</h2>
    <img src="image/moucridusa10.jpg" alt="Research" />
  </section>

  <!-- Notable Alumni -->
  <section class="alumni">
    <h2>Notable Alumni</h2>
    <div class="alumni-grid">
      <img src="image/mahamudullah.webp" alt="Alumni 1" />
      <img src="image/zaheed-sabur.jpeg" alt="Alumni 2" />
      <img src="image/tarjina-islam.png" alt="Alumni 3" />
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer about-footer">
    <div class="footer-content">
      <div class="footer-left">
        <img src="image/aiublogo.png" alt="AIUB Logo" class="logo" />
        <p>American International University-Bangladesh (AIUB)</p>
        <p>Where leaders are created</p>
        <div class="social-icons">
          <a href="#"><img src="image/fb.jpeg" alt="Facebook"></a>
          <a href="#"><img src="image/twt.png" alt="Twitter"></a>
          <a href="#"><img src="image/lindin.png" alt="LinkedIn"></a>
          <a href="#"><img src="image/yt.png" alt="YouTube"></a>
        </div>
      </div>
      <div class="footer-center">
        <h4>Contact</h4>
        <p>Email: info@aiub.edu</p>
        <p>Address: 408/1 (Old KA 66/1), Kuratoli, Khilkhet, Dhaka-1229</p>
        <p>Phone: +88 02 841 4046-9; +88 02 841 4050</p>
      </div>
      <div class="footer-right">
        <h4>Become AIUBian</h4>
        <ul>
          <li><a href="#">Future Students</a></li>
          <li><a href="#">On Campus</a></li>
          <li><a href="#">Admission</a></li>
          <li><a href="#">Tuition Fees</a></li>
          <li><a href="#">Scholarships</a></li>
          <li><a href="#">Apply Now</a></li>
        </ul>
        <h4>Academic</h4>
        <ul>
          <li><a href="#">Academic Calendar</a></li>
          <li><a href="#">Academic Regulations</a></li>
          <li><a href="#">Faculty of Arts & Social Sciences</a></li>
          <li><a href="#">Faculty of Business Administration</a></li>
          <li><a href="#">Faculty of Engineering</a></li>
          <li><a href="#">Faculty of Science & Technology</a></li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>
