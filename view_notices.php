<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "aiub_db");
$result = $conn->query("SELECT * FROM notices ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Notices</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      padding: 40px;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    .notice {
      border: 1px solid #ddd;
      border-left: 5px solid #007bff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      background: #fafafa;
    }

    .notice h3 {
      margin: 0 0 10px;
      color: #007bff;
    }

    .notice p {
      margin: 10px 0;
      line-height: 1.6;
      color: #333;
    }

    .notice small {
      color: #555;
    }

    .back-btn {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 16px;
      background-color: #6c757d;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
    }

    .back-btn:hover {
      background-color: #5a6268;
    }

    .header {
      text-align: right;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="header">
    <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
  </div>

  <h2>All Uploaded Notices</h2>

  <?php while($row = $result->fetch_assoc()): ?>
    <div class="notice">
      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>
      <small>Posted on: <?= $row['created_at'] ?></small>
    </div>
  <?php endwhile; ?>
</div>

</body>
</html>
