<!DOCTYPE html>
<html>
<head>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">


<?php 
   include 'db_connect.php';
   include 'header.php';
   // Fetch projects from project_list table
   $where = "";
   $course_type ='';
   if($_SESSION['login_type'] == 2){
     $where = " where manager_id = '{$_SESSION['login_id']}' ";
   }elseif($_SESSION['login_type'] == 1){
     $where = "";
   }else{
           $URL="index.php";
           echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL .'">';
   }
   $sql_projects = "SELECT id, name, user_ids FROM project_list  $where "; //where manager_id = 2
   $result_projects = $conn->query($sql_projects);

// Fetch students for selected project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    $sql = "SELECT id,s_id, firstname, lastname FROM students 
    WHERE FIND_IN_SET(id, (SELECT user_ids FROM project_list WHERE id = $project_id))
    ORDER BY s_id ASC";
    $result = $conn->query($sql);

    $sql_course_type= "SELECT c.type 
                         FROM project_list pl 
                         JOIN course c ON pl.course_ids = c.id 
                         WHERE pl.id = $project_id";
    $result_course_type = $conn->query($sql_course_type);
    $row_course_type= $result_course_type->fetch_assoc();
    $course_type = $row_course_type['type'];
}
 ?>

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

    <?php if(isset($result)) { ?>

    <div  class="marks-form">
        <form action="add_exam.php" method="post">
            <div class="form-group">
                <label for="exam_title">Exam Title:</label>
					<select id="exam_title" name="exam_title">
					
					<?php if($course_type ==1): ?> <!-- if THeory -->
						<option value="mid">MID</option> 
						<option value="ct_1">CT 1</option>
						<option value="ct_2">CT 2</option>
						<option value="ct_3">CT 3</option>
						<option value="ct_4">CT 4</option>
						
						 <?php elseif($course_type ==2): ?> <!-- if lab -->
						<option value="lab_1">Lab 1</option>
						<option value="lab_2">lab 2</option>
						<option value="lab_3">lab 3</option>
						<option value="lab_4">lab 4</option>
                        <option value="lab_5">lab 5</option>
                        <option value="lab_6">lab 6</option>
					<?php endif; ?>
						<!-- Add other exam names here -->
					</select><br><br>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Students List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Display students in table
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['s_id'] . "</td>";
                                    echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
                                    echo "<td><input type='number' name='student_marks[" . $row['id'] . "]' class='form-control' required></td>";
                                    echo "</tr>";
                                }
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <button class="my-btn btn cancel-btn" onclick="window.location.href='index.php?page=add_mark' ">Cancel</button>
    <?php } ?>

</div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
