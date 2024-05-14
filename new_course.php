<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
		<form action="" id="manage-course">

			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Course Title</label>
						<input type="text" class="form-control form-control-sm" name="course_title" value="<?php echo isset($course_title) ? $course_title : '' ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Course Code</label>
						<input type="text" class="form-control form-control-sm" name="course_code" value="<?php echo isset($course_code) ? $course_code : '' ?>">
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

				<div class="col-md-6">
					<div class="form-group">
						<label for="">Type</label>
						<select name="type" id="type" class="custom-select custom-select-sm">
							<option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Theory</option>
							<option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Seasonal</option>
							</select>
					</div>
				</div>
				

			</div>
	
			<div class=row>

			<div class="col-md-6">
				<div class="form-group">
				    <label for="">Course Credits</label>
                    <input type="double" class="form-control form-control-sm" name="course_credits" value="<?php echo isset($course_credits) ? $course_credits : '' ?>">
				</div>
            </div>


			<div class="col-md-6">
				<div class="form-group">
				<label for="" class="control-label">Class</label>
				<select class="form-control form-control-sm select2" name="class_id">
				<option></option>
					<?php 
					$classes = $conn->query("SELECT *,concat(semester,' ',year,' - ',sec) as cls FROM class order by semester asc ");
					while($row= $classes->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['cls']) ?></option>
					<?php endwhile; ?>
					</select>
            	</div>
          	</div>

			<div class="col-md-6">
				<div class="form-group">
				<label for="" class="control-label">Course Instructor</label>
				<select class="form-control form-control-sm select2" name="manager_id">
					<option></option>
					<?php 
					$managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM instructors order by concat(firstname,' ',lastname) asc ");
					while($row= $managers->fetch_assoc()):
					?>
					<option value="<?php echo $row['id'] ?>" <?php echo isset($manager_id) && $manager_id == $row['id'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
					<?php endwhile; ?>
				</select>
				</div> 
			</div>
		</div>
        </form>
    	</div>

    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-course">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=course_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-course').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_course',
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
						location.href = 'index.php?page=course_list'
					},2000)
				}
			}
		})
	})
</script>