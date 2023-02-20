<?php
session_name('scheduler');
error_reporting(0);
header_remove('X-Powered-By');
date_default_timezone_set("Africa/Lagos");
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
session_regenerate_id();
ob_start();

if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])){
	if($_SESSION['user_role'] == "Faculty"){
		header("Location: https://localhost/scheduler/add-admin");
	}
	else{
		header("Location: https://localhost/scheduler/add-courses");
	}
}
else{
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<meta name="charset" content="UTF-8" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
	<title>Timetable Scheduler</title>
	<link rel="icon" type="image/png" href="https://localhost/scheduler/images/uniziklogo.png" />
	<link rel="stylesheet" href="https://localhost/scheduler/css/style.css" />
</head>
<body>
	<section class="cover">
		<div class="inner-cover">
			<p class="logo"><a href="https://localhost/scheduler/"><img src="https://localhost/scheduler/images/uniziklogo.png"/></a> </p>
			<p class="school-name">Nnamdi Azikiwe University, Awka</p>
			<p class="proj-name">Examination Timetable Scheduling System</p>
			
			<section class="form-cover">
				<p class="al">Departmental Administrator's Login</p>
				
				<p class="resp">
<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/faculty-functions.php");
	$resourceClass = new resourceAccess;
	
	if(isset($_POST['submit'])){
		$resourceClass->login($_POST['username'], $_POST['password'], "Department");
	}
?>
				</p>
				<form method="POST" enctype="multipart/form-data">
					<label>Username:</label><br>
					<input type="text" name="username" class="username" /><br>
					<label>Password:</label><br>
					<input type="password" name="password" class="password" /><br>
					<button name="submit" class="submit">Submit</button>
				</form>
				
				<p class="loglink"><a href="https://localhost/scheduler/faculty-admin-login">Login as Faculty Administrator</a></p>
			</section>
		</div>
	</section>
</body>
</html>
<?php
}
?>