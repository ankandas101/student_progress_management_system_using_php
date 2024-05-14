<?php include 'topbar_2.php' ?>
<style>
.about-content{
margin-left:10%;
width: 80%;
text-align: justify;

}
 p h3 {
	margin-top:4px;
 }
 p {
	font-size: 16;
 }
.main-footer {
color: #fff;
text-align:center;
background-color: #101010;
margin-bottom: 0px;
padding-top:20px;
padding-bottom:5px;
}
.main-footer a{
	text-decoration: none;
    color:rgb(224, 14, 214);
}

</style>

<div class="about-content">
	<h2><br>Project: Student Progress Management System</h2>

	<h3>About the Project: </h3>
	<p>
	The Student Progress Management System is a simple project that can help a teacher to manage her/his project progress.<br>
	The system has 3 types of system users which are the Admin, Project Instractor, and Student. <br>
	The Admin user has an access to all of the data stored in the database of the system especially on creating and managing system users. 
	The Project Instractor are those users that manage the project details and progress under her/his team.<br>
	The Student will submit their work productivity in each task of the asign project.Student submit their start and end time range of their work on a certain task and this data will be calculated in the report as project members' work duration.
	</P>
	<br>
	<h3>Features:</h3>
		<ul types="circle">
			<li>Register & Login</li>
			<li>Dashboard</li>
			<li>3 type of User (CRUD Features)</li>
			<li>Team Create & asign Project</li>
			<li>Team Progress</li>
			<li>Marking through daily Progress </li>
			<li>Print Marksheet report </li>
		</ul>

	<br><h3>How the System Works:</h3>
	<img src="assets/pic/flow_ip.jpg" alt="flow chart of spms" style="width: 600px;"> 
	<img src="assets/pic/er_ip.jpg" style="width: 600px;"> 
	<p>
	<br>
	The Task Management System users can be only created by admin users. The admin user or the Project instructor will create a new team with some important details and assign the team member and instructor. 
	When creating a project, the admin or project Instractor must list all the Student that will handle the project's tasks.<br>
	The Project Management System was developed using HTML, PHP/MySQL, CSS, JavaScript (jQuery/Ajax), and Bootstrap for the design. Follow the username ans password below to exprence.
	</p><br>
	<h3>Admin Access:</h3>
	Email: ankan@admin<br>
	Password: ankan@admin <br>

	<h3>Instractor Access:</h3>
	Email: arr@ins<br>
	Password: arr@ins <br>

	<h3>Student Access:</h3>
	Email: pranto@std<br>
	Password: pranto@std<br>
	<br>
</div>

<footer class="main-footer">

	<strong>Copyright &copy; 2024 IP Project <a href="https://www.facebook.com/ankandas.fb" target="_blank">Ankan Das, Pranto Mallick, Faria Afrin Labonno</a>.</strong>
    All rights reserved. <br><br>
  </footer>