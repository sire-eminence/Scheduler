<?php
class viewTimetable{
	public $connection;
	public $resources;
	
	public function __construct(){
		//Import database connection
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/database.php");
		$this->connection = $connection;
		
		//Get timetable
		$getTimetable = "SELECT * FROM timetable ORDER BY timetable_id DESC LIMIT 1";
		$get = $this->connection->prepare($getTimetable);
		$get->execute();
		
		$this->resources = $get->fetchAll(PDO::FETCH_ASSOC);
	}
	
	//Get Administrator's timetable view
	function adminView(){
		$result = $this->resources;
		if(count($result) < 1){
			echo '<p class="no-timetable">No timetable set yet.</p>';
		}
		else{
			echo "<p class='proje-name'>".$result[0]['timetable_semester']." Semester ".$result[0]['timetable_session']."</p><br>
			<table>
			<thead>
				<tr><th>Date</th> <th>Time</th> <th>Course Code</th> <th>Course Title</th> <th>Credit Load</th> <th>Hall</th> <th>Hall Capacity</th> <th>Number of Students</th> <th>Invigilators</th> </tr>
			</thead>
			<tbody>";
			
			$list = json_decode($result[0]['timetable_list']);
			for($i = 0; $i < count($list); $i++){
				
				$invigil = "";
				for($j = 0; $j < count($list[$i]->invigilators); $j++){
					$invigil .= $list[$i]->invigilators[$j]->invigilator_title." ".$list[$i]->invigilators[$j]->invigilator_name.", ";
				}
				
				echo "<tr><td>".$list[$i]->exam_date."</td> <td>".$list[$i]->exam_start_time." - ".$list[$i]->exam_end_time."</td> <td>".$list[$i]->course_code."</td> <td>".$list[$i]->course_title."</td> <td>".$list[$i]->credit_unit."</td> <td>".$list[$i]->hall_name."</td> <td>".$list[$i]->hall_capacity."</td> <td>".$list[$i]->num_of_students."</td> <td>".rtrim($invigil,", ")."</td> </tr>";
			}
			
			
			echo "<tbody>
			</table>";
			
			if($_SESSION['user_role'] == "Faculty"){
				echo "<p class='resche'><a href='https://localhost/scheduler/add-schedule'><button>Reschedule</button></a></p>";
			}
		}
	}
	
	//Get Students' timetable view
	function studentView(){
		$result = $this->resources;
		
		if(count($result) < 1){
			echo '<p class="no-timetable">No timetable set yet.</p>';
		}
		else{
			echo "<p class='proje-name'>".$result[0]['timetable_semester']." Semester ".$result[0]['timetable_session']."</p><br>
			<table>
			<thead>
				<tr><th>Date</th> <th>Time</th> <th>Course Code</th> <th>Course Title</th> <th>Hall</th> <th>Invigilators</th> </tr>
			</thead>
			<tbody>";
			
			$list = json_decode($result[0]['timetable_list']);
			for($i = 0; $i < count($list); $i++){
				$invigil = "";
				for($j = 0; $j < count($list[$i]->invigilators); $j++){
					$invigil .= $list[$i]->invigilators[$j]->invigilator_title." ".$list[$i]->invigilators[$j]->invigilator_name.", ";
				}
				
				echo "<tr><td>".$list[$i]->exam_date."</td> <td>".$list[$i]->exam_start_time." - ".$list[$i]->exam_end_time."</td> <td>".$list[$i]->course_code."</td> <td>".$list[$i]->course_title."</td> <td>".$list[$i]->hall_name."</td> <td>".rtrim($invigil,", ")."</td> </tr>";
			}
			
			echo "<tbody>
			</table>";
		}
	}
}
?>