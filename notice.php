<?php
// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "aiub_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notices (latest first)
$sql = "SELECT * FROM notices ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>AIUB Notices</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="image/aiublogo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header class="top-header">
  <div class="top-info-bar">
    <div class="left-text">American International University-Bangladesh</div>
    <div class="right-links">
      <span class="icon">🔍</span>
      <a href="login.php">Login</a> |
      <a href="webmail.php">Web Mail</a> |
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
      <a href="contact.php">Contact</a>
    </nav>
  </div>
</header>

<section class="notices-wrapper">
  <h2>Latest Notices</h2>
  <div class="notices-grid">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <?php
          $date = date_create($row['created_at']);
          $day = date_format($date, 'd');
          $month = date_format($date, 'M');
          $year = date_format($date, 'Y');
        ?>
        <div class="notice-card">
          <div class="notice-date">
            <div class="day"><?= $day ?></div>
            <div class="month"><?= $month ?></div>
            <div class="year"><?= $year ?></div>
          </div>
          <div class="notice-content">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No notices found.</p>
    <?php endif; ?>
  </div>
</section>

<footer class="footer">
  <div class="footer-content">
    <div class="footer-left">
      <img src="image/aiublogo.png" alt="AIUB Logo" class="logo" />
      <p>American International University-Bangladesh (AIUB)</p>
      <p>Where leaders are created</p>
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
    </div>
  </div>
</footer>

</body>
</html>
