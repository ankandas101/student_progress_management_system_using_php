<?php
include 'db_connect.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id']) && isset($_POST['marks'])) {
    $project_id = $_POST['project_id'];
    $marks = $_POST['marks'];

    foreach ($marks as $student_id => $new_mark) {
        // Validate mark
        if ($new_mark >= -100 && $new_mark <= 100) {
            // Fetch existing mark for student and project
            $sql_existing_mark = "SELECT mark FROM marks WHERE student_id = $student_id AND project_id = $project_id";
            $result_existing_mark = $conn->query($sql_existing_mark);

            if ($result_existing_mark->num_rows > 0) {
                // Update existing mark
                $sql_update = "UPDATE marks SET mark = mark + $new_mark WHERE student_id = $student_id AND project_id = $project_id";
                if (!$conn->query($sql_update)) {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                // Insert new mark
                $sql_insert = "INSERT INTO marks (student_id, project_id,notes, mark) VALUES ($student_id, $project_id,$notes, $new_mark)";
                if (!$conn->query($sql_insert)) {
                    echo "Error inserting record: " . $conn->error;
                }
            }
        } else {
            echo "Invalid mark for student ID: " . $student_id;
        }
    }

    header("Location: view_marksheet.php?project_id=$project_id");
    exit();
} else {
    echo "Invalid request!";

    $URL="index.php?page=add_mark";
    echo '<META HTTP-EQUIV="refresh" content="1;URL=' . $URL .'">';

}
?>
