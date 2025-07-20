<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "aiub_admission");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form inputs safely
$name        = $_POST['name'];
$dob         = $_POST['dob'];
$gender      = $_POST['gender'];
$nationality = $_POST['nationality'];
$email       = $_POST['email'];
$phone       = $_POST['phone'];
$address     = $_POST['address'];
$ssc         = $_POST['ssc'];
$hsc         = $_POST['hsc'];
$program     = $_POST['program'];
$semester    = $_POST['semester'];

// Handle File Uploads
$photoPath = '';
$certPath  = '';

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
    $photoName = time() . '_' . basename($_FILES['photo']['name']);
    $photoPath = "uploads/photos/" . $photoName;
    move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath);
}

if (isset($_FILES['certificate']) && $_FILES['certificate']['error'] === 0) {
    $certName = time() . '_' . basename($_FILES['certificate']['name']);
    $certPath = "uploads/certificates/" . $certName;
    move_uploaded_file($_FILES['certificate']['tmp_name'], $certPath);
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO applications 
(name, dob, gender, nationality, email, phone, address, ssc_result, hsc_result, program, semester, photo, certificate)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssssss", $name, $dob, $gender, $nationality, $email, $phone, $address, $ssc, $hsc, $program, $semester, $photoPath, $certPath);

if ($stmt->execute()) {
    echo "<h2>Application submitted successfully!</h2><a href='apply_online.php'>Go Back</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
