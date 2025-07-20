<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student'];

$conn = new mysqli("localhost", "root", "", "aiub_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student info
$stmt = $conn->prepare("SELECT name, semester FROM students WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$student_result = $stmt->get_result();
$student = $student_result->fetch_assoc();
$stmt->close();

// Fetch enrolled courses
$stmt = $conn->prepare("
    SELECT c.course_code, c.course_name 
    FROM courses c
    JOIN student_courses sc ON c.id = sc.course_id
    WHERE sc.student_id = ?
");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$courses_result = $stmt->get_result();
$courses = [];
while ($row = $courses_result->fetch_assoc()) {
    $courses[] = $row;
}
$stmt->close();

// Fetch grades
$stmt = $conn->prepare("
    SELECT c.course_code, g.grade 
    FROM grades g
    JOIN courses c ON g.course_id = c.id
    WHERE g.student_id = ?
");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$grades_result = $stmt->get_result();
$grades = [];
while ($row = $grades_result->fetch_assoc()) {
    $grades[] = $row;
}
$stmt->close();

// Fetch notifications
$stmt = $conn->prepare("
    SELECT message, created_at 
    FROM notifications 
    WHERE student_id = ?
    ORDER BY created_at DESC
    LIMIT 5
");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$notifications_result = $stmt->get_result();
$notifications = [];
while ($row = $notifications_result->fetch_assoc()) {
    $notifications[] = $row;
}
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Dashboard</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f5f7fb;
    color: #333;
    transition: background-color 0.3s, color 0.3s;
}

body.dark {
    background-color: #121212;
    color: #ddd;
}

.header {
    background-color: #004080;
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
}

.header button {
    position: absolute;
    right: 20px;
    top: 20px;
    background: #fff;
    color: #004080;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    padding: 20px;
    max-width: 1200px;
    margin: auto;
}

.card {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s ease, background-color 0.3s ease, color 0.3s ease;
}

body.dark .card {
    background-color: #1e1e1e;
    color: #ccc;
}

.card:hover {
    transform: translateY(-3px);
}

.card h3 {
    margin-bottom: 10px;
    color: #004080;
}

body.dark .card h3 {
    color: #66b2ff;
}

.card p, .card ul {
    font-size: 14px;
    color: #555;
}

body.dark .card p, body.dark .card ul {
    color: #bbb;
}

.logout-btn {
    display: inline-block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #c0392b;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.logout-btn:hover {
    background-color: #e74c3c;
}
</style>
</head>
<body>

<div class="header">
    <h1>🎓 Student Dashboard</h1>
    <p>Welcome, <strong><?= htmlspecialchars($student['name']) ?></strong> (<?= htmlspecialchars($student['semester']) ?>)</p>
    <button onclick="toggleDark()">🌙/☀️</button>
</div>

<div class="dashboard">

    <div class="card">
        <h3><a href="my_courses.php">📚 My Courses</a></h3>
        <?php if (count($courses) > 0): ?>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li><?= htmlspecialchars($course['course_code']) ?> - <?= htmlspecialchars($course['course_name']) ?></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>No courses enrolled yet.</p>
        <?php endif; ?>
    </div>

    <div class="card">
        <h3><a href="assignments.php">📝 Assignments</a></h3>
        
        <p>Check your pending & submitted assignments</p>
        <a href="my_courses.php" style="color:#004080;">View Assignments →</a>
        
    </div>

    <div class="card">
        <h3></h3>
        <h3><a href="schedule.php">📅 Schedule</a></h3>
        <p>See your class & exam schedule</p>
        <a href="#" style="color:#004080;">View Schedule →</a>
    </div>

    <div class="card">
        <h3></h3>
        <h3><a href="enroll_course.php">Enroll Course</a></h3>
        <p>Enroll your Course</p>
        <a href="#" style="color:#004080;">View Course →</a>
    </div>

    <div class="card">
        <h3><a href="notifications.php">🔔 Notifications</h3>
        <?php if (count($notifications) > 0): ?>
        <ul>
            <?php foreach ($notifications as $note): ?>
                <li><?= htmlspecialchars($note['message']) ?> <br><small><?= htmlspecialchars($note['created_at']) ?></small></li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>No new notifications.</p>
        <?php endif; ?>
    </div>

   

</div>
<div style="text-align: center; margin-top: 10px;">
  <a href="index.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  " 
  onmouseover="this.style.backgroundColor='#0056b3'" 
  onmouseout="this.style.backgroundColor='#007bff'">
    ← Go to Homepage
  </a>
</div>



<div style="text-align: center;">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<script>
function toggleDark() {
    document.body.classList.toggle('dark');
}
</script>

</body>
</html>
