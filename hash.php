<?php
$plainPassword = "himu123"; // Change to your password
$hash = password_hash($plainPassword, PASSWORD_DEFAULT);

$conn = new mysqli("localhost", "root", "", "aiub_db");
$conn->query("UPDATE admin SET password='$hash' WHERE email='himu@gmail.com'");
echo "Password hashed and updated.";
?>
