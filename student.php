<?php
session_start();

	if( isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==1){
	//student
	//header('Location:student.php');
	}
	else if(isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==2){
	//supervisor
	header('Location:supervisor.php');
	}
	else if(isset($_SESSION['elms-user_id']) && isset($_SESSION['elms-username']) && isset($_SESSION['elms-type']) && $_SESSION['elms-type']==3){
	//condinaot
	header('Location:codinator.php');
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


<div class="container">
	<div class="row">
    <div class="col-md-4 listOfDays" st-id="<?php echo $_SESSION['elms-user_id']; ?>">
    <h4 class="page-header">Select day <button class="addActivity btn btn-sm btn-primary">New Day</button></h4>
    
    <div class="day_no_list">
     </div>
    </div>

    <div class="col-md-4 activityByDate disabledP">
         <h4 class="page-header">Enter the activities done.</h4>
                
        <div class="activtyByDateSelected">
        <form class="addActivityForm" st-id="<?php echo $_SESSION['elms-user_id']; ?>"> 
        <div class="form-group">
            <h4> <?php echo date("Y/m/d"); ?> </h4>
        </div>
        <div class="form-group">
            <textarea required class="form-control activity_details" placeholder="Activity Details"></textarea>
        </div>
            <br>
            <button type="submit" class="btn btn-sm btn-primary">Add Activity</button>
         </form>
         <br>
         <div class="activity_list">
         </div>
        </div>
    </div>

    <div class="col-md-4 commmentOnActivity">
          <h3 class="page-header">Your progress</h3>
          <div class="progress-circle">
              <span class="progressP">0%</span>
          </div>
          <p class="text-center">Completed</p>


       <h3 class="page-header">Supervisor Comments</h3>
          <div class="commentsBySupervisor">
            
          </div>
    </div>
    </div>	



</div>

<?php
	include("inc/footer.php");
?>
<script src="js/student.js"></script>