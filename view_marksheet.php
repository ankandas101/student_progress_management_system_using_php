<?php
include 'db_connect.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['project_id'])) {
    $project_id = $_GET['project_id'];

    // Fetch students, student IDs, and marks for selected project
    $sql = "SELECT s.s_id as s_id, CONCAT(s.firstname, ' ', s.lastname) as student_name, g.mark 
            FROM students s
            JOIN marks g ON s.id = g.student_id 
            WHERE g.project_id = $project_id 
            ORDER BY s_id ASC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marksheet</title>
    <style>
        .marks-form{
            text-align:center;
        }
        table {
            width: 80%;
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
        .print-btn {
            margin-top: 20px;
        }
        .custom-button {
    padding: 10px 15px;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    background-color: #007BFF;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-button:hover {
    background-color: #0056b3;
}
.card{
            margin-top:20px;
            margin-left:20px;
            width: 80%;
        }

    </style>
</head>
<body>
<div class="card card-outline card-success">
<div class="card-header">
<h2>Today's Marksheet</h2>
<?php
date_default_timezone_set('Asia/Dhaka');
echo "Current date and time: " . date("d-m-Y g:i A");
?>

<div class="marks-form">
    <table>
        <tr>
            <th>Student Full Name</th>
            <th>Student ID</th>
            <th>Marks</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['s_id']; ?></td>
                <td><?php echo $row['mark']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <button class="custom-button " onclick="window.print()"> Print <i class="fa fa-print"></i></button>

    <button class="custom-button " type="button" onclick="location.href = 'index.php?page=add_mark'"> Done </button>
    </div>
</div>
</div>
</body>
</html>
