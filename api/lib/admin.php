<?php
session_start();
header('Content-type:application/json');

//get all students
	function getAllAdmins(){
		$conn=connect_db();
		$sql = "SELECT * FROM library_admin";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else{
			
			if ($result->num_rows > 0) {
				
				echo json_encode(array(
					'status' => 'success',
					'data' => $result->fetch_all(MYSQLI_ASSOC)
				));
				exit();
			} else if ($result->num_rows <= 0) {
				
				echo json_encode(array(
					'status' => 'failed',
					'message' => 'Admin not Found'
				));
				exit();
			}
		}
	}
	
		function getAdminById($id=''){
		$conn=connect_db();
		$sql = "SELECT * FROM library_admin WHERE admin_id=$id";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else{
			
			if ($result->num_rows > 0) {
				
				echo json_encode(array(
					'status' => 'success',
					'data' => $result->fetch_all(MYSQLI_ASSOC)
				));
				exit();
			} else if ($result->num_rows <= 0) {
				
				echo json_encode(array(
					'status' => 'failed',
					'message' => 'Admin not Found'
					));
				exit();
			}
		}
	}
	

	
	function registerAdmin(){
		$conn=connect_db();
		
		$admin_fullname=isescape('admin_fullname');
		$admin_username=isescape('admin_username');
		$admin_password=isescape('admin_password');
		

			$rehashed=password_hash($admin_password, PASSWORD_DEFAULT);

			$sql = "INSERT INTO library_admin";
			$sql .= "(admin_fullname, admin_username, admin_password, admin_photo";
			$sql .= ") VALUES ('$admin_fullname', '$admin_username', ";
			$sql .= "'$rehashed', 'sample_photo.png')";

			$result = mysqli_query($conn, $sql);

			if (!$result) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'Admin Registered'
				));
				exit();
			}
		
	}
	
	    //update admin

        function updateAdmin($id=''){
		$conn=connect_db();
		
			$admin_fullname=isescape('admin_fullname');
			$admin_username=isescape('admin_username');

    
            $sql=$conn->prepare("UPDATE library_admin SET admin_fullname=?, admin_username=? WHERE id=? ");
            $sql->bind_param("ssi", $aa, $bb, $cc);
            $aa=$admin_fullname;
            $bb=$admin_username;
            $cc=$id;


		


			if (!$sql->execute()) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'Admin Details Updated'
				));
				exit();
			}


	}

    function setAdminPhoto($id=''){
		$conn=connect_db();
		if (isset($_FILES['admin_photo'])){
			
			$uploadedFile= uploadPhoto('admin_photo', '../uploads');
			
			$sql=$conn->prepare("UPDATE library_admin SET admin_photo=? WHERE admin_id=? ");
            $sql->bind_param("si", $aa, $bb);
            $aa=$uploadedFile;
            $bb=$id;
           	
			if (!$sql->execute()) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'admin_photo Updated'
				));
				exit();
			}
		}
		else{
			echo json_encode(array(
					'status' => 'error',
					'message' => 'admin_photo is required'
				));
				exit();
		}
		
	}
	function adminLogin() {
		$conn = connect_db();

		$admin_username = isescape('admin_username');
		$admin_password = isescape('admin_password');
			
			$loginSql = "SELECT * FROM library_admin WHERE admin_username ='$admin_username' LIMIT 1";
			$result   = $conn->query($loginSql);
			
			if (!$result) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else if ($result->num_rows === 1) {
				
				$user = $result->fetch_array(MYSQLI_ASSOC);
				
				if (password_verify($admin_password, $user['admin_password'])) {
					
					$_SESSION['sms-admin_id']  = $user['admin_id'];
					$_SESSION['sms-admin_username'] = $user['admin_username'];
					
					
					echo json_encode(array(
						'status' => 'success',
						'user_id' => $_SESSION['sms-admin_id'],
						'user_name' => $_SESSION['sms-admin_username']
					));
					exit();
					
				} else {
					
					echo json_encode(array(
						'status' => 'failed',
						'message' => 'Password combination does not match the Username: ' . $user['admin_username']
					));
					exit();
				}
			} else {
				
				echo json_encode(array(
					'status' => 'failed',
					'message' => 'Username does not exist'
				));
				exit();
			}
	
	}



	
	



?>