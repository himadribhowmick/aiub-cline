<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "aiub_db");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  $path = "uploads/" . basename($image);

  if (move_uploaded_file($tmp, $path)) {
    $stmt = $conn->prepare("INSERT INTO faculties (name, image_path) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $path);
    $stmt->execute();
    $msg = "Faculty uploaded!";
  } else {
    $msg = "Upload failed.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Faculty</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f2f4f8;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .upload-box {
      background: #ffffff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      text-align: center;
    }

    h2 {
      color: #333;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      text-align: left;
      font-weight: 500;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    button {
      padding: 12px 25px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      color: green;
      margin-bottom: 20px;
      font-weight: bold;
    }

    .nav-links {
      margin-top: 20px;
    }

    .nav-links a {
      color: #007bff;
      text-decoration: none;
      margin: 0 10px;
      font-size: 15px;
    }

    .nav-links a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="upload-box">
    <h2>Upload Faculty</h2>

    <?php if (!empty($msg)): ?>
      <div class="message"><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <label for="name">Faculty Name:</label>
      <input type="text" name="name" id="name" required>

      <label for="image">Image:</label>
      <input type="file" name="image" id="image" accept="image/*" required>

      <button type="submit">Upload</button>
    </form>

    <div class="nav-links">
      <a href="view_faculties.php">View All Faculties</a> |
      <a href="dashboard.php">← Back to Dashboard</a>
    </div>
  </div>
</body>
</html>
