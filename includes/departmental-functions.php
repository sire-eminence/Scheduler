<?php
class acquireAccess{
	public $connection;
	
	public function __construct(){
		//Import database connection
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/database.php");
		$this->connection = $connection;
	}
	
	
	//Adding a course
	function add_course($code, $title, $unit, $level, $semester, $dept, $num){
		$courseCode = strip_tags(htmlentities(trim($code)));
		$courseTitle = strip_tags(htmlentities(trim($title)));
		$creditUnit = strip_tags(htmlentities(trim($unit)));
		$level = strip_tags(htmlentities(trim($level)));
		$semester = strip_tags(htmlentities(trim($semester)));
		$totalStudents = strip_tags(htmlentities(trim($num)));
		$department = strip_tags(htmlentities(trim($_SESSION['user_role'])));
		
		if(empty($courseCode)){
			echo "Enter the course code.";
		}
		else if(empty($courseTitle)){
			echo "Enter the course title.";
		}
		else if(empty($creditUnit)){
			echo "Enter the credit load of the course.";
		}
		else if(empty($level)){
			echo "Enter the level offering the course.";
		}
		else if(empty($semester)){
			echo "Enter the semester for the course.";
		}
		else if(count($dept) < 1){
			echo "Select the department(s) offering the course.";
		}
		else if(empty($num)){
			echo "Enter the total number of students offering the course.";
		}
		else{
			$date = date("d-m-Y");
			$addCourse = "INSERT INTO courses_table (course_code, course_title, credit_unit, level, semester, department, num_of_students, date_added) VALUES (:cc, :ct, :cu, :le, :se, :de, :nos, :da)";
			$add = $this->connection->prepare($addCourse);
			$add->bindParam(':cc', $courseCode, PDO::PARAM_STR);
			$add->bindParam(':ct', $courseTitle, PDO::PARAM_STR);
			$add->bindParam(':cu', $creditUnit, PDO::PARAM_STR);
			$add->bindParam(':le', $level, PDO::PARAM_STR);
			$add->bindParam(':se', $semester, PDO::PARAM_STR);
			$add->bindParam(':de', $department, PDO::PARAM_STR);
			$add->bindParam(':nos', $num, PDO::PARAM_STR);
			$add->bindParam(':da', $date, PDO::PARAM_STR);
			
			if($add->execute()){
				$lastId = $this->connection->lastInsertId();
				
				for($i = 0; $i < count($dept); $i++){
					$enterDept = "INSERT INTO department_offerings (course_id, department, date_added) VALUES (:ci, :de, :da)";
					$enter = $this->connection->prepare($enterDept);
					$enter->bindParam(':ci', $lastId, PDO::PARAM_STR);
					$enter->bindParam(':de', $dept[$i], PDO::PARAM_STR);
					$enter->bindParam(':da', $date, PDO::PARAM_STR);
					$enter->execute();
				}
				
				echo "Course successfully added.";
			}
			else{
				echo "An error occured. Try again.";
			} 
		}
	}
	
	
	//Adding halls
	function add_halls($name, $size){
		$hallName = strip_tags(htmlentities(trim($name)));
		$hallSize = strip_tags(htmlentities(trim($size)));
		
		if(empty($hallName)){
			echo "Hall name cannot be left empty.";
		}
		else if(empty($hallSize)){
			echo "Hall size cannot be left empty.";
		}
		else{
			$date = date("d-m-Y");
			$addHall = "INSERT INTO halls_table (hall_name, hall_capacity, date_added) VALUES (:hn, :hc, :da)";
			$add = $this->connection->prepare($addHall);
			$add->bindParam(":hn", $hallName, PDO::PARAM_STR);
			$add->bindParam(":hc", $hallSize, PDO::PARAM_STR);
			$add->bindParam(":da", $date, PDO::PARAM_STR);
			
			if($add->execute()){
				echo "Hall successfully added.";
			}
			else{
				echo "An error occured. Try again.";
			}
		}
	}
	
	
	//View registered courses
	function registered_courses($dept){
		$department = strip_tags(htmlentities(trim($dept)));
		if(empty($department)){
			echo "Invalid request.";
		}
		else{
			$getCourses = "SELECT * FROM courses_table WHERE department = :de";
			$get = $this->connection->prepare($getCourses);
			$get->bindParam(":de", $department, PDO::PARAM_STR);
			$get->execute();
			
			$counter = 1;
			$departs = "";
			while($returned = $get->fetch(PDO::FETCH_ASSOC)){
				$pickDepts = "SELECT * FROM department_offerings WHERE course_id = :ci";
				$pick = $this->connection->prepare($pickDepts);
				$pick->bindParam(":ci", $returned['course_id'], PDO::PARAM_STR);
				$pick->execute();
				
				while($picks = $pick->fetch(PDO::FETCH_ASSOC)){
					$departs .= $picks['department']."<br>";
				}
				
				echo "<tr><td>".$counter."</td> <td>".$returned['course_code']."</td> <td>".$returned['course_title']."</td> <td>".$returned['credit_unit']."</td> <td>".$returned['level']."</td> <td>".$returned['num_of_students']."</td> <td>".$departs."</td> <td>".$returned['date_added']."</td> <td><button value='".$returned['course_id']."' class='del-btn'>Delete</button></td></tr>";
				$counter++;
				$departs = "";
			}
		}
	}
	
	
	//Delete course
	function delete_course($id){
		$course_id = strip_tags(htmlentities(trim($id)));
		
		if(empty($course_id) || !is_numeric($course_id)){
			echo "Invalid request.";
		}
		else{
			$delCourse = "DELETE FROM courses_table WHERE course_id = :ci";
			$del = $this->connection->prepare($delCourse);
			$del->bindParam(":ci", $course_id, PDO::PARAM_STR);
			
			$delDept = "DELETE FROM department_offerings WHERE course_id = :cid";
			$deli = $this->connection->prepare($delDept);
			$deli->bindParam(":cid", $course_id, PDO::PARAM_STR);
			
			if($del->execute() && $deli->execute()){
				echo "Course Successfully deleted.";
			}
			else{
				echo "An error occured. Try again.";
			}
		}
	}
	
	
	//Add Invigilator
	function add_invigilator($title, $name){
		$title = strip_tags(htmlentities(trim($title)));
		$name = strip_tags(htmlentities(trim($name)));
		
		if(empty($title) && empty($name)){
			echo "You cannot submit empty form.";
		}
		else if(empty($title)){
			echo "Enter the invigilator's title.";
		}
		else if(empty($name)){
			echo "Enter the invigilator's name.";
		}
		else{
			$date = date("d-m-Y");
			$insert = "INSERT INTO invigilators (invigilator_title, invigilator_name, date_added) VALUES (:it, :in, :da)";
			$add = $this->connection->prepare($insert);
			$add->bindParam(":it", $title, PDO::PARAM_STR);
			$add->bindParam(":in", $name, PDO::PARAM_STR);
			$add->bindParam(":da", $date, PDO::PARAM_STR);
			
			if($add->execute()){
				echo "Invigilator Successfully added.";
			}
			else{
				echo "An error occured. Try again.";
			}
		}
	}
}