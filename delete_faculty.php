<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
$conn = new mysqli("localhost", "root", "", "aiub_db");
$id = $_GET['id'];

// Delete image file
$result = $conn->query("SELECT image_path FROM faculties WHERE id=$id");
$row = $result->fetch_assoc();
if ($row && file_exists($row['image_path'])) {
  unlink($row['image_path']);
}

// Delete record
$conn->query("DELETE FROM faculties WHERE id=$id");
header("Location: view_faculties.php");
exit;
?>
