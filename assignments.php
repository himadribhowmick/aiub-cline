<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "aiub_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$course_code = $_GET['course'] ?? '';
if (!$course_code) {
    header("Location: my_courses.php");
    exit();
}

// fetch course id
$stmt = $conn->prepare("SELECT course_id FROM courses WHERE course_code = ?");
$stmt->bind_param("s", $course_code);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
$stmt->close();

if (!$course) {
    die("Course not found.");
}

$course_id = $course['course_id'];

// fetch assignments
$stmt = $conn->prepare("SELECT * FROM assignments WHERE course_id = ?");
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

$assignments = [];
while ($row = $result->fetch_assoc()) {
    $assignments[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Assignments - <?= htmlspecialchars($course_code) ?></title>
<style>
body { font-family: Arial; background: #f5f5f5; margin:0; padding:20px; }
.assignment-card {
    background: white;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
</head>
<body>

<h1>📝 Assignments for <?= htmlspecialchars($course_code) ?></h1>

<?php if (!empty($assignments)): ?>
    <?php foreach ($assignments as $a): ?>
        <div class="assignment-card">
            <strong><?= htmlspecialchars($a['title']) ?></strong><br>
            <em>Due: <?= htmlspecialchars($a['due_date']) ?></em><br>
            <p><?= nl2br(htmlspecialchars($a['description'])) ?></p>
            <a href="submit_assignment.php?assignment=<?= $a['id'] ?>">Submit Assignment →</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No assignments available yet.</p>
<?php endif; ?>

<p><a href="my_courses.php">← Back to My Courses</a></p>

</body>
</html>
