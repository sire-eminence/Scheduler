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

session_destroy();
	
session_regenerate_id();
	
header("Location: https://localhost/scheduler/");
?>