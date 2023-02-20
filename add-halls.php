<?php
$page_title = "Add Halls";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] == "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="add-hall">
		<h2>Add Halls</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/departmental-functions.php");
	$dataAccess = new acquireAccess;
	
	if(isset($_POST['submit'])){
		$dataAccess->add_halls($_POST['name'], $_POST['capacity']);
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<label>Hall Name:</label><br>
			<input type="text" name="name" class="name" /><br>
			<label>Hall Capacity:</label><br>
			<input type="text" name="capacity" class="capacity" /><br>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>