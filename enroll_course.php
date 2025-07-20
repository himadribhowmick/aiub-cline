<?php
session_start();

// Protect page
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

// fake student name for demo
$student_name = $_SESSION['student'] ?? 'Student';

// fake available courses list
$available_courses = [
    ['code' => 'CSE101', 'name' => 'Introduction to Programming'],
    ['code' => 'MAT110', 'name' => 'Mathematics I'],
    ['code' => 'PHY101', 'name' => 'Physics'],
    ['code' => 'ENG101', 'name' => 'English Composition'],
    ['code' => 'CSE201', 'name' => 'Data Structures'],
    ['code' => 'CSE301', 'name' => 'Database Systems'],
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $enrolled_courses = $_POST['courses'] ?? [];
    $message = "You have enrolled in the following courses: <br>" . implode(", ", array_map('htmlspecialchars', $enrolled_courses));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Enroll in Courses</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    color: #333;
    margin: 0;
    padding: 0;
}

.header {
    background-color: #004080;
    color: white;
    padding: 20px;
    text-align: center;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

h2 {
    color: #004080;
    margin-bottom: 15px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="checkbox"] {
    margin-right: 10px;
}

button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

.success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
}

.nav-buttons {
    margin-top: 20px;
    text-align: center;
}

.nav-buttons a {
    display: inline-block;
    margin: 5px;
    padding: 8px 12px;
    background-color: #004080;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.nav-buttons a:hover {
    background-color: #003366;
}
</style>
</head>

<body>

<div class="header">
    <h1>📚 Enroll in Courses</h1>
    <p>Welcome, <?= htmlspecialchars($student_name) ?></p>
</div>

<div class="container">
    <h2>Select Courses to Enroll</h2>

    <?php if (!empty($message)): ?>
        <div class="success"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <?php foreach ($available_courses as $course): ?>
            <label>
                <input type="checkbox" name="courses[]" value="<?= htmlspecialchars($course['code']) ?>">
                <?= htmlspecialchars($course['code']) ?> — <?= htmlspecialchars($course['name']) ?>
            </label>
        <?php endforeach; ?>

        <button type="submit">Enroll</button>
    </form>

    <div class="nav-buttons">
        <a href="student_dashboard.php">← Back to Dashboard</a>
        <a href="index.php">🏠 Back to Homepage</a>
    </div>
</div>

</body>
</html>
