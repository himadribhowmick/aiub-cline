<?php
session_start();

// Protect the page
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

// Fake student name
$student_name = $_SESSION['student'] ?? 'Student';

// Example hardcoded grades
$grades = [
    ['course_code' => 'CSE101', 'course_name' => 'Introduction to Programming', 'grade' => 'A'],
    ['course_code' => 'MAT110', 'course_name' => 'Mathematics I', 'grade' => 'B+'],
    ['course_code' => 'PHY101', 'course_name' => 'Physics', 'grade' => 'A-'],
    ['course_code' => 'ENG101', 'course_name' => 'English Composition', 'grade' => 'B'],
    ['course_code' => 'CSE201', 'course_name' => 'Data Structures', 'grade' => 'A+'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Grades</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
    color: #333;
}

.header {
    background-color: #004080;
    color: white;
    text-align: center;
    padding: 20px;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

h2 {
    color: #004080;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.table th, .table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

.table th {
    background-color: #f0f0f0;
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
    <h1>📄 <?= htmlspecialchars($student_name) ?>'s Grades</h1>
</div>

<div class="container">
    <h2>📚 Semester Grades</h2>

    <table class="table">
        <tr>
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Grade</th>
        </tr>
        <?php foreach ($grades as $g): ?>
        <tr>
            <td><?= htmlspecialchars($g['course_code']) ?></td>
            <td><?= htmlspecialchars($g['course_name']) ?></td>
            <td><?= htmlspecialchars($g['grade']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div class="nav-buttons">
        <a href="student_dashboard.php">← Back to Dashboard</a>
        <a href="index.php">🏠 Back to Homepage</a>
    </div>
</div>

</body>
</html>
