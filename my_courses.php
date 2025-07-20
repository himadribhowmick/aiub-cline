<?php
session_start();

// protect page
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student'];
$conn = new mysqli("localhost", "root", "", "aiub_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle drop courses
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drop_courses'])) {
    $to_drop = $_POST['drop_courses'];
    $stmt = $conn->prepare("DELETE FROM student_courses WHERE student_id = ? AND course_id = ?");
    foreach ($to_drop as $course_id) {
        $stmt->bind_param("si", $student_id, $course_id);
        $stmt->execute();
    }
    $stmt->close();
    $message = "✅ Selected courses have been dropped.";
}

// fetch enrolled courses
$stmt = $conn->prepare("
    SELECT sc.course_id, c.course_code, c.course_name 
    FROM student_courses sc
    JOIN courses c ON sc.course_id = c.id
    WHERE sc.student_id = ?
");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$enrolled_courses = [];
while ($row = $result->fetch_assoc()) {
    $enrolled_courses[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Courses</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f7f9fc;
    margin: 0;
    padding: 0;
    color: #333;
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
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
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

button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #c0392b;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #e74c3c;
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
    <h1>📄 My Enrolled Courses</h1>
    <p>Welcome, <?= htmlspecialchars($student_id) ?></p>
</div>

<div class="container">
    <h2>Enrolled Courses</h2>

    <?php if (!empty($message)): ?>
        <div class="success"><?= $message ?></div>
    <?php endif; ?>

    <?php if (!empty($enrolled_courses)): ?>
        <form method="POST">
            <?php foreach ($enrolled_courses as $course): ?>
                <label>
                    <input type="checkbox" name="drop_courses[]" value="<?= $course['course_id'] ?>">
                    <?= htmlspecialchars($course['course_code']) ?> — <?= htmlspecialchars($course['course_name']) ?>
                </label>
            <?php endforeach; ?>
            <button type="submit">Drop Selected Courses</button>
        </form>
    <?php else: ?>
        <p>You are not enrolled in any courses yet.</p>
    <?php endif; ?>

    <div class="nav-buttons">
        <a href="enroll_courses.php">📚 Enroll More Courses</a>
        <a href="student_dashboard.php">← Back to Dashboard</a>
        <a href="index.php">🏠 Back to Homepage</a>
    </div>
</div>

</body>
</html>
