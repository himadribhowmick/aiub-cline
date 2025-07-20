<?php
// tuition_fees.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AIUB Tuition Fee</title>
  <link rel="stylesheet" href="tuition_fees.css" />
</head>
<body>
  <header>
    <h1>Tuition Fee Structure</h1>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Admissions</a></li>
        <li><a href="#">Programs</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="fee-table">
      <h2>Undergraduate Programs</h2>
      <table>
        <thead>
          <tr>
            <th>Program</th>
            <th>Per Credit Fee (BDT)</th>
            <th>Total Credits</th>
            <th>Estimated Total Cost</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>BSc in CSE</td>
            <td>5,000</td>
            <td>148</td>
            <td>740,000</td>
          </tr>
          <tr>
            <td>BBA</td>
            <td>4,800</td>
            <td>140</td>
            <td>672,000</td>
          </tr>
          <!-- Add more programs as needed -->
        </tbody>
      </table>
    </section>

    <section class="calculator">
      <h2>Tuition Fee Calculator</h2>
      <label for="credits">Enter Number of Credits:</label>
      <input type="number" id="credits" name="credits" min="1" />
      <label for="perCredit">Per Credit Fee (BDT):</label>
      <input type="number" id="perCredit" name="perCredit" min="1" />
      <button onclick="calculateFee()">Calculate</button>
      <p id="totalFee">Total Fee: BDT 0</p>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 American International University-Bangladesh</p>
  </footer>

  <script>
    function calculateFee() {
      const credits = document.getElementById("credits").value;
      const perCredit = document.getElementById("perCredit").value;
      const total = credits * perCredit;
      document.getElementById("totalFee").innerText = "Total Fee: BDT " + (isNaN(total) ? 0 : total);
    }
  </script>
</body>
</html>
