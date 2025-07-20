<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(to right, #dfe9f3, #ffffff);
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px;
    }

    .dashboard-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 700px;
    }

    h2 {
      color: #333;
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .button-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    a.button {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #007bff;
      color: #fff;
      padding: 15px 20px;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease, transform 0.2s ease;
      text-align: center;
    }

    a.button:hover {
      background-color: #0056b3;
      transform: scale(1.03);
    }

    .logout-btn {
      background-color: #dc3545;
    }

    .logout-btn:hover {
      background-color: #b52a37;
    }

    .home-button {
      margin-top: 30px;
      text-align: center;
    }

    .home-button a {
      background-color: #28a745;
    }

    .home-button a:hover {
      background-color: #1e7e34;
    }

    .emoji {
      margin-right: 8px;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <h2>👋 Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!</h2>

    <div class="button-grid">
      <a href="upload_notice.php" class="button">📤 Upload Notice</a>
      <a href="view_notices.php" class="button">📋 View All Notices</a>
      <a href="view_applications.php" class="button">📝 View Applications</a>
      <a href="upload_news.php" class="button">📰 Upload News</a>
      <a href="view_news.php" class="button">🛠️ Manage News</a>
      <a href="upload_faculty.php" class="button">🎓 Upload Faculty</a>
      <a href="view_faculties.php" class="button">🏫 Manage Faculties</a>
      <a href="logout.php" class="button logout-btn">🚪 Logout</a>
    </div>

    <div class="home-button">
      <a href="index.php" class="button">← Go to Homepage</a>
    </div>
  </div>
</body>
</html>
