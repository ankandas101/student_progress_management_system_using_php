<?php
ob_start();
date_default_timezone_set('Asia/Dhaka');

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}

if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_admin'){
	$save = $crud->save_admin();
	if($save)
		echo $save;
}
if($action == 'delete_admin'){
	$save = $crud->delete_admin();
	if($save)
		echo $save;
}
if($action == 'save_instractor'){
	$save = $crud->save_instractor();
	if($save)
		echo $save;
}
if($action == 'update_instractor'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_instractor'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}



if($action == 'save_class'){
	$save = $crud->save_class();
	if($save)
		echo $save;
}
if($action == 'delete_class'){
	$save = $crud->delete_class();
	if($save)
		echo $save;
}

if($action == 'save_project'){
	$save = $crud->save_project();
	if($save)
		echo $save;
}


if($action == 'delete_project'){
	$save = $crud->delete_project();
	if($save)
		echo $save;
}
if($action == 'save_course'){
	$save = $crud->save_course();
	if($save)
		echo $save;
}

if($action == 'delete_course'){
	$save = $crud->delete_course();
	if($save)
		echo $save;
}


if($action == 'save_task'){
	$save = $crud->save_task();
	if($save)
		echo $save;
}
if($action == 'delete_task'){
	$save = $crud->delete_task();
	if($save)
		echo $save;
}
if($action == 'save_progress'){
	$save = $crud->save_progress();
	if($save)
		echo $save;
}
if($action == 'delete_progress'){
	$save = $crud->delete_progress();
	if($save)
		echo $save;
}

if($action == 'get_report'){
	$get = $crud->get_report();
	if($get)
		echo $get;
}
ob_end_flush();
?>
