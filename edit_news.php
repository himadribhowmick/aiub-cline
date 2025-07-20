<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
$conn = new mysqli("localhost", "root", "", "aiub_db");
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $stmt = $conn->prepare("UPDATE news SET title=? WHERE id=?");
  $stmt->bind_param("si", $title, $id);
  $stmt->execute();
  header("Location: view_news.php");
  exit;
}

$res = $conn->query("SELECT * FROM news WHERE id=$id");
$news = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit News</title></head>
<body>
  <h2>Edit News</h2>
  <form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($news['title']) ?>" required><br><br>
    <button type="submit">Update</button>
  </form>
  <p><a href="view_news.php">Back to List</a></p>
</body>
</html>
