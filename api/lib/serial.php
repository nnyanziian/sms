<?php
header('Content-type:application/json');

//get all students
	function getAllSerials(){
		$conn=connect_db();
		$sql = "SELECT * FROM serial_pubs";
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
					'message' => 'Serial not Found'
				));
				exit();
			}
		}
	}
	
		function getSerialById($id=''){
		$conn=connect_db();
		$sql = "SELECT * FROM serial_pubs WHERE serial_id=$id";
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
					'message' => 'Serial not Found'
					));
				exit();
			}
		}
	}
	
		function addSerial(){
		$conn=connect_db();
		
		$serial_title=isescape('serial_title');
		$serial_issue=isescape('serial_issue');
		$serial_details=isescape('serial_details');
		$serial_publisher=isescape('serial_publisher');
		

			

			$sql = "INSERT INTO serial_pubs";
			$sql .= "(serial_title, serial_date, serial_issue, serial_details, ";
			$sql .= "serial_publisher) VALUES ('$serial_title', NOW(), '$serial_issue', ";
			$sql .= "'$serial_details', '$serial_publisher')";

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
					'message' => 'Publication Added'
				));
				exit();
			}
		
	}
	
	//update serail
	        function updateSerial($id=''){
		$conn=connect_db();
		
		$serial_title=isescape('serial_title');
		$serial_issue=isescape('serial_issue');
		$serial_details=isescape('serial_details');
		$serial_publisher=isescape('serial_publisher');

    
            $sql=$conn->prepare("UPDATE serial_pubs SET serial_title=?, serial_issue=?, serial_details=?, serial_publisher=? WHERE serial_id=? ");
            $sql->bind_param("ssssi", $aa, $bb, $cc, $dd,$ee);
            $aa=$serial_title;
            $bb=$serial_issue;
            $cc=$serial_details;
            $dd=$serial_publisher;
            $ee=$id;


		


			if (!$sql->execute()) {
				echo json_encode(array(
					'status' => 'error',
					'message' => mysqli_error($conn)
				));
				exit();
			} else {
				echo json_encode(array(
					'status' => 'success',
					'message' => 'Serial Details Updated'
				));
				exit();
			}


	}

	
	    //remove serial
    function deleteSerial($id=''){
		$conn=connect_db();

        $sql=$conn->prepare("DELETE FROM serial_pubs WHERE serial_id=?");
            $sql->bind_param("i",$id);
            $id=$id;

		


			if (!$sql->execute()) {
    			echo json_encode(array(
				'status' => 'error',
				'message' => mysqli_error($conn)
			));
			exit();
		}
		else{
		
				echo json_encode(array(
					'status' => 'success',
					'message' => 'Serial Deleted From the System'
				));
				exit();
			
		}
	}

	
		function setCoverPhoto($id=''){
		$conn=connect_db();
		if (isset($_FILES['serial_cover'])){
			
			$uploadedFile= uploadPhoto('serial_cover', '../uploads');
			
			$sql=$conn->prepare("UPDATE serial_pubs SET serial_cover=? WHERE serial_id=? ");
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
					'message' => 'Serial cover Updated'
				));
				exit();
			}
		}
		else{
			echo json_encode(array(
					'status' => 'error',
					'message' => 'serial_cover is required'
				));
				exit();
		}
		
	}
	
		function uploadSerialDoc($id=''){
		$conn=connect_db();
		if (isset($_FILES['serial_file'])){
			
			$uploadedFile= uploadDocument('serial_file', '../uploads');
			
			$sql=$conn->prepare("UPDATE serial_pubs SET serial_file=? WHERE serial_id=? ");
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
					'message' => 'serial_id Updated'
				));
				exit();
			}
		}
		else{
			echo json_encode(array(
					'status' => 'error',
					'message' => 'serial_file is required'
				));
				exit();
		}
		
	}
	
	
	function searchSerial($text=''){
		$conn=connect_db();
		$sql = "SELECT * FROM serial_pubs WHERE serial_title LIKE '%$text%' OR serial_details LIKE '%$text%'";
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
					'message' => 'Serial not Found'
					));
				exit();
			}
		}
	}


?>