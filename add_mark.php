<?php 
include 'db_connect.php';
include 'header.php';
// Fetch projects from project_list table
    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 1){
      $where = " ";
    }else{
            $URL="index.php";
            echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL .'">';
    }

$sql_projects = "SELECT id, name, user_ids FROM project_list $where ";
$result_projects = $conn->query($sql_projects);


// Fetch students for selected project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // Fetch students sorted by s_id in ascending order
    $sql_students = "SELECT id, CONCAT(firstname, ' ', lastname) as student_name, s_id 
                     FROM students 
                     WHERE FIND_IN_SET(id, (SELECT user_ids FROM project_list WHERE id = $project_id))
                     ORDER BY s_id ASC";
    $result_students = $conn->query($sql_students);

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
    <title>Add Mark</title>
    <style>
        .card{
            width: 90%;
        }
        .marks-form{
            width: 90%;
            text-align: center;
        }
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
        .mt-btn{
            font-size: 18px;
        }
        .cancel-btn {
            color: white;
            background-color: red;
            margin-right: 30px;
        }
        .submit-btn:hover{
        background-color: red;
        }
        .select-team {
            word-wrap: normal;
            padding-left: 5px;
            padding-right: 10px;
            width: 30%;
            height: 40px;
    }
    
    .team-selection{
        display: block;
    }
    </style>
</head>
<body>

<div class="card card-outline card-success">
<div class="card-header">
    <div class="team-selection" >
        <form method="post" action="">
            
            <select name="project_id" class="select-team">
            <option value="" class="control-label" selected disabled>Select Team</option>
                <?php while($row = $result_projects->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <input type="submit" class="btn btn-flat  bg-gradient-primary" value="Show Students">
        </form>
    </div>
<?php if(isset($result_students)) { ?>

    <div  class="marks-form">
    <form method="post" action="confirm_marks.php">
        <table>
            <tr>
                <th>Student Full Name</th>
                <th>Student ID</th>
                <th>Previous Marks</th>
                <th>New Mark</th>
            </tr>
            <br>
            
            <!-- Title:
            <input type="text" name="notes" required value="<?php echo isset($notes) ? $notes : '' ?>">  
            -->
              <?php while($row = $result_students->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['student_name']; ?></td>
                    <td><?php echo $row['s_id']; ?></td>
                    <td><?php echo isset($previous_marks[$row['id']]) ? $previous_marks[$row['id']] : '-'; ?></td>
                    <td><input type="number" name="marks[<?php echo $row['id']; ?>]" min="-100" max="100" required></td>
                </tr>
            <?php } ?>
        </table>
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
    
        <button class="my-btn btn cancel-btn" onclick="window.location.href='index.php?page=add_mark' ">Cancel</button>
            
        <input type="submit" class="my-btn btn bg-gradient-primary submit-btn" value="Submit Marks">

    </form>
    </div>
<?php } ?>
</div>
</div>
</body>
</html>
