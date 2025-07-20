<?php
// admission_result.php - Admission Test Final Result Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admission Test Final Result - Summer 2024-25</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    header {
      background-color: #002b55;
      color: white;
      padding: 1rem;
      text-align: center;
    }

    .container {
      display: flex;
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 1rem;
    }

    .sidebar {
      width: 80px;
      text-align: center;
      background-color: #e8f0fa;
      border-right: 1px solid #ccc;
      padding: 1rem 0;
      font-weight: bold;
    }

    .content {
      flex: 1;
      padding: 1rem 2rem;
    }

    h1 {
      font-size: 1.8rem;
      color: #002b55;
    }

    .notice-date {
      font-size: 1.2rem;
      font-weight: bold;
      color: #0077cc;
    }

    .instructions {
      background: #fff3cd;
      border: 1px solid #ffeeba;
      padding: 1rem;
      margin: 1rem 0;
    }

    .section {
      margin: 2rem 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      overflow: hidden;
      background-color: #fff;
    }

    .section-header {
      background-color: #004080;
      color: white;
      padding: 1rem;
      cursor: pointer;
    }

    .section-content {
      display: none;
      padding: 1rem;
      background-color: #fefefe;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th, td {
      padding: 8px 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #f1f1f1;
    }

    footer {
      text-align: center;
      background-color: #002b55;
      color: white;
      padding: 1rem;
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>Admission Test Final Result</h1>
    <p class="notice-date">Summer 2024-25 (Slot 1)</p>
  </header>

  <div class="container">
    <div class="sidebar">
      <div>18</div>
      <div>MAY</div>
      <div>2025</div>
      <div style="margin-top: 10px;">NOTICE</div>
    </div>

    <div class="content">
      <div class="instructions">
        <p>Selected students are requested to complete their admission formalities within the due date. The merit list includes ID, name, department, and result status.</p>
      </div>

      <!-- Section 1 -->
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)">Faculty of Science & Technology (CSE, CS)</div>
        <div class="section-content">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Program</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>24-00001-1</td>
                <td>John Doe</td>
                <td>CSE</td>
                <td>Selected</td>
              </tr>
              <tr>
                <td>24-00002-1</td>
                <td>Jane Smith</td>
                <td>CS</td>
                <td>Selected</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Section 2 -->
      <div class="section">
        <div class="section-header" onclick="toggleSection(this)">Faculty of Business Administration</div>
        <div class="section-content">
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Program</th>
                <th>Remarks</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>24-00003-1</td>
                <td>Mary Johnson</td>
                <td>BBA</td>
                <td>Selected</td>
              </tr>
              <tr>
                <td>24-00004-1</td>
                <td>David Lee</td>
                <td>BBA</td>
                <td>Waiting</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- More sections can be added as needed -->

    </div>
  </div>

  <footer>
    &copy; 2025 American International University-Bangladesh (AIUB)
  </footer>

  <script>
    function toggleSection(header) {
      const content = header.nextElementSibling;
      content.style.display = content.style.display === "block" ? "none" : "block";
    }
  </script>
</body>
</html>
