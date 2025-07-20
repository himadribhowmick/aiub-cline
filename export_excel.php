<?php
$conn = new mysqli("localhost", "root", "", "aiub_admission");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=applications.xls");

echo "ID\tName\tDOB\tGender\tEmail\tPhone\tProgram\tSemester\tSubmitted\n";

$result = $conn->query("SELECT * FROM applications");
while ($row = $result->fetch_assoc()) {
    echo $row['id'] . "\t"
       . $row['name'] . "\t"
       . $row['dob'] . "\t"
       . $row['gender'] . "\t"
       . $row['email'] . "\t"
       . $row['phone'] . "\t"
       . $row['program'] . "\t"
       . $row['semester'] . "\t"
       . $row['submission_date'] . "\n";
}
$conn->close();
?>
