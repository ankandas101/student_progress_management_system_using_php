<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_instractor"><i class="fa fa-plus"></i> Add New Instractor</a>
			</div>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="export.php"><i class="fa fa-plus"></i> Export</a>
			</div>

		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Department</th>
						<th>Designation</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$designation = array('',"Professor","Assistant Professor","Senior Lecturer","Lecturer");
					$dept = array('',"CSE","EEE","CE");
					$qry = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM instructors order by designation asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><b><?php echo ucwords($row['name']) ?></b></td>
						<td><b><?php echo $dept[$row['dept']] ?></b></td>
						<td><b><?php echo $designation[$row['designation']] ?></b></td>
						<td><b><?php echo $row['email'] ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_instractor" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_instractor&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_instractor" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
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
	$('.view_instractor').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> User Details","view_instractor.php?id="+$(this).attr('data-id'))
	})
	$('.delete_instractor').click(function(){
	_conf("Are you sure to delete this user?","delete_instractor",[$(this).attr('data-id')])
	})
	})
	function delete_instractor($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_instractor',
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