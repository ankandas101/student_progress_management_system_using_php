<?php
include 'db_connect.php';

// Fetch projects from project_list table
$where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 1){
      $where = " ";
    }
    
$sql_projects = "SELECT id, name FROM project_list $where";
$result_projects = $conn->query($sql_projects);

// Initialize variables
$project_id = null;
$marks_data = array();
$course_title = null;

$cls_semester = null;
$cls_sec = null;
$cls_year = null;
$cls_id = null;

$selected_project_name = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    // Fetch selected project name
    $sql_selected_project = "SELECT name FROM project_list WHERE id = $project_id";
    $result_selected_project = $conn->query($sql_selected_project);
    $row_selected_project = $result_selected_project->fetch_assoc();
    $selected_project_name = $row_selected_project['name'];

    // Fetch course title for selected project
    $sql_course_title = "SELECT c.course_title 
                         FROM project_list pl 
                         JOIN course c ON pl.course_ids = c.id 
                         WHERE pl.id = $project_id";
    $result_course_title = $conn->query($sql_course_title);
    $row_course_title = $result_course_title->fetch_assoc();
    $course_title = $row_course_title['course_title'];



            // Fetch Class p-c-cls
            $sql_cls_id = "SELECT cs.class_id 
            FROM project_list pl 
            JOIN course cs ON pl.course_ids = cs.id 
            WHERE pl.id = $project_id";
            $result_cls_id = $conn->query($sql_cls_id);
            $row_cls_id = $result_cls_id->fetch_assoc();
            $cls_id = $row_cls_id['class_id'];

            $cls_qry = $conn->query("SELECT *FROM class where id =$cls_id");
				while($cls= $cls_qry->fetch_assoc()): 
                    $cls_semester = $cls['semester'];
                    $cls_sec = $cls['sec'];
                    $cls_year = $cls['year'];
                endwhile;



    // Fetch marks for selected project in ascending order by s_id
    $sql_marks = "SELECT s.s_id, CONCAT(s.firstname, ' ', s.lastname) as student_name, g.mark 
                  FROM students s 
                  JOIN marks g ON s.id = g.student_id 
                  WHERE g.project_id = $project_id 
                  ORDER BY s.s_id ASC";
    $result_marks = $conn->query($sql_marks);

    while ($row = $result_marks->fetch_assoc()) {
        $marks_data[] = $row;
    }
}
?>

     

<!DOCTYPE html>
<html>
<head>
    <title>Team Marksheet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .course-title, .selected-project {
            font-size: 20px;
            margin-top: 0px;
            margin-left: 100px;
            text-align: left;
        }
        .card{
            margin-top:20px;
        }
        .btn-print{
            align:right;
        }
        .select-team {
    word-wrap: normal;
    padding-left: 5px;
    padding-right: 10px;
    width: 30%;
    height: 40px;
}
.select-team-l{

}
.team-selection{
    display: block;
}
    </style>
</head>
<body>
<div class="team-selection" >
<form method="post" action="" >
 <!--    <lable class="control-label"> Select Team</lable> -->
    <select name="project_id" class="select-team">
        <option value="" disabled selected> Select your Team </option>

        <?php while($row = $result_projects->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>" <?php echo ($project_id == $row['id']) ? 'selected' : ''; ?>><?php echo $row['name']; ?></option>
        <?php } ?>
    </select>
    <input type="submit" class="btn btn-flat  bg-gradient-primary" value="Show Marks">

    <button class="btn btn-flat btn-sm bg-gradient-success btn-success " id="btn-print" onclick="window.print()">  <i class="fa fa-print"></i> Print</button> <br>
    
</form>
        </div>
    
<div class="card card-outline card-success" id="printable">
<div class="card-header">

<?php if ($project_id && count($marks_data) > 0) { ?>

    <!-- Class Info -->
   <div class="course-title">Class: <?php echo  $cls_semester ?>  <?php echo  $cls_year ?>    <?php echo  $cls_sec ?> </div>
   <div class="course-title">Course Title: <?php echo $course_title; ?></div>
   <div class="selected-project">Team: <?php echo $selected_project_name; ?></div>



    <table>
        <tr>
            <th>Student Full Name</th>
            <th>Student ID</th>
            <th>Marks</th>
        </tr>
        <?php foreach($marks_data as $mark) { ?>
            <tr>
                <td><?php echo $mark['student_name']; ?></td>
                <td><?php echo $mark['s_id']; ?></td>
                <td><?php echo $mark['mark']; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } elseif ($project_id) { ?>
    <p>No marks found for selected project.</p>
<?php } ?>
</div>
</div>
</body>
<script>
	btn-print.click(function(){
	
    .team-selection{
    display: none;
    }
	})
</script>
</html>
