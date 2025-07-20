<?php
session_start();

// protect page
if (!isset($_SESSION['student'])) {
    header("Location: student_login.php");
    exit();
}

$student_name = $_SESSION['student'] ?? 'Student';

// dummy notifications
$notifications = [
    [
        'message' => 'Midterm exam schedule has been published.',
        'date' => '2025-07-01',
    ],
    [
        'message' => 'New assignment uploaded for Data Structures.',
        'date' => '2025-06-28',
    ],
    [
        'message' => 'Tuition fee payment deadline is July 15.',
        'date' => '2025-06-25',
    ],
    [
        'message' => 'Campus will remain closed on Eid holidays.',
        'date' => '2025-06-20',
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Notifications</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f7f9fb;
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

.notification {
    background-color: #eef5ff;
    border-left: 5px solid #004080;
    padding: 10px 15px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.notification strong {
    display: block;
    color: #333;
}

.date {
    font-size: 12px;
    color: #666;
}
.buttons {
    margin-top: 20px;
    text-align: center;
}
.button {
    display: inline-block;
    margin: 5px;
    padding: 8px 12px;
    background-color: #004080;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}
.button:hover {
    background-color: #003060;
}
</style>
</head>

<body>

<div class="header">
    <h1>🔔 Notifications</h1>
    <p>Welcome, <?= htmlspecialchars($student_name) ?></p>
</div>

<div class="container">
    <h2>Recent Notifications</h2>

    <?php if (!empty($notifications)): ?>
        <?php foreach ($notifications as $note): ?>
            <div class="notification">
                <strong><?= htmlspecialchars($note['message']) ?></strong>
                <div class="date">Date: <?= htmlspecialchars($note['date']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No notifications at the moment.</p>
    <?php endif; ?>

    <div class="buttons">
        <a href="student_dashboard.php" class="button">← Back to Dashboard</a>
        <a href="index.php" class="button">🏠 Go to Homepage</a>
    </div>
</div>

</body>
</html>
