<?php
class resourceAccess{
	public $connection;
	
	public function __construct(){
		//Import database connection
		require_once($_SERVER['DOCUMENT_ROOT']."/scheduler/includes/database.php");
		$this->connection = $connection;
	}
	
	
	//Login function for both faculty and departmental admin
	function login($name, $pass, $mode){
		$username = strip_tags(htmlentities(trim($name)));
		$password = strip_tags(htmlentities(trim($pass)));
		
		if(empty($username)){
			echo "Username cannot be left empty.";
		}
		else if(empty($password)){
			echo "Password cannot be left empty.";
		}
		else{
			if($mode == "Faculty"){
				$checkUser = "SELECT * FROM admin_table WHERE admin_username = BINARY(:au) AND admin_department = 'Faculty' LIMIT 1";
			}
			else{
				$checkUser = "SELECT * FROM admin_table WHERE admin_username = BINARY(:au) AND admin_department <> 'Faculty' LIMIT 1";
			}
			$check = $this->connection->prepare($checkUser);
			$check->bindParam(":au", $username, PDO::PARAM_STR);
			$check->execute();
			
			if($check->rowCount() > 0){
				$returned = $check->fetch(PDO::FETCH_ASSOC);
				
				if(password_verify($password, $returned['admin_password'])){
					$_SESSION['user_id'] = $returned['admin_id'];
					$_SESSION['user_role'] = $returned['admin_department'];
					header("Location: ".$_SERVER['HTTP_REFERER']);
				}
				else{
					echo "Incorrect username or password.";
				}
			}
			else{
				echo "Incorrect username or password.";
			}
		}
	}
	
	
	//Function for adding departmental admin by the faculty admin
	function add_admin($user, $pass, $dept){
		$username = strip_tags(htmlentities(trim($user)));
		$password = strip_tags(htmlentities(trim($pass)));
		$department = strip_tags(htmlentities(trim($dept)));
		
		if(empty($username)){
			echo "Username cannot be left empty.";
		}
		else if(empty($password)){
			echo "Password cannot be left empty.";
		}
		else if(empty($department)){
			echo "Department cannot be left empty.";
		}
		else{
			$checkUser = "SELECT admin_id FROM admin_table WHERE admin_username = :au LIMIT 1";
			$check = $this->connection->prepare($checkUser);
			$check->bindParam(":au", $username, PDO::PARAM_STR);
			$check->execute();
			
			if($check->rowCount() > 0){
				echo "Username already exists.";
			}
			else{
				$date = date("d-m-Y");
				$passkey = password_hash($password, PASSWORD_DEFAULT);
				$addUser = "INSERT INTO admin_table (admin_username, admin_password, admin_department, date_added) VALUES (:au, :ap, :ad, :da)";
				$add = $this->connection->prepare($addUser);
				$add->bindParam(":au", $username, PDO::PARAM_STR);
				$add->bindParam(":ap", $passkey, PDO::PARAM_STR);
				$add->bindParam(":ad", $department, PDO::PARAM_STR);
				$add->bindParam(":da", $date, PDO::PARAM_STR);
				
				if($add->execute()){
					echo "Admin has been added successfully.";
				}
				else{
					echo "An error occured. Try again.";
				}
			}
		}
	}
	
	
	//Get the list of administrators
	function list_admins(){
		$getAdmins = "SELECT * FROM admin_table";
		$get = $this->connection->prepare($getAdmins);
		$get->execute();
		
		$counter = 1;
		while($returned = $get->fetch(PDO::FETCH_ASSOC)){
			if($returned['admin_department'] == 'Faculty'){
				echo "<tr><td>".$counter."</td> <td>".$returned['admin_username']."</td> <td>".$returned['admin_department']."</td> <td>".$returned['date_added']."</td> <td></td></tr>";
			}
			else{
				echo "<tr><td>".$counter."</td> <td>".$returned['admin_username']."</td> <td>".$returned['admin_department']."</td> <td>".$returned['date_added']."</td> <td><button value='".$returned['admin_id']."' class='del-btn'>Delete</button></td></tr>";
			}
			
			$counter++;
		}
	}
	
	
	//Delete an administrator
	function delete_admin($id){
		$admin_id = strip_tags(htmlentities(trim($id)));
		
		if(empty($admin_id) || !is_numeric($admin_id)){
			echo "Invalid request.";
		}
		else{
			$deleteAdmin = "DELETE FROM admin_table WHERE admin_id = :ai LIMIT 1";
			$delete = $this->connection->prepare($deleteAdmin);
			$delete->bindParam(":ai", $admin_id, PDO::PARAM_STR);
			if($delete->execute()){
				echo "User successfully removed.";
			}
			else{
				echo "An error occured. Try again.";
			}
		}
	}
	
	
	//Change Password
	function change_password($old, $new, $renew){
		$oldPassword = strip_tags(htmlentities(trim($old)));
		$newPassword = strip_tags(htmlentities(trim($new)));
		$renewPassword = strip_tags(htmlentities(trim($renew)));
		$deUserid = strip_tags(htmlentities(trim($_SESSION['user_id'])));
		
		if(empty($oldPassword) && empty($newPassword) && empty($renewPassword)){
			echo "You cannot submit an empty form.";
		}
		else if(empty($oldPassword)){
			echo "Enter your current password.";
		}
		else if(empty($newPassword)){
			echo "Enter new password.";
		}
		else if(mb_strlen($newPassword) < 6){
			echo "Password cannot be less than six characters.";
		}
		else if(empty($renewPassword)){
			echo "Password does not match.";
		}
		else if($renewPassword != $newPassword){
			echo "Password does not match.";
		}
		else{
			$getData = "SELECT * FROM admin_table WHERE admin_id = :id";
			$get = $this->connection->prepare($getData);
			$get->bindParam(':id', $deUserid, PDO::PARAM_STR);
			$get->execute();
			
			$returned = $get->fetch(PDO::FETCH_ASSOC);
			if(password_verify($oldPassword, $returned['admin_password'])){
				$newHashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			
				$updPass = "UPDATE admin_table SET admin_password = :ap WHERE admin_id = :id";
				$upd = $this->connection->prepare($updPass);
				$upd->bindParam(':ap', $newHashPassword, PDO::PARAM_STR);
				$upd->bindParam(':id', $deUserid, PDO::PARAM_STR);
			
				try{
					if($upd->execute()){
						echo "Password successfully changed.";
					}
					else{
						echo "An error occured. Try again.";
					}
				}
				catch(Exception $e){
					echo "An error occured. Try again.";
				}
			}
			else{
				echo "Incorrect password.";
			}
		}
	}
}
?>