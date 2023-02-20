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
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
	<meta name="charset" content="UTF-8" />
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
	<title><?=$page_title;?></title>
	<link rel="icon" type="image/png" href="https://localhost/scheduler/images/uniziklogo.png" />
	<link rel="stylesheet" href="https://localhost/scheduler/css/style.css" />
</head>
<body>
	<section class="container">
		<section class="leftbar">
			<div class="logo-area">
				<p><img src="https://localhost/scheduler/images/uniziklogo.png"/></p>
				<h3>NNAMDI AZIKIWE UNIVERSITY <br>EXAM TIMETABLE SCHEDULER</h3>
			</div>
			<div class="menu">
				<a href="https://localhost/scheduler/add-admin">
					<p>
						<img src="https://localhost/scheduler/images/pencil.png" />
						<span>Add Administrator</span>
					</p>
				</a>
				<a href="https://localhost/scheduler/list-admin">
					<p>
						<img src="https://localhost/scheduler/images/list.png" />
						<span>List of Administrators</span>
					</p>
				</a>
				<a href="https://localhost/scheduler/add-schedule">
					<p>
						<img src="https://localhost/scheduler/images/add.png" />
						<span>Schedule Timetable</span>
					</p>
				</a>
				<a href="https://localhost/scheduler/admin-view">
					<p>
						<img src="https://localhost/scheduler/images/eye.png" />
						<span>View Timetable</span>
					</p>
				</a>
				<a href="https://localhost/scheduler/change-password">
					<p>
						<img src="https://localhost/scheduler/images/padlock.png" />
						<span>Change Password</span>
					</p>
				</a>
				<a href="https://localhost/scheduler/logout">
					<p>
						<img src="https://localhost/scheduler/images/out.png" />
						<span>Logout</span>
					</p>
				</a>
			</div>
		</section>
		<section class="mainbar">
			<div class="desc">
				<p><b><?=$page_title;?></b></p>
				<p><img src="https://localhost/scheduler/images/avatar.png" /> <span><?=$rank;?></span> </p>
			</div>
			
			<div class="body-result">