<?php
// research-publications.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AIUB Faculty of Engineering - Research Publications</title>
  <link rel="stylesheet" href="researchAndPublications.css" />
</head>
<body>
  <header>
    <h1>Research Publications</h1>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Faculties</a></li>
        <li><a href="#">Research</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="search-bar">
      <input type="text" id="searchInput" placeholder="Search publications..." onkeyup="filterPublications()" />
    </section>

    <section class="publications-list">
      <ul id="publications">
        <li>
          <h3>Design and Implementation of an Electric Wheel-Chair to Economize it with Respect to Bangladesh</h3>
          <p><strong>Authors:</strong> Kazi Muhammad Jameel</p>
          <p><strong>Journal:</strong> International Journal of Multidisciplinary Sciences and Engineering, Volume 5, Issue 2, March 2014</p>
        </li>
        <li>
          <h3>Impulse Noise on Multi-Antenna Receiving System in WLAN-Band</h3>
          <p><strong>Authors:</strong> Asif Ahmed, Wayesh Qarony, M. Hossain</p>
          <p><strong>Journal:</strong> Bulletin of Electrical Engineering and Informatics, Vol.3 No. 4, December 2014</p>
        </li>
        <!-- Add more publication entries as needed -->
      </ul>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> American International University-Bangladesh</p>
  </footer>

  <script>
    function filterPublications() {
      const input = document.getElementById("searchInput");
      const filter = input.value.toLowerCase();
      const ul = document.getElementById("publications");
      const li = ul.getElementsByTagName("li");

      for (let i = 0; i < li.length; i++) {
        const title = li[i].getElementsByTagName("h3")[0];
        const txtValue = title.textContent || title.innerText;
        li[i].style.display = txtValue.toLowerCase().indexOf(filter) > -1 ? "" : "none";
      }
    }
  </script>
</body>
</html>
