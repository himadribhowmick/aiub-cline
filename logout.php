<?php
session_start();
session_unset();
session_destroy();

// Redirect to homepage after logout
header("Location: index.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out</title>
  <meta http-equiv="refresh" content="3;url=login.php"> <!-- Redirect in 3 seconds -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: #f4f7fa;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .logout-box {
      text-align: center;
      background: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      max-width: 400px;
    }

    h1 {
      color: #007bff;
      font-size: 28px;
      margin-bottom: 15px;
    }

    p {
      color: #333;
      font-size: 16px;
    }

    .spinner {
      margin: 20px auto;
      width: 40px;
      height: 40px;
      border: 4px solid #ccc;
      border-top: 4px solid #007bff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="logout-box">
    <h1>Logged Out</h1>
    <p>You have been successfully logged out.<br>Redirecting to login page...</p>
    <div class="spinner"></div>
  </div>
</body>
</html>
