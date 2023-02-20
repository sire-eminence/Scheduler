<?php
$page_title = "Delete Administrator";
$rank = "Faculty Admin";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/faculty-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] != "Faculty"){
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
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/faculty-functions.php");
		$resourceClass = new resourceAccess;
		
		$resourceClass->delete_admin($_GET['id']);
?>	
		</p> <br>
		<button class="go-back">Go Back</button>
	</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>