<?php
$page_title = "Add Courses";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] == "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="add-course">
		<h2>Add Course</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/departmental-functions.php");
	$dataAccess = new acquireAccess;
	
	if(isset($_POST['submit'])){
		$dataAccess->add_course($_POST['code'], $_POST['title'], $_POST['unit'], $_POST['level'], $_POST['sem'], $_POST['dept'], $_POST['num']);
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<label>Course Code:</label><br>
			<input type="text" name="code" class="code" /><br>
			<label>Course Title:</label><br>
			<input type="text" name="title" class="title" /><br>
			<label>Credit Unit:</label><br>
			<input type="text" name="unit" class="unit" /><br>
			<label>Level:</label><br>
			<select name="level" class="level">
				<option value="">---Level---</option>
				<option value="100">100</option>
				<option value="200">200</option>
				<option value="300">300</option>
				<option value="400">400</option>
			</select>
			<section class="semester-area">
				<label>Semester:</label><br>
				<select class="sem" name="sem">
					<option value="">--Semester--</option>
					<option value="1st">1st</option>
					<option value="2nd">2nd</option>
				</select>
			</section>
			<label>Departments Offering Course:</label><br>
			<div class="depts">
				<span><input type="checkbox" name="dept[]" value="Computer Science"/> Computer Science</span>
				<span><input type="checkbox" name="dept[]" value="Geology"/> Geology</span>
				<span><input type="checkbox" name="dept[]" value="Geophysics"/> Geophysics</span>
				<span><input type="checkbox" name="dept[]" value="Industrial Chemistry"/>Industrial Chemistry</span>
				<span><input type="checkbox" name="dept[]" value="Industrial Physics"/>Industrial Physics</span>
				<span><input type="checkbox" name="dept[]" value="Mathematics"/>Mathematics</span>
				<span><input type="checkbox" name="dept[]" value="Statistics"/>Statistics</span>
			</div>
			<label>Number of Students Offering the Course:</label><br>
			<input type="text" name="num" class="num" /><br>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>