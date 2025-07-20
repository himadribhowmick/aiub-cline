<?php
// ajbe.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AJBE | AIUB</title>
  <link rel="stylesheet" href="ajbe.css" />
</head>
<body>
  <!-- Top bar -->
  <div class="top-bar">
    <div>
      <a href="#">Register</a> | <a href="#">Login</a>
    </div>
    <div class="search">
      <input type="text" placeholder="Search" />
    </div>
  </div>

  <!-- Header -->
  <header class="header">
    <h1>AIUB Journal of Business and Economics</h1>
    <nav>
      <ul>
        <li><a href="#">Current</a></li>
        <li><a href="#">Archives</a></li>
        <li><a href="#">Call for Paper</a></li>
        <li><a href="#">Editorial Team</a></li>
        <li><a href="#">Article Template</a></li>
        <li><a href="#">About ▾</a></li>
      </ul>
    </nav>
  </header>

  <!-- Banner -->
  <section class="banner">
    <h2>AIUB Journal of Business and Economics [AJBE]</h2>
    <div class="issn">
      <span>PRINT: 1683-8742</span>
      <span>ONLINE: 2706-7076</span>
    </div>
    <div class="labels">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Google_Scholar_logo.svg" alt="Google Scholar" />
      <span class="green-label">EconPapers</span>
      <span class="orange-label">Open Access</span>
    </div>
  </section>

  <!-- Main content -->
  <main class="container">
    <section class="content">
      <h3>About the Journal</h3>
      <p>
        AIUB Journal of Business and Economics [AJBE] is a publication of the Faculty of Business Administration and the Faculty of Arts and Social Sciences, American International University-Bangladesh [AIUB]. This journal publishes original, empirical and innovative materials...
      </p>
      <p><strong>ISSN (PRINT)</strong> 1683-8742<br><strong>ISSN (ONLINE)</strong> 2706-7076</p>
      <p><strong>Article processing charges (For Authors):</strong> Free</p>

      <h3>Current Issue</h3>
      <p><strong>Vol. 21 No. 1 (2024):</strong> AJBE</p>
      <div class="issue-cover">
        <img src="https://journals.aiub.edu/index.php/ajbe/issue/view/1/1" alt="AJBE Cover"/>
        <div>
          <p>This work is licensed under a <a href="#">Creative Commons Attribution-NonCommercial 4.0 International License</a>.</p>
          <p><strong>Published:</strong> 2024-12-31</p>
        </div>
      </div>

      <h3>Articles</h3>

      <?php
      $articles = [
        ["title" => "Effect of Business Ethics and Product Offering...", "authors" => "Dr B M SAJAD HOSSAIN, A K M Kamrul Haque, Dr. M M Obaidul Islam", "pages" => "1–8"],
        ["title" => "The Impact of Foreign Aid on the Quality of Governance...", "authors" => "Zahin Syed", "pages" => "9–22"],
        ["title" => "Pre-COVID19 Scenario of Aftermarket Price Performance...", "authors" => "Mahedi Hassan, S M Shariful Islam", "pages" => "23–39"],
        ["title" => "Exploring Augmented Reality and Virtual Reality...", "authors" => "Mohammad Bajed, Mohammad Ayat Rahman", "pages" => "40–56"],
        ["title" => "Impact of Spiritual Intelligence in Asia on...", "authors" => "Md. Aftab Anwar, Rezbin Nahar, Partha Prasad Chowdhury, Hasibul Islam", "pages" => "57–70"],
        ["title" => "Effects of Pandemic: Personal and Professional Challenges...", "authors" => "Samia Shahnaz, Bohi Shajahan", "pages" => "71–83"]
      ];

      foreach ($articles as $article) {
        echo '<div class="article">';
        echo '<h4>' . htmlspecialchars($article["title"]) . '</h4>';
        echo '<p>' . htmlspecialchars($article["authors"]) . '</p>';
        echo '<span>' . htmlspecialchars($article["pages"]) . '</span> <button class="pdf-btn">PDF</button>';
        echo '</div>';
      }
      ?>

      <a class="view-all" href="#">View All Issues →</a>
    </section>

    <aside class="sidebar">
      <h4>Information</h4>
      <ul>
        <li><a href="#">For Readers</a></li>
        <li><a href="#">For Authors</a></li>
        <li><a href="#">For Librarians</a></li>
      </ul>
    </aside>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <p>For any inquiries email: ajbe@aiub.edu or <a href="#">mehzab.nahid@aiub.edu</a></p>
    <div class="license">
      <img src="https://licensebuttons.net/l/by-nc/4.0/88x31.png" alt="Creative Commons"/>
      <p>This work is licensed under a <a href="#">Creative Commons Attribution-NonCommercial 4.0 International License</a>.</p>
    </div>
    <p class="ojs">Platform & workflow by OJS / PKP</p>
  </footer>
</body>
</html>
