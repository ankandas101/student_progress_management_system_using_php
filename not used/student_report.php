<?php include'db_connect.php' ?>
<?php include 'topbar.php' ?>
  <?php include 'sidebar.php' ?>
  <?php include 'footer.php' ?>

  <?php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Form data
        $student_name = $_POST['student_name'];
        $subject = $_POST['subject'];
        $marks = $_POST['marks'];

        // Insert data into database
        $sql = "INSERT INTO student_marks (student_name, subject, marks) VALUES ('$student_name', '$subject', $marks)";

        if ($conn->query($sql) === TRUE) {
            echo "Marks inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>


<div class="card card-outline card-success">
          <div class="card-header">
            <b>Stuent Marks Report</b>
            <button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Print</button>
        <div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Student ID</th>
						<th>Marks</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Instructor","Student");
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM marks order by concat(firstname,' ',lastname) asc");
					while($row= $qry->fetch_assoc()): 
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo ucwords($row['s_id']) ?></b></td>
						<td><b><?php echo $row['mark'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_user&id=<?php echo $row2['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
	    </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
	_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>