<?php
$page_title = "Timetable";
$rank = "Faculty Admin";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="admin-view">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/view-timetable.php");
	$seeTimetable = new viewTimetable;
	
	$seeTimetable->adminView();
	?>
	</section>
	
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>