<?php
$page_title = "Generate Timetable";
$rank = "Faculty Admin";
set_time_limit(60);
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/faculty-head.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] != "Faculty"){
	header("Location: https://localhost/scheduler/");
}
else{
?>

	<section class="gen-table">
		<h2>Generate Timetable</h2>
		<p class="resp">
	<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/schedule-timetable.php");
	$schedule = new scheduleTimetable;
	
	if(isset($_POST['submit'])){
		try{
			$schedule->schedule($_POST['ss'], $_POST['se'], $_POST['sy'], $_POST['sm'], $_POST['sd'], $_POST['ey'], $_POST['em'], $_POST['ed'], $_POST['sem']);
		}
		catch(Error $e){
			echo "An error occured. Please try again. ".$e;
		}
	}
	?>
		</p>
		
		<form method="POST" enctype="multipart/form-data">
			<label>Session:</label><br>
			<section class="session-area">
				<input type="text" name="ss" class="ss" placeholder="Session Start Year" />
				<p>/</p>
				<input type="text" name="se" class="se" placeholder="Session End Year" />
			</section>
			<section class="semester-area">
				<label>Semester:</label><br>
				<select class="sem" name="sem">
					<option value="">--Semester--</option>
					<option value="1st">1st</option>
					<option value="2nd">2nd</option>
				</select>
			</section>
			<section class="select-date">
				<section class="start-date">
					<label>Start Date:</label><br>
					<div>
					<select name="sd" class="sd">
						<option value="">--Day--</option><option value="01">1</option><option value="02">2</option>
						<option value="03">3</option><option value="04">4</option><option value="05">5</option>
						<option value="06">6</option><option value="07">7</option><option value="08">8</option>
						<option value="09">9</option><option value="10">10</option><option value="11">11</option>
						<option value="12">12</option><option value="13">13</option><option value="14">14</option>
						<option value="15">15</option><option value="16">16</option><option value="17">17</option>
						<option value="18">18</option><option value="19">19</option><option value="20">20</option>
						<option value="21">21</option><option value="22">22</option><option value="23">23</option>
						<option value="24">24</option><option value="25">25</option><option value="26">26</option>
						<option value="27">27</option><option value="28">28</option><option value="29">29</option>
						<option value="30">30</option><option value="31">31</option>
					</select>
					<select name="sm" class="sm">
						<option value="">--Month--</option><option value="01">January</option><option value="02">February</option>
						<option value="03">March</option><option value="04">April</option><option value="05">May</option>
						<option value="06">June</option><option value="07">July</option><option value="08">August</option>
						<option value="09">September</option><option value="10">October</option><option value="11">November</option>
						<option value="12">December</option>
					</select>
					<select name="sy" class="sy">
						<option value="">--Year--</option>
						<script>
						for(i=2023; i>=2017; i--){
							var sy = document.querySelector(".sy");
							sy.insertAdjacentHTML("beforeend", "<option value="+i+">"+i+"</option>");
						}
						</script>
					</select>
					</div>
				</section>
				<section class="end-date">
					<label>End Date:</label><br>
					<div>
					<select name="ed" class="ed">
						<option value="">--Day--</option><option value="01">1</option><option value="02">2</option>
						<option value="03">3</option><option value="04">4</option><option value="05">5</option>
						<option value="06">6</option><option value="07">7</option><option value="08">8</option>
						<option value="09">9</option><option value="10">10</option><option value="11">11</option>
						<option value="12">12</option><option value="13">13</option><option value="14">14</option>
						<option value="15">15</option><option value="16">16</option><option value="17">17</option>
						<option value="18">18</option><option value="19">19</option><option value="20">20</option>
						<option value="21">21</option><option value="22">22</option><option value="23">23</option>
						<option value="24">24</option><option value="25">25</option><option value="26">26</option>
						<option value="27">27</option><option value="28">28</option><option value="29">29</option>
						<option value="30">30</option><option value="31">31</option>
					</select>
					<select name="em" class="em">
						<option value="">--Month--</option><option value="01">January</option><option value="02">February</option>
						<option value="03">March</option><option value="04">April</option><option value="05">May</option>
						<option value="06">June</option><option value="07">July</option><option value="08">August</option>
						<option value="09">September</option><option value="10">October</option><option value="11">November</option>
						<option value="12">December</option>
					</select>
					<select name="ey" class="ey">
						<option value="">--Year--</option>
						<script>
						for(i=2023; i>=2017; i--){
							var ey = document.querySelector(".ey");
							ey.insertAdjacentHTML("beforeend", "<option value="+i+">"+i+"</option>");
						}
						</script>
					</select>
					</div>
				</section>
			</section>
			<button name="submit" class="submit">Submit</button>
		</form>
	</section>

<?php
require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/foot.php");
}
?>