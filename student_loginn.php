<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST['student_id'] ?? '';
    $password = $_POST['password'] ?? '';
    $semester = $_POST['semester'] ?? '';

    // Example: validate and check DB (you can implement your DB logic here)
    if ($student_id === "20251234" && $password === "password123") {
        $_SESSION['student'] = $student_id;
        header("Location: student_dashboard.php");
        exit();
    } else {
        $error = "Invalid Student ID or Password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background: linear-gradient(120deg, #f3f4f7, #ffffff);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login-container {
    background: #fff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    max-width: 400px;
    width: 100%;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

input, select {
    margin-bottom: 15px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

button {
    background: #007bff;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}

.error {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}

.links {
    text-align: center;
    margin-top: 10px;
}

.links a {
    color: #007bff;
    text-decoration: none;
}

.links a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="login-container">
    <h2>🎓 Student Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="student_id" placeholder="Student ID or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <select name="semester" required>
            <option value="">Select Semester</option>
            <option value="Spring">Spring</option>
            <option value="Summer">Summer</option>
            <option value="Fall">Fall</option>
        </select>

        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>

        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="student_register.php">Register</a> |
        <a href="recover_password.php">Forgot Password?</a>
    </div>
</div>

</body>
</html>
