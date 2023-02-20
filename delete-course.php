<?php
$page_title = "Registered Courses";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] == "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else if(!isset($_GET['id'])){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<div class="del-notify">
		<p class="resp">
<?php
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/departmental-functions.php");
		$dataAccess = new acquireAccess;
		
		$dataAccess->delete_course($_GET['id']);
?>	
		</p> <br>
		<button class="go-back">Go Back</button>
	</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>