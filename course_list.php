<?php include'db_connect.php' ?>
<?php include 'topbar.php' ?>
<?php include 'sidebar.php' ?>
<?php include 'footer.php' ?>
<div class="card card-outline card-success">
        <div class="card-header">
        <div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Course Title</th>
						<th>Course Code</th>
						<th>Course Credits</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$qry = $conn->query("SELECT *FROM course order by course_code asc");
					$type_crs = array('',"Theory","Seassonal");
					while($row= $qry->fetch_assoc()): 
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['course_title']) ?></b></td>
						<td><b><?php echo ucwords($row['course_code']) ?></b></td>
						<td><b><?php echo $row['course_credits'] ?></b></td>
						<td><b><?php echo $type_crs[$row['type']] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu">
							<?php if($_SESSION['login_type'] == 1): ?>
		                      <a class="dropdown-item" href="./index.php?page=edit_course&id=<?php echo $row['id'] ?>">Edit</a>
							  <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_course" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
							<?php endif?>
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
	$('.view_course').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_course.php?id="+$(this).attr('data-id'))
	})
	$('.delete_course').click(function(){
	_conf("Are you sure to delete this user?","delete_course",[$(this).attr('data-id')])
	})
	})
	function delete_course($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_course',
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