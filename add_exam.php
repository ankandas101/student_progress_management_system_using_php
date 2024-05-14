<?php
// Include database connection script
include 'db_connect.php';

// Get exam details
$exam_title = $_POST['exam_title'];
$student_marks = $_POST['student_marks'];
$project_id = $_POST['project_id'];

// Insert exam details for each student
foreach ($student_marks as $student_id => $marks) {
    // Insert data into exam_marks table
    $sql = "INSERT INTO exam_marks (student_id, project_id, exam_title, marks) VALUES ($student_id, $project_id, '$exam_title', $marks)";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    $conn->close();
    echo "Marks details added successfully";
?>
<button class="btn btn-primary"  onclick="window.location.href='index.php' ">Home</button>