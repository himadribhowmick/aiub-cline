<?php
session_start();
$conn = new mysqli("localhost", "root", "", "aiub_db");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['agree'])) {
        $error = "You must agree to the Terms & Conditions.";
    } elseif (empty($_POST['captcha']) || $_POST['captcha'] !== $_SESSION['captcha']) {
        $error = "Invalid CAPTCHA.";
    } else {
        $student_id = $_POST['student_id'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();

        if ($student && password_verify($password, $student['password'])) {
            $_SESSION['student'] = $student['student_id'];
            header("Location: student_dashboard.php");
            exit();
        } else {
            $error = "Invalid Student ID or Password.";
        }
    }
}

// generate a simple captcha
$captcha = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
$_SESSION['captcha'] = $captcha;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  :root {
    --bg-gradient: linear-gradient(135deg, #74ebd5, #ACB6E5);
    --bg-card: #fff;
    --text-color: #333;
    --input-border: #ccc;
    --button-bg: #007bff;
    --button-bg-hover: #0056b3;
  }

  body.dark {
    --bg-gradient: linear-gradient(135deg, #232526, #414345);
    --bg-card: #2c2c2c;
    --text-color: #eee;
    --input-border: #555;
    --button-bg: #4e9af1;
    --button-bg-hover: #1c71d8;
  }

  * {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    background: var(--bg-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    padding: 10px;
    transition: background 0.4s ease;
  }

  .login-box {
    background: var(--bg-card);
    color: var(--text-color);
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
    animation: slideIn 0.6s ease-out;
    position: relative;
  }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .logo {
    margin-bottom: 15px;
  }

  .logo a { text-decoration: none; color: inherit; }
  .logo img {
    width: 80px; height: 80px; object-fit: contain;
    border-radius: 50%;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
  }

  h2 { margin: 10px 0 20px; }

  .message { margin-bottom: 15px; font-size: 14px; }
  .success { color: green; }
  .error { color: red; }

  form { text-align: left; }

  label { font-weight: 500; }
  .input-group { position: relative; }

  input[type="text"], input[type="password"] {
    width: 100%; padding: 10px; margin: 8px 0 15px;
    border: 1px solid var(--input-border);
    border-radius: 8px; font-size: 14px;
    background: #fff;
  }

  body.dark input { background: #444; color: #eee; }

  .show-hide {
    position: absolute; right: 10px; top: 12px; cursor: pointer;
    font-size: 12px; color: var(--text-color);
  }

  .captcha-box {
    text-align: center; font-weight: bold;
    background: #eee; color: #333;
    letter-spacing: 4px; padding: 8px; border-radius: 6px;
    margin-bottom: 10px; user-select: none;
  }

  button {
    width: 100%; padding: 12px;
    background-color: var(--button-bg); color: white;
    border: none; border-radius: 8px; font-size: 16px;
    cursor: pointer; transition: background-color 0.3s ease;
  }

  button:hover { background-color: var(--button-bg-hover); }

  .links { margin-top: 15px; text-align: center; }
  .links a {
    text-decoration: none; color: #007bff;
    margin: 0 10px; font-size: 14px;
  }

  .links a:hover { text-decoration: underline; }

  .toggle-theme {
    position: absolute; top: 10px; right: 10px;
    cursor: pointer; font-size: 18px;
    background: transparent; border: none;
    color: var(--text-color);
  }

  .loader { display: none; text-align: center; margin-top: 10px; font-size: 14px; }

  .terms { font-size: 13px; margin-top: -10px; }

  @media (max-width: 420px) {
    .login-box { padding: 20px; }
    .logo img { width: 60px; height: 60px; }
  }
</style>
</head>
<body>

<div class="login-box">
  <button class="toggle-theme" onclick="toggleTheme()">🌙</button>

  <div class="logo">
    <a href="index.php">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Logo">
    </a>
  </div>

  <a href="index.php" style="text-decoration:none; color:inherit;">
    <h2>Student Login</h2>
  </a>

  <?php if (!empty($_GET['registered'])): ?>
    <div class="message success">Registration successful. Please login.</div>
  <?php endif; ?>

  <?php if (!empty($error)): ?>
    <div class="message error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" onsubmit="return validateForm()">
    <label for="student_id">Student ID</label>
    <input type="text" name="student_id" id="student_id" required>

    <label for="password">Password</label>
    <div class="input-group">
      <input type="password" name="password" id="password" required>
      <span class="show-hide" onclick="togglePassword()">Show</span>
    </div>

    <label>CAPTCHA</label>
    <div class="captcha-box"><?= $_SESSION['captcha'] ?></div>
    <input type="text" name="captcha" placeholder="Enter CAPTCHA" required>

    <div class="terms">
      <input type="checkbox" name="agree" id="agree">
      <label for="agree"> I agree to the <a href="#">Terms & Conditions</a></label>
    </div>

    <button type="submit">Login</button>
    <div class="loader" id="loader">Logging in...</div>
  </form>

  <div class="links">
    <a href="student_register.php">Register</a> |
    <a href="recover_password.php">Forgot Password?</a>
  </div>
</div>

<script>
// Dark mode toggle + persist
if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark");
  document.querySelector(".toggle-theme").textContent = "☀️";
}

function toggleTheme() {
  document.body.classList.toggle('dark');
  const btn = document.querySelector('.toggle-theme');
  if (document.body.classList.contains('dark')) {
    btn.textContent = '☀️';
    localStorage.setItem("theme", "dark");
  } else {
    btn.textContent = '🌙';
    localStorage.setItem("theme", "light");
  }
}

// Show/hide password
function togglePassword() {
  const pwd = document.getElementById("password");
  const toggle = document.querySelector(".show-hide");
  if (pwd.type === "password") {
    pwd.type = "text";
    toggle.textContent = "Hide";
  } else {
    pwd.type = "password";
    toggle.textContent = "Show";
  }
}

// loader & validate terms
function validateForm() {
  const agree = document.getElementById('agree');
  if (!agree.checked) {
    alert("You must agree to the Terms & Conditions.");
    return false;
  }
  document.getElementById("loader").style.display = "block";
  return true;
}
</script>

</body>
</html>
