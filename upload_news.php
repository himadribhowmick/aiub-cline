<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "", "aiub_db");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $_POST['title'];
  $image_name = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  $upload_path = "uploads/" . basename($image_name);

  if (move_uploaded_file($image_tmp, $upload_path)) {
    $stmt = $conn->prepare("INSERT INTO news (title, image_path) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $upload_path);
    $stmt->execute();
    $message = "News uploaded successfully!";
  } else {
    $message = "Failed to upload image.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload News</title>
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
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .upload-container {
      background: white;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #333;
    }

    input[type="text"],
    input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
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
      text-align: center;
      font-size: 15px;
      color: green;
      margin-bottom: 20px;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 20px;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      color: #007bff;
      text-decoration: none;
      font-size: 15px;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="upload-container">
    <h2>Upload News and Events</h2>

    <?php if (!empty($message)): ?>
      <p class="<?php echo strpos($message, 'success') !== false ? 'message' : 'error-message'; ?>">
        <?php echo $message; ?>
      </p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <label for="title">News Title:</label>
      <input type="text" name="title" id="title" required>

      <label for="image">News Image:</label>
      <input type="file" name="image" id="image" accept="image/*" required>

      <button type="submit">Upload</button>
    </form>

    <a href="dashboard.php" class="back-link">← Back to Dashboard</a>
  </div>
</body>
</html>
