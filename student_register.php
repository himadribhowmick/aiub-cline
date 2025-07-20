<?php
$conn = new mysqli("localhost", "root", "", "aiub_db");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST['agree'])) {
        $error = "You must agree to the Terms & Conditions.";
    } else {
        $student_id = $_POST['student_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $semester = $_POST['semester'];

        $stmt = $conn->prepare("INSERT INTO students (student_id, name, email, password, semester) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $student_id, $name, $email, $password, $semester);

        if ($stmt->execute()) {
            // Optional: Email Notification (if mail server configured)
            /*
            mail($email, "Registration Successful", "Hello $name,\nYour registration is successful.\nStudent ID: $student_id", "From: no-reply@youruniversity.edu");
            */
            header("Location: student_login.php?registered=1");
            exit();
        } else {
            $error = "Registration failed. Student ID or Email may already exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Registration</title>
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
.register-box {
  background: var(--bg-card);
  color: var(--text-color);
  padding: 25px 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  max-width: 450px;
  width: 100%;
  text-align: center;
  position: relative;
}
h2 {
  margin-bottom: 20px;
}
.message {
  color: red;
  margin-bottom: 15px;
}
form {
  text-align: left;
}
label {
  font-weight: 500;
  display: block;
  margin-top: 10px;
}
input[type="text"], input[type="email"], input[type="password"], select {
  width: 100%;
  padding: 10px;
  margin: 8px 0 15px;
  border: 1px solid var(--input-border);
  border-radius: 8px;
  font-size: 14px;
  background: #fff;
}
body.dark input, body.dark select {
  background: #444;
  color: #eee;
}
.input-group {
  position: relative;
}
.show-hide {
  position: absolute;
  right: 10px;
  top: 38px;
  cursor: pointer;
  font-size: 12px;
  color: var(--text-color);
}
button {
  width: 100%;
  padding: 12px;
  background-color: var(--button-bg);
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}
button:hover {
  background-color: var(--button-bg-hover);
}
.links {
  margin-top: 20px;
  text-align: center;
}
.links a {
  text-decoration: none;
  color: #007bff;
  font-size: 14px;
}
.links a:hover {
  text-decoration: underline;
}
.toggle-theme {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
  font-size: 18px;
  background: transparent;
  border: none;
  color: var(--text-color);
}
.terms {
  font-size: 13px;
  margin-top: -10px;
}
.loader {
  display: none;
  margin-top: 10px;
  font-size: 14px;
  color: green;
}
</style>
</head>
<body>

<div class="register-box">
  <button class="toggle-theme" onclick="toggleTheme()">🌙</button>

  <h2>Student Registration</h2>

  <?php if (!empty($error)): ?>
  <div class="message"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" onsubmit="return validateForm()">
    <label for="student_id">Student ID</label>
    <input type="text" name="student_id" id="student_id" required>

    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password</label>
    <div class="input-group">
      <input type="password" name="password" id="password" required>
      <span class="show-hide" onclick="togglePassword()">Show</span>
    </div>

    <label for="semester">Semester</label>
    <select name="semester" id="semester" required>
      <option value="">Select Semester</option>
      <option>Spring</option>
      <option>Summer</option>
      <option>Fall</option>
    </select>

    <div class="terms">
      <input type="checkbox" name="agree" id="agree">
      <label for="agree"> I agree to the <a href="terms.php" target="_blank">Terms & Conditions</a></label>
    </div>

    <button type="submit">Register</button>
    <div class="loader" id="loader">Registering...</div>
  </form>

  <div class="links">
    <p><a href="student_login.php">Already have an account? Login</a></p>
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

// Show/Hide password
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
