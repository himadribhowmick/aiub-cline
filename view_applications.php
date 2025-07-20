<?php
session_start();

// Optional: Only allow access if admin is logged in
 if (!isset($_SESSION['admin'])) {
     header("Location: login.php");
     exit();
 }

$conn = new mysqli("localhost", "root", "", "aiub_admission");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $conn->query("DELETE FROM applications WHERE id = $delete_id");
    header("Location: view_applications.php");
    exit();
}

// Handle search
$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query = "SELECT * FROM applications 
              WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR program LIKE '%$search%'
              ORDER BY submission_date DESC";
} else {
    $query = "SELECT * FROM applications ORDER BY submission_date DESC";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Applications</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      padding: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 10px;
      width: 300px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    button, .export-btn {
      padding: 10px 20px;
      border: none;
      background-color: #007bff;
      color: white;
      border-radius: 6px;
      cursor: pointer;
      margin-left: 10px;
    }

    .export-btn {
      background-color: #28a745;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 14px;
    }

    th {
      background-color: #007bff;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    a {
      color: #007bff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .delete-link {
      color: red;
      font-weight: bold;
    }

    .scroll-box {
      max-height: 600px;
      overflow: auto;
      margin-top: 20px;
    }
  </style>
</head>
<body>
    <div style="text-align: right; margin-bottom: 20px;">
  <a href="dashboard.php" style="background-color: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px;">← Back to Dashboard</a>
</div>


<h2>All Submitted Applications</h2>

<form method="get" action="">
  <input type="text" name="search" placeholder="Search by Name, Email or Program" value="<?php echo htmlspecialchars($search); ?>">
  <button type="submit">Search</button>
  <a href="export_excel.php" class="export-btn">Export to Excel</a>
</form>

<div class="scroll-box">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Program</th>
        <th>Semester</th>
        <th>Photo</th>
        <th>Certificate</th>
        <th>Submitted</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo $row['dob']; ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['program']; ?></td>
        <td><?php echo $row['semester']; ?></td>
        <td><a href="<?php echo $row['photo']; ?>" target="_blank">View</a></td>
        <td><a href="<?php echo $row['certificate']; ?>" target="_blank">View</a></td>
        <td><?php echo $row['submission_date']; ?></td>
        <td><a href="?delete=<?php echo $row['id']; ?>" class="delete-link" onclick="return confirm('Delete this application?')">Delete</a></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>

<?php $conn->close(); ?>