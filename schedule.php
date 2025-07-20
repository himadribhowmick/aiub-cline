<?php
session_start();

// Protect the page
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

// Get student name if available
$student_name = $_SESSION['student'] ?? 'Student';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Schedule</title>
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
    max-width: 1200px;
    margin: 20px auto;
    padding: 0 20px;
}

.section {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.section h2 {
    color: #004080;
    margin-bottom: 15px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.table th {
    background-color: #f0f0f0;
}

.button {
    display: inline-block;
    padding: 10px 16px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #0056b3;
}
</style>
</head>

<body>

<div class="header">
    <h1>📅 <?= htmlspecialchars($student_name) ?>’s Schedule</h1>
</div>

<div class="container">

    <div class="section">
        <h2>📚 Class Schedule</h2>
        <table class="table">
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Course</th>
                <th>Room</th>
                <th>Instructor</th>
            </tr>
            <tr>
                <td>Sunday</td>
                <td>9:00 AM - 10:30 AM</td>
                <td>Introduction to Programming</td>
                <td>Room 101</td>
                <td>Dr. Rahman</td>
            </tr>
            <tr>
                <td>Tuesday</td>
                <td>11:00 AM - 12:30 PM</td>
                <td>Mathematics I</td>
                <td>Room 202</td>
                <td>Prof. Akter</td>
            </tr>
            <tr>
                <td>Thursday</td>
                <td>2:00 PM - 3:30 PM</td>
                <td>Physics</td>
                <td>Lab 3</td>
                <td>Ms. Alam</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>📝 Exam Schedule</h2>
        <table class="table">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Course</th>
                <th>Room</th>
            </tr>
            <tr>
                <td>15 Aug 2025</td>
                <td>10:00 AM - 12:00 PM</td>
                <td>Introduction to Programming</td>
                <td>Room 105</td>
            </tr>
            <tr>
                <td>18 Aug 2025</td>
                <td>1:00 PM - 3:00 PM</td>
                <td>Mathematics I</td>
                <td>Room 203</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>📋 Important Dates & Events</h2>
        <ul>
            <li>Course Add/Drop Deadline: 10 Aug 2025</li>
            <li>Mid-term Exams: 15–20 Aug 2025</li>
            <li>Final Exams: 10–20 Dec 2025</li>
            <li>Semester Break: 21–31 Dec 2025</li>
        </ul>
    </div>

    <div class="section">
        <h2>📂 Download Academic Calendar</h2>
        <p>You can download the full academic calendar PDF here:</p>
        <a href="academic_calendar.pdf" class="button" target="_blank">📄 Download Calendar</a>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="student_dashboard.php" class="button">← Back to Dashboard</a>
        <a href="index.php" class="button">🏠 Back to Homepage</a>
    </div>

</div>

</body>
</html>
