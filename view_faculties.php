<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
$conn = new mysqli("localhost", "root", "", "aiub_db");
$faculties = $conn->query("SELECT * FROM faculties ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Faculties</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f9;
      margin: 0;
      padding: 40px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .top-links {
      text-align: center;
      margin-bottom: 30px;
    }

    .top-links a {
      text-decoration: none;
      margin: 0 10px;
      color: #ffffff;
      background-color: #007bff;
      padding: 10px 18px;
      border-radius: 6px;
      transition: background-color 0.3s;
    }

    .top-links a:hover {
      background-color: #0056b3;
    }

    .faculty-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .faculty-card img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid #ddd;
    }

    .faculty-info {
      flex-grow: 1;
    }

    .faculty-name {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }

    .action-links a {
      margin-right: 15px;
      text-decoration: none;
      color: #007bff;
      font-weight: 500;
    }

    .action-links a:hover {
      text-decoration: underline;
    }

    @media (max-width: 600px) {
      .faculty-card {
        flex-direction: column;
        align-items: flex-start;
      }

      .faculty-card img {
        width: 100%;
        height: auto;
      }

      .action-links a {
        display: block;
        margin-bottom: 8px;
      }
    }
  </style>
</head>
<body>

  <h2>All Faculties</h2>

  <div class="top-links">
    <a href="upload_faculty.php">Upload New</a>
    <a href="dashboard.php">Back to Dashboard</a>
  </div>

  <?php while ($row = $faculties->fetch_assoc()): ?>
    <div class="faculty-card">
      <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="Faculty Image">
      <div class="faculty-info">
        <div class="faculty-name"><?= htmlspecialchars($row['name']) ?></div>
        <div class="action-links">
          <a href="edit_faculty.php?id=<?= $row['id'] ?>">Edit</a>
          <a href="delete_faculty.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this faculty?');">Delete</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>

</body>
</html>
