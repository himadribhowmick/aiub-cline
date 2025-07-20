<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "aiub_db");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $content = $_POST['content'];

  $sql = "INSERT INTO notices (title, content) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $title, $content);
  $stmt->execute();
  $message = "Notice uploaded successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Notice</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      background-color: #f4f6f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 40px;
    }

    .container {
      max-width: 600px;
      background: #fff;
      padding: 30px;
      margin: auto;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      color: green;
      text-align: center;
      margin-bottom: 20px;
    }

    .links {
      text-align: center;
      margin-top: 20px;
    }

    .links a {
      margin: 0 10px;
      text-decoration: none;
      color: white;
      background-color: #6c757d;
      padding: 10px 16px;
      border-radius: 6px;
      font-size: 14px;
    }

    .links a:hover {
      background-color: #5a6268;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Upload New Notice</h2>

    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST">
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" required>

      <label for="content">Content:</label>
      <textarea name="content" id="content" rows="6" required></textarea>

      <button type="submit">Upload</button>
    </form>

    <div class="links">
      <a href="dashboard.php">← Back to Dashboard</a>
      <a href="view_notices.php">View Notices</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
