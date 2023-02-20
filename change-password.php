<?php
$page_title = "Change Password";
$rank = "Faculty Admin";
set_time_limit(60);
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/faculty-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])){
	header("Location: https://localhost/scheduler/");
}
else{
?>

	<section class="change-password">
		<h2>Change Password</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/faculty-functions.php");
	$resourceClass = new resourceAccess;
	
	if(isset($_POST['submit'])){
		$resourceClass->change_password($_POST['old'], $_POST['new'], $_POST['renew']);
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<label>Old Password:</label><br>
			<input type="password" name="old" class="new" /><br>
			<label>New Password:</label><br>
			<input type="password" name="new" class="new" /><br>
			<label>Retype Password:</label><br>
			<input type="password" name="renew" class="renew" /><br>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>