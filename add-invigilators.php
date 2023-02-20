<?php
$page_title = "Add Invigilators";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] == "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="add-invig">
		<h2>Add Invigilators</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/departmental-functions.php");
	$dataAccess = new acquireAccess;
	
	if(isset($_POST['submit'])){
		$dataAccess->add_invigilator($_POST['title'], $_POST['name']);
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<section class="invig-title-area">
				<label>Title:</label><br>
				<select class="title" name="title">
					<option value="">--Title--</option>
					<option value="Prof.">Prof.</option>
					<option value="Dr.">Dr.</option>
					<option value="Mr.">Mr.</option>
					<option value="Mrs.">Mrs.</option>
				</select>
			</section>
			<label>Name:</label><br>
			<input type="text" name="name" class="name" /><br>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>