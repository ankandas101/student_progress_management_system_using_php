<?php if(!isset($conn)){ include 'db_connect.php'; }


$sec = null;
$semester  = null;
?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
		<form action="" id="manage-class">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Year</label>
					<input type="text" class="form-control form-control-sm" name="year" value="<?php echo isset($year) ? $year : '' ?>">
				</div>
			</div>

            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Department</label>
                    <select name="dept" id="dept" class="custom-select custom-select-sm">
						<option value="1" <?php echo isset($dept) && $dept == 1 ? 'selected' : '' ?>>CSE</option>
						<option value="2" <?php echo isset($dept) && $dept == 2 ? 'selected' : '' ?>>EEE</option>
                        <option value="3" <?php echo isset($dept) && $dept == 3 ? 'selected' : '' ?>>CE</option>
                    </select>	
                
                </div>
			</div>
        </div>

        <div class="row">
			<div class="col-md-6">
				<div class="form-group">
				    <label for="">Semester</label>
                    <select name="semester" id="semester" class="custom-select custom-select-sm">
						<option value="Spring" <?php echo isset($semester) && $semester == Spring ? 'selected' : '' ?>>Spring</option>
						<option value="Fall" <?php echo isset($semester) && $semester == Fall ? 'selected' : '' ?>>Fall</option>
                        <option value="Summer" <?php echo isset($semester) && $semester == Summer? 'selected' : '' ?>>Summer</option>
                        </select>
				</div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Section </label>
                    <select name="sec" id="sec" class="custom-select custom-select-sm">
                            <option value="A" <?php echo isset($sec) && $sec == A ? 'selected' : '' ?>> A </option>
                            <option value="B" <?php echo isset($sec) && $sec == B ? 'selected' : '' ?>> B </option>
                            <option value="C" <?php echo isset($sec) && $sec == C ? 'selected' : '' ?>> C </option>
                            <option value="D" <?php echo isset($sec) && $sec == D ? 'selected' : '' ?>> D </option>
                            <option value="E" <?php echo isset($sec) && $sec == E ? 'selected' : '' ?>> E </option>
                    </select>
                </div>
			</div>

		</div>

   
         <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Students</label>
              <select class="form-control form-control-sm select2" multiple="multiple" name="student_ids[]">
              	<option></option>
              	<?php 
              	$students = $conn->query("SELECT *,concat(firstname,' ',lastname,' - ',s_id) as name FROM students order by concat(firstname,' ',lastname,' - ',s_id) asc ");
              	while($row= $students->fetch_assoc()):
              	?>
              	<option value="<?php echo $row['id'] ?>" <?php echo isset($student_ids) && in_array($row['id'],explode(',',$student_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
              	<?php endwhile; ?>
              </select>
            </div>
         
        </div>


        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-class">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=class_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-class').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_class',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=class_list'
					},2000)
				}
			}
		})
	})
</script>