<?php
// anoe.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AIUB Network of Excellence (ANOE)</title>
  <link rel="stylesheet" href="anoe.css"/>
</head>
<body>
  <header>
    <div class="topbar">American International University-Bangladesh</div>
    <nav class="navbar">
      <div class="logo">AIUB</div>
      <ul>
        <li><a href="#">About</a></li>
        <li><a href="#">Academics</a></li>
        <li><a href="#">Admission</a></li>
        <li><a href="#">On Campus</a></li>
        <li><a href="#">Administration</a></li>
        <li><a href="#">Research</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="banner">
      <h1>AIUB Network of Excellence (ANOE)</h1>
    </section>

    <section class="content">
      <div class="anoe-description">
        <p>
          <?php
          echo "The AIUB Network of Excellence (ANOE) is an association of researchers dedicated to achieving excellence within the interdisciplinary research community at AIUB. Members collaborate by sharing ideas and resources, obtaining grants, and maintaining a strong ethical culture to promote innovation, reflective thinking, and knowledge development. ANOE is committed to advocating for research at AIUB, recognizing its value and necessity in contemporary times. The community aims to create a global footprint across various research areas, with members actively engaged in promoting research and possessing proven research track records.";
          ?>
        </p>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> AIUB. All rights reserved.</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
