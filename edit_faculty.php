<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
$conn = new mysqli("localhost", "root", "", "aiub_db");
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $stmt = $conn->prepare("UPDATE faculties SET name=? WHERE id=?");
  $stmt->bind_param("si", $name, $id);
  $stmt->execute();
  header("Location: view_faculties.php");
  exit;
}

$res = $conn->query("SELECT * FROM faculties WHERE id=$id");
$faculty = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Faculty</title></head>
<body>
  <h2>Edit Faculty</h2>
  <form method="POST">
    Faculty Name: <input type="text" name="name" value="<?= htmlspecialchars($faculty['name']) ?>" required><br><br>
    <button type="submit">Update</button>
  </form>
  <p><a href="view_faculties.php">Back to List</a></p>
</body>
</html>
