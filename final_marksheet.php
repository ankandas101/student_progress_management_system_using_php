<!DOCTYPE html>
<html>
<head>
    <title>Select Project and View Marksheet</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';
 ?>
    <div class="container">
        <h1>Select Project and View Marksheet</h1>
        <form action="" method="get">
            <div class="form-group">
                <label for="project_name">Select Project:</label>
                <select class="form-control" id="project_id" name="project_id">
                    <?php
                    // Include database connection script
                    include 'db_connect.php';

                    // Fetch project names and IDs from project_list table
                    $sql = "SELECT id, name FROM project_list";
                    $result = $conn->query($sql);

                    // Display project names in dropdown
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No projects found</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">View Marksheet</button>
			<a class="btn btn-secondary " href="./index.php">HOME</a> 
        </form>


        <?php
        // Check if project ID is selected
        if (isset($_GET['project_id'])) {
            $project_id = $_GET['project_id'];

            // Fetch project name based on selected project ID
            $sql_project = "SELECT name FROM project_list WHERE id = $project_id";
            $result_project = $conn->query($sql_project);

            if ($result_project->num_rows > 0) {
                $row_project = $result_project->fetch_assoc();
                $project_name = $row_project['name'];
                echo "<h2>Project: $project_name</h2>";

                // Fetch students data from exam_marks table based on selected project ID
                $sql_students = "SELECT students.s_id AS s_id, students.firstname, students.lastname, exam_marks.exam_title, exam_marks.marks 
                                FROM students 
                                LEFT JOIN exam_marks ON students.id = exam_marks.student_id
                                WHERE exam_marks.project_id = $project_id
                                ORDER BY students.id ASC";
                $result_students = $conn->query($sql_students);

                // Display students and their exam marks
                if ($result_students->num_rows > 0) {
                    // Initialize variables to track current student details
                    $current_student_id = null;
                    $current_student_name = null;
                    $student_marks = array();

                    echo '<table class="table table-bordered">';
                    echo '<thead><tr><th>Student ID</th><th>Student Name</th>';

                    // Fetch distinct exam titles for the selected project
                    $sql_exam_titles = "SELECT DISTINCT exam_title FROM exam_marks WHERE project_id = $project_id";
                    $result_exam_titles = $conn->query($sql_exam_titles);
                    if ($result_exam_titles->num_rows > 0) {
                        while ($row_exam_title = $result_exam_titles->fetch_assoc()) {
                            echo "<th>" . $row_exam_title['exam_title'] . "</th>";
                        }
                    }

                    echo "<th>Total Marks</th></tr></thead><tbody>";

                    // Display students and their exam marks
                    while ($row_students = $result_students->fetch_assoc()) {
                        $student_id = $row_students['s_id'];
                        $student_name = $row_students['firstname'] . " " . $row_students['lastname'];
                        $exam_title = $row_students['exam_title'];
                        $marks = $row_students['marks'];

                        // Check if student details have changed
                        if ($current_student_id !== $student_id) {
                            // If yes, display marks for the previous student (if any)
                            if ($current_student_id !== null) {
                                display_student_marks($current_student_id, $current_student_name, $student_marks);
                            }

                            // Reset variables for the new student
                            $current_student_id = $student_id;
                            $current_student_name = $student_name;
                            $student_marks = array();
                        }

                        // Store marks for the current student
                        $student_marks[$exam_title] = $marks;
                    }

                    // Display marks for the last student
                    display_student_marks($current_student_id, $current_student_name, $student_marks);

                    echo "</tbody></table>";
                } else {
                    echo "<p>No students found for this project.</p>";
                }
            } else {
                echo "<p>Invalid project ID selected.</p>";
            }
        } else {
            echo "<p>Please select a project from the dropdown above.</p>";
        }

        // Function to display marks for a student
        function display_student_marks($student_id, $student_name, $student_marks) {
            echo "<tr>";
            echo "<td>$student_id</td>";
            echo "<td>$student_name</td>";

            // Display marks for each exam title
            foreach ($student_marks as $marks) {
                echo "<td>$marks</td>";
            }

            // Calculate and display total marks for the student
            $total_marks = array_sum($student_marks);
            echo "<td>$total_marks</td>";
            echo "</tr>";
        }
        ?>

        <?php
        // Close database connection
        $conn->close();
        ?>
			
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
