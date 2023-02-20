<?php
$page_title = "List of Administrators";
$rank = "Faculty Admin";
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/faculty-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] != "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>
	<section class="list-admin">
		<table>
			<thead>
				<tr><th>S/N</th> <th>Administrator's Username</th> <th>Administrator's Department</th> <th>Date Added</th> <th>Action</th></tr>
			</thead>
			<tbody>
		
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/faculty-functions.php");
	$resourceClass = new resourceAccess;
	
	$resourceClass->list_admins();
	?>
			</tbody>
		</table>
	</section>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>