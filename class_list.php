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
						<th class="text-center">SL</th>
						<th>Department</th>
                        <th>Year</th>
						<th>Semistar</th>
						<th>Section </th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$dpt = array("N/A","CSE","EEE","CE");
					$qry = $conn->query("SELECT *FROM class order by year DESC");
					while($row= $qry->fetch_assoc()): 
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
                        <td><b><?php echo $dpt[$row['dept']] ?></b></td>
						<td><b><?php echo ucwords($row['year']) ?></b></td>
						<td><b><?php echo ucwords($row['semester']) ?></b></td>
						<td><b><?php echo ucwords($row['sec']) ?></b></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <?php if($_SESSION['login_type'] == 1): ?>
		                      <a class="dropdown-item" href="./index.php?page=edit_class&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_class" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                  <?php endif; ?>
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
	$('.delete_course').click(function(){
	_conf("Are you sure to delete this user?","delete_class",[$(this).attr('data-id')])
	})
	})
	function delete_class($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_class',
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