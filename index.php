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
	<title>Timetable Scheduling System</title>
	<link rel="icon" type="image/png" href="https://localhost/scheduler/images/uniziklogo.png" />
	<link rel="stylesheet" href="https://localhost/scheduler/css/style.css" />
</head>
<body>
    <section class="home-container">
        <section class="home-blind"></section>
        <section class="home-cover">
            <div class="h-left">
                <div class="trape"></div>
                <div class="home-logo">
                    <img src="https://localhost/scheduler/images/uniziklogo.png" alt="logo" />
                    <br>
                    <p>NNAMDI AZIKIWE UNIVERSITY, <br>AWKA ANAMBRA STATE</p>
                </div>
            </div>
            <div class="h-right">
                <h1>Timetable Scheduling System</h1>
				<p class="designer">By <br><br> Sire Eminence </p>
                <p> <a href="https://localhost/scheduler/login"> <button>Departmental Administrator</button> </a> </p>
                <p> <a href="https://localhost/scheduler/faculty-admin-login"> <button>Faculty Administrator</button> </a> </p>
                <p> <a href="https://localhost/scheduler/students-view"> <button>View Timetable</button> </a> </p>
            </div>
        </section>
    </section>
</body>
</html>
<?php
}
?>