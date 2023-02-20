<?php
$page_title = "Registered Courses";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/departmental-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] == "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="registered-courses">
		<table>
			<thead>
				<tr><th>S/N</th> <th>Course Code</th> <th>Course Title</th> <th>Credit Load</th> <th>Level</th> <th>Num. of Students</th> <th>Departments</th> <th>Date Added</th> <th>Action</th></tr>
			</thead>
			<tbody>
		
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/departmental-functions.php");
	$dataAccess = new acquireAccess;
	
	$dataAccess->registered_courses($_SESSION['user_role']);
	?>
			</tbody>
		</table>
	</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>