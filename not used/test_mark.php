<?php
include 'db_connect.php';

// Fetch projects from project_list table
$sql_projects = "SELECT id, name, user_ids FROM project_list where manager_id = '{$_SESSION['login_id']}' ";
$result_projects = $conn->query($sql_projects);

// Fetch students and their previous marks for selected project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // Fetch students
    $sql_students = "SELECT id, CONCAT(firstname, ' ', lastname) as student_name FROM students WHERE FIND_IN_SET(id, (SELECT user_ids FROM project_list WHERE id = $project_id))";
    $result_students = $conn->query($sql_students);

    // Fetch previous marks for each student
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
    <title>Add Mark</title>
    <style>
        table {
            width: 70%;
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
    </style>
</head>
<body>

<h1>Add Mark</h1>

<form method="post" action="">
    Select Project: 
    <select name="project_id">
        <?php while($row = $result_projects->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Show Students">
</form>

<?php if(isset($result_students)) { ?>
    <form method="post" action="submit_marks.php">
        <table>
            <tr>
                <th>Student Name</th>
                <th>Previous Marks</th>
                <th>New Mark</th>
            </tr>
            <?php while($row = $result_students->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo isset($previous_marks[$row['id']]) ? $previous_marks[$row['id']] : '-'; ?></td>
                    <td><input type="number" name="marks[<?php echo $row['id']; ?>]" min="0" max="100" required></td>
                </tr>
            <?php } ?>
        </table>
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <input type="submit" value="Submit Marks">
    </form>
<?php } ?>

</body>
</html>
