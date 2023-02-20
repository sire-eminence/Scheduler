<?php
class scheduleTimetable{
	public $connection;
	
	function schedule($ss, $se, $sy, $sm, $sd, $ey, $em, $ed, $semester){
		//Import database connection
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/database.php");
		$this->connection = $connection;

		if(empty($ss)){
			echo "Enter the session start year.";
		}
		else if(empty($se)){
			echo "Enter the session end year.";
		}
		else if(empty($semester)){
			echo "Enter the semester.";
		}
		else if(!checkdate($sm, $sd, $sy)){
			echo "Select a valid start date.";
		}
		else if(!checkdate($em, $ed, $ey)){
			echo "Select a valid end date.";
		}
		else{
			$startDate = $sy."-".$sm."-".$sd;
			$endDate = $ey."-".$em."-".$ed;
		
			//Date Generating Function
			function dateFunc($stad, $endd){
				$start = new DateTime($stad);
				$end = new DateTime($endd);
				$oneday = new DateInterval("P1D");
		
				$days = array();
				foreach(new DatePeriod($start, $oneday, $end->add($oneday)) AS $day){
					$day_num = $day->format("N");
					if($day_num < 6){
						$days[] = $day->format("d-m-Y");
					}
				}
				return $days[mt_rand(0, count($days)-1)];
			}
		
			//Time Generating Function
			function timeFunc(){
				$timee = new DateTime(mt_rand(8, 14).":00:00");
				$tim = $timee->format("h:i A");
				return $tim;
			}
			
			//Get hall function
			function getHall($halls){
				$examHall = $halls[mt_rand(0, count($halls)-1)];
				return $examHall;
			}
		
			//Getting all the courses
			if($semester == "1st"){
				$getCourses = "SELECT c.*, d.* FROM courses_table c LEFT JOIN department_offerings d ON d.course_id = c.course_id WHERE c.semester = '1st' ";
			}
			else{
				$getCourses = "SELECT c.*, d.* FROM courses_table c LEFT JOIN department_offerings d ON d.course_id = c.course_id WHERE c.semester = '2nd' ";
			}
			$get = $this->connection->prepare($getCourses);
			$get->execute();
			$value = $get->fetchAll(PDO::FETCH_ASSOC);
			
			//Getting the list of halls
			$totalHalls = "SELECT * FROM halls_table";
			$all = $this->connection->prepare($totalHalls);
			$all->execute();
			$allHalls = $all->fetchAll(PDO::FETCH_ASSOC);
			
			//Getting invigilators
			$get_invig = "SELECT invigilator_title, invigilator_name FROM invigilators";
			$invig = $this->connection->prepare($get_invig);
			$invig->execute();
			$invig_list = $invig->fetchAll(PDO::FETCH_ASSOC);
			
			//LAYERING OF COURSES INTO THE TIMETABLE WITH TIME AND DATE
			$subTable = array();
			function layerFunc($valueTot, $startDate, $endDate, $subTable, $halls, $list){
				for($i = 0; $i < count($valueTot); $i++){
					//Pick invigilators
					$the_list = $new_list = array();
					while(count($the_list) < 3){
						$randKey = mt_rand(0, count($list)-1);
						$the_list[$randKey] = $list[$randKey];
					}
					
					//Getting exam date and start time
					$retd = dateFunc($startDate, $endDate);
					$rett = timeFunc();
					
					//Getting exam ending time
					$rettAddUnit = strtotime($rett) + (3600 * $valueTot[$i]['credit_unit']);
					$rettAddUnit = date("h:i A", $rettAddUnit);
					
					//Getting the exam hall
					$examHall = $halls[mt_rand(0, count($halls)-1)];
					
					$temp = array(
						'exam_date' => $retd,
						'exam_start_time' => $rett,
						'exam_end_time' => $rettAddUnit,
						'course_id' => $valueTot[$i]['course_id'],
						'course_code' => $valueTot[$i]['course_code'],
						'course_title' => $valueTot[$i]['course_title'],
						'credit_unit' => $valueTot[$i]['credit_unit'],
						'level' => $valueTot[$i]['level'],
						'department' => $valueTot[$i]['department'],
						'hall_name' => $examHall['hall_name'],
						'hall_capacity' => $examHall['hall_capacity'],
						'num_of_students' => $valueTot[$i]['num_of_students'],
						'invigilators' => array_values($the_list),
						'date_added' => $valueTot[$i]['date_added']
					);
					
					//Making sure hall capacity is not less than number of students
					while($temp['hall_capacity'] < $temp['num_of_students']){
						$newHall = getHall($halls);
						$temp['hall_name'] = $newHall['hall_name'];
						$temp['hall_capacity'] = $newHall['hall_capacity'];
					}
					
					$flag = "";
					for($j = 0; $j < count($subTable); $j++){
						if(array_search($valueTot[$i]['course_code'], $subTable[$j])){
							$flag .= true;
						}
						else if(array_search($temp['exam_date'], $subTable[$j]) && array_search($temp['department'], $subTable[$j]) && array_search($temp['level'], $subTable[$j]) && ((strtotime($temp['exam_start_time']) >= strtotime($subTable[$j]['exam_start_time']) && strtotime($temp['exam_start_time']) <= strtotime($subTable[$j]['exam_end_time'])) || (strtotime($temp['exam_end_time']) >= strtotime($subTable[$j]['exam_start_time']) && strtotime($temp['exam_end_time']) <= strtotime($subTable[$j]['exam_end_time']))) && /**/ (array_search($temp['exam_date'], $subTable[$j]) && ((strtotime($temp['exam_start_time']) >= strtotime($subTable[$j]['exam_start_time']) && strtotime($temp['exam_start_time']) <= strtotime($subTable[$j]['exam_end_time'])) || (strtotime($temp['exam_end_time']) >= strtotime($subTable[$j]['exam_start_time']) && strtotime($temp['exam_end_time']) <= strtotime($subTable[$j]['exam_end_time']))))){
							$temp['exam_date'] = $retd;
						}
					}
					
					if($flag == ""){
						array_push($subTable, $temp);
					}
					
					$the_list = array();
				}
				return $subTable;
			}
			
			//Calling layer function
			$subTable += layerFunc($value, $startDate, $endDate, $subTable, $allHalls, $invig_list);
			$newTimetable = $subTable;
			$subTable = null;
			
			//Clear Previous Timetable
			$clearTable = "DELETE FROM timetable";
			$clear = $this->connection->prepare($clearTable);
			$clear->execute();
			
			//Add new Timetable
			array_multisort(array_column($newTimetable, 'exam_date'), SORT_ASC, array_column($newTimetable, 'exam_start_time'), SORT_ASC, $newTimetable);	
			$newTimetable = json_encode($newTimetable);
			$timetableSession = $ss." / ".$se." Examination Timetable";
			
			$date = date("d-m-Y");
			$addTimetable = "INSERT INTO timetable(timetable_session, timetable_semester, timetable_list, date_added) VALUES (:ts, :tsm, :tl, :da)";
			$add = $this->connection->prepare($addTimetable);
			$add->bindParam(':ts', $timetableSession, PDO::PARAM_STR);
			$add->bindParam(':tsm', $semester, PDO::PARAM_STR);
			$add->bindParam(':tl', $newTimetable, PDO::PARAM_STR);
			$add->bindParam(':da', $date, PDO::PARAM_STR);
			
			if($add->execute()){
				header("Location: http://localhost/scheduler/admin-view");
			}
		}
	}
}