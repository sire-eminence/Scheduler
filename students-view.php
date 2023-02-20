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
	<title>Timetable</title>
	<link rel="icon" type="image/png" href="https://localhost/scheduler/images/uniziklogo.png" />
	<link rel="stylesheet" href="https://localhost/scheduler/css/style.css" />
</head>
<body>
	<section class="cover new-cover">
		<div class="inner-cover new-inner-cover">
			<p class="logo"><img src="https://localhost/scheduler/images/uniziklogo.png"/> </p>
			<p class="school-name">Nnamdi Azikiwe University, Awka</p>
			
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/view-timetable.php");
	$seeTimetable = new viewTimetable;
	
	$seeTimetable->studentView();
?>
		<p><br> <button class="go-back">Go Back</button> <br> <br></p>
		</div>
	</section>

	<script type="text/javascript" src="https://localhost/scheduler/javascript/script.js"></script>
</body>
</html>
