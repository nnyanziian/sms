<?php
session_start();

	if( isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==1){
	//student
	header('Location:student.php');
	}
	else if(isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==2){
	//supervisor
	header('Location:supervisor.php');
	}
	else if(isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==3){
	//condinaot
	//header('Location:codinator.php');
	}
else{
//clear the session and logout
  $_SESSION=array();
  session_destroy();

 header('Location:index.php');
  
}

?>
<?php
	include("inc/header.php");
?>


<div class="container cordinatorId" st-id="<?php echo $_SESSION['elms-user_id']; ?>">
	<div class="row">
    <div class="col-md-3 listOfStudnets">
		<form name="academicAssignForm" class="" id="academicAssignForm">
    <h3 class="page-header">Academic Supervisor</h3>
		<div class="form-group">
  		<label for="UnAssignedStudents">Students:</label>
  		<select name="UnAssignedStudents" class="form-control UnAssignedStudents" id=""></select>
		</div>
    	<div class="form-group">
  		<label for="supervisorList">Supervisors:</label>
  		<select  name="supervisorList" class="form-control supervisorList" id=""></select>
		</div>

		<div class="form-group">
		<button class="btn btn-sm btn-primary">Assign</button>
		</div>
    </form>
    </div>

 

    <div class="col-md-6">
         <h3 class="page-header">Assigned <button class="pull-right btn btn-sm btn-primary" data-toggle="modal" data-target="#addSupervisorModal" >Add Supervisor</button></h3>
         
         <p>Already assigned students.</p>
		 <table class="table table-striped table-responsive table-hover">
		 <thead>
			 <tr>
				<th>Student</th>
				<th>Supervisor</th>
				<th>Type</th>
				<th>Action</th>
			 </tr>
		</thead>
		<tbody class="assignmentTable">

		</tbody>

		 </table>
    
        
    </div>

	   <div class="col-md-3">
	   		<form name="fieldAssignForm" class="" id="fieldAssignForm">
				<h3 class="page-header">Field Supervisor</h3>
					<div class="form-group">
						<label for="UnAssignedStudents">Students:</label>
						<select name="UnAssignedStudents" class="form-control UnAssignedStudents" id=""></select>
					</div>
					<div class="form-group">
						<label for="supervisorList">Supervisors:</label>
						<select  name="supervisorList" class="form-control supervisorList" id=""></select>
					</div>

					<div class="form-group">
						<button class="btn btn-sm btn-primary">Assign</button>
					</div>
			</form>
		</div>


    </div>	



</div>
<!-- 

    //tel
    //email
    //password

	-->
<div id="addSupervisorModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Supervisor</h4>
            </div>
            <div class="modal-body">
                			<form name="addSupervisorForm" class="addSupervisorForm" id="addSupervisorForm">
			
					<div class="input-group">
					<span class="input-group-addon">Full Name</span>
					<input name="fullname" type="text" class="fullname form-control" placeholder="John Doe" required>
				</div>
				<br>

				<div class="input-group">
					<span class="input-group-addon">Username</span>
					<input name="username" type="text" class="username form-control" placeholder="uername for supervisor" required>
				</div>
				<br>
                <div class="form-group">
					<select class="type form-control" name="type">
						<option value="0" selected>Select supervsior type</option>
						<option value="1">Academic Supervisor</option>
						<option value="2">Field Supervisor</option>
					</select>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Department</span>
					<input name="department"  type="text" class="department form-control" placeholder="Computin, Networking, programming" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Tel</span>
					<input name="tel"  type="tel" class="tel form-control" placeholder="2567982457" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Email</span>
					<input name="email" type="email" class="email form-control" placeholder="example@mak.com" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Password</span>
					<input name="password" type="password" class="password form-control" placeholder="Password" required>
			    </div>

			<br>
			
			<!--
						
			<Button type="submit" class="continue btn btn-primary">Register <span class="fa fa-angle-right"></span></Button>
			
			-->

            </div>
            <div class="modal-footer">
                <button type="submit"class="btn btn-primary">Save</button>
             </div>
			 </form>
        </div>
    </div>
</div>

<?php
	include("inc/footer.php");
?>
<script src="js/coordinator.js"></script>