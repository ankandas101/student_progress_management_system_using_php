<?php
include 'db_connect.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id']) && isset($_POST['marks'])) {
    $project_id = $_POST['project_id'];
    $marks = $_POST['marks'];

    // Fetch students with s_id
    $sql_students = "SELECT id, s_id, CONCAT(firstname, ' ', lastname) as student_name FROM students";
    $result_students = $conn->query($sql_students);
    $student_info = array();
    while ($row = $result_students->fetch_assoc()) {
        $student_info[$row['id']] = array('s_id' => $row['s_id'], 'student_name' => $row['student_name']);
    }

    // Fetch previous marks for selected project
    $sql_previous_marks = "SELECT student_id, mark FROM marks WHERE project_id = $project_id";
    $result_previous_marks = $conn->query($sql_previous_marks);
    $previous_marks = array();
    while ($row = $result_previous_marks->fetch_assoc()) {
        $previous_marks[$row['student_id']] = $row['mark'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .card{
            margin-top:20px;
            margin-left:20px;
            width: 90%;
        }
        .submit-btn{
            float:right;
            font-size: 18px;
            border-radius: 5px;
            
        }
        .cancel-btn{
            font-size: 18px;
            color: white;
            background-color: red;
        }
        
        form{
            width: 80%;
        }
    </style>
</head>
<body>
<div class="card card-outline card-success">
<div class="card-header">
<h2>Review and Confirm Marks</h2>

<div>
    <form method="post" action="submit_marks.php">
        <table>
            <tr>
                <th>Student Full Name</th>
                <th>Student ID</th>
                <th>Previous Marks</th>
                <th>New Mark</th>
            </tr>
            <?php foreach($marks as $student_id => $new_mark) { ?>
                <tr>
                    <td><?php echo $student_info[$student_id]['student_name']; ?></td>
                    <td><?php echo $student_info[$student_id]['s_id']; ?></td>
                    <td><?php echo isset($previous_marks[$student_id]) ? $previous_marks[$student_id] : '-'; ?></td>
                    <td><?php echo $new_mark; ?></td>
                    <input type="hidden" name="marks[<?php echo $student_id; ?>]" value="<?php echo $new_mark; ?>">
                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                    
                </tr>
            <?php } ?>
        </table>
        <input type="submit" class="btn submit-btn  bg-gradient-primary mx-2" value="Confirm">
    </form>
    <button class="btn cancel-btn" onclick="window.location.href='index.php?page=add_mark' ">Cancel</button>
    
</div>
  </div>
</body>
</html>
