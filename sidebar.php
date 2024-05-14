  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="./" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <?php elseif($_SESSION['login_type'] == 2): ?>
        <h3 class="text-center p-0 m-0"><b>Instructor</b></h3>
        <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>Student</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Classes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_class" class="nav-link nav-new_class tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>New Class</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=class_list" class="nav-link nav-class_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Class List</p>
                </a>
              </li>
            </ul>
         </li> 
         <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Teams
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_team" class="nav-link nav-new_team tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=team_list" class="nav-link nav-team_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Team List</p>
                </a>
              </li>

            </ul>
         </li> 
          <li class="nav-item">
                <a href="./index.php?page=task_list" class="nav-link nav-task_list">
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Task</p>
                </a>
          </li>
          <?php if($_SESSION['login_type'] != 3): ?>
            
          <!--report -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="fas fa-th-list nav-icon"></i>
              <p>
              Report
                <i class="right fas fa-angle-left" class="nav-link nav-reports"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="./index.php?page=reports" class="nav-link nav-reports">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Teams Progress</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="./index.php?page=add_mark" class="nav-link nav-add_mark nav-reports">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Mark</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="./final_marksheet.php" class="nav-link nav-final_marksheet nav-reports">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View Marksheet</p>
                </a>
              </li>
             
            </ul>
          </li>
          <!--report -->

          <?php endif; ?>
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Student</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="./index.php?page=new_instractor" class="nav-link nav-new_instractor tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Instructor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=instractor_list" class="nav-link nav-instractor_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Instructor List</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>View All Student</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=new_admin" class="nav-link nav-new_admin tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Admin</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="./index.php?page=admin_list" class="nav-link nav-admin_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>All Admin</p>
                </a>
              </li>
            
            
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_course">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Course
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_course" class="nav-link nav-new_course tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="./index.php?page=course_list" class="nav-link nav-course_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
		
		<li class="nav-item">
            <a href="about.php" class="nav-link">
              <i class="nav-icon fas fa-solid fa-info"></i>
              <p>
                About
                <i class="right fas"></i>
              </p>
            </a>
            
          </li>
          
		
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>