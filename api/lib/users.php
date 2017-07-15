<?php
if (! isset($_SESSION)){
	session_start();
}

	
	header('Content-type:application/json');

	//get all students
	function getAllUsers() {
		$conn   = connect_db();
		$sql    = "SELECT * FROM user";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		} else {
			
			if ($result->num_rows > 0) {
				
				echo json_encode(array(
					'status' => 'success',
					'data' => $result->fetch_all(MYSQLI_ASSOC)
				));
				exit();
			} else if ($result->num_rows <= 0) {
				
				echo json_encode(array(
					'status' => 'failed',
					'message' => 'There are no users at the moment'
				));
				exit();
			}
		}
	}

	function getUserById($id = '') {
		$conn   = connect_db();
		$sql    = "SELECT * FROM user WHERE user_id=$id";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		} else {
			
			if ($result->num_rows > 0) {
				
				echo json_encode(array(
					'status' => 'success',
					'data' => $result->fetch_all(MYSQLI_ASSOC)
				));
				exit();
			} else if ($result->num_rows <= 0) {
				
				echo json_encode(array(
					'status' => 'failed',
					'message' => 'User not Found'
				));
				exit();
			}
		}
	}

	function registerUser() {
		$conn = connect_db();
		
		$user_name     = isescape('user_name');
		$user_fullname = isescape('user_fullname');
		$user_dob      = isescape('user_dob');
		$user_contact  = isescape('user_contact');
		$user_address  = isescape('user_address');
		$user_password = isescape('user_password');
		
		
		$rehashed = password_hash($user_password, PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO user";
		$sql .= "(user_name, user_fullname, user_dob, user_contact, user_address, user_password, user_image";
		$sql .= ") VALUES ('$user_name', '$user_fullname', '$user_dob', '$user_contact', ";
		$sql .= "'$user_address', '$rehashed', 'sample_photo.png')";
		
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
				'message' => 'User Registered'
			));
			exit();
		}
		
	}

	function registeUser() {
		$conn = connect_db();
		
		$user_name     = isescape('user_name');
		$user_fullname = isescape('user_fullname');
		$user_dob      = isescape('user_dob');
		$user_contact  = isescape('user_contact');
		$user_address  = isescape('user_address');
		$user_password = isescape('user_password');
		
		
		$rehashed = password_hash($user_password, PASSWORD_DEFAULT);
		
		$sql = "INSERT INTO user";
		$sql .= "(user_name, user_fullname, user_dob, user_contact, ";
		$sql .= "user_address, user_password) VALUES ('$user_name', '$user_fullname', ";
		$sql .= "'$user_dob', '$user_contact', '$user_address', '$rehashed')";
		
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

	//update user
	function updateUser($id = '') {
		$conn = connect_db();
		
		$user_name     = isescape('user_name');
		$user_fullname = isescape('user_fullname');
		$user_dob      = isescape('user_dob');
		$user_contact  = isescape('user_contact');
		$user_address  = isescape('user_address');
		
		
		
		$sql = $conn->prepare("UPDATE user SET user_name=?, user_fullname=?, user_dob=?, user_contact=?, user_address=? WHERE user_id=? ");
		$sql->bind_param("sssssi", $aa, $bb, $cc, $dd, $ee, $ff);
		$aa = $user_name;
		$bb = $user_fullname;
		$cc = $user_dob;
		$dd = $user_contact;
		$ee = $user_address;
		$ff = $id;
		
		
		
		
		
		
		if (!$sql->execute()) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		} else {
			echo json_encode(array(
				'status' => 'success',
				'message' => 'User Details Updated'
			));
			exit();
		}
		
		
	}

	//remove user
	function deleteUser($id = '') {
		$conn = connect_db();
		
		$sql = $conn->prepare("DELETE FROM user WHERE user_id=?");
		$sql->bind_param("i", $id);
		$id = $id;
		
		
		
		
		if (!$sql->execute()) {
			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		} else {
			
			echo json_encode(array(
				'status' => 'success',
				'message' => 'User removed From the System'
			));
			exit();
			
		}
	}


	function setUserProfile($id = '') {
		$conn = connect_db();
		if (isset($_FILES['user_image'])) {
			
			$uploadedFile = uploadPhoto('user_image', '../uploads');
			
			$sql = $conn->prepare("UPDATE user SET user_image=? WHERE user_id=? ");
			$sql->bind_param("si", $aa, $bb);
			$aa = $uploadedFile;
			$bb = $id;
			
			if (!$sql->execute()) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'user_image Updated'
				));
				exit();
			}
		} else {
			echo json_encode(array(
				'status' => 'error',
				'message' => 'user_image is required'
			));
			exit();
		}
		
	}

	function userLogin() {
		$conn = connect_db();

		$user_name = isescape('user_name');
		$user_password = isescape('user_password');
			
			$loginSql = "SELECT * FROM user WHERE user_name ='$user_name' LIMIT 1";
			$result   = $conn->query($loginSql);
			
			if (!$result) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else if ($result->num_rows === 1) {
				
				$user = $result->fetch_array(MYSQLI_ASSOC);
				
				if (password_verify($user_password, $user['user_password'])) {
					
					$_SESSION['sms-user_id']  = $user['user_id'];
					$_SESSION['sms-user_name'] = $user['user_name'];
					
					
					echo json_encode(array(
						'status' => 'success',
						'user_id' => $_SESSION['sms-user_id'],
						'user_name' => $_SESSION['sms-user_name']
					));
					exit();
					
				} else {
					
					echo json_encode(array(
						'status' => 'failed',
						'message' => 'Password combination does not match the Username: ' . $user['user_name']
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

//logout

function logout($conn){

	$_SESSION=array();
	session_destroy();
	
	echo json_encode(array(
												'status' => 'success',
												'message' => 'Logged out successfully'
								));
				exit();



}

?>