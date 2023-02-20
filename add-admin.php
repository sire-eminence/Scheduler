<?php
$page_title = "Add Administrator";
$rank = "Faculty Admin";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/faculty-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] != "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>

	<section class="add-admin">
		<h2>Add Administrator</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/faculty-functions.php");
	$resourceClass = new resourceAccess;
	
	if(isset($_POST['submit'])){
		$resourceClass->add_admin($_POST['username'], $_POST['password'], $_POST['department']);
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<label>Administrator's Username:</label><br>
			<input type="text" name="username" class="username" /><br>
			<label>Administrator's Password:</label><br>
			<input type="password" name="password" class="password" /><br>
			<label>Administrator's Department:</label><br>
			<select name="department" class="department">
				<option value="">---Department---</option>
				<option value="Computer Science">Computer Science</option>
				<option value="Geology">Geology</option>
				<option value="Geophysics">Geophysics</option>
				<option value="Industrial Chemistry">Industrial Chemistry</option>
				<option value="Industrial Physics">Industrial Physics</option>
				<option value="Mathematics">Mathematics</option>
				<option value="Statistics">Statistics</option>
			</select><br>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>