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
	header('Location:codinator.php');
	}
else{
//clear the session and logout
  $_SESSION=array();
  session_destroy();

 //header('Location:index.php');
  
}

?>
<?php
	include("inc/header.php");
?>


<div class="container">
	<div class="row">
		<div class="col-md-7">
			<h2 class="hero-text text-center">
			Welcome to imels your
			Internship Management E-log 
			System </h2>
		</div>

		<div class="col-md-5 loginForm">
			
			<form class="studentRegister">
			
			<h3 class="text-center">Register as Student</h3>
				<div class="input-group">
					<span class="input-group-addon">Name</span>
					<input name="name" type="text" class="name form-control" placeholder="John Doe" required>
				</div>
				<br>

				<div class="input-group">
					<span class="input-group-addon">Student No</span>
					<input name="student_no" type="text" class="student_no form-control" placeholder="21500892" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Reg No</span>
					<input name="regno" type="text" class="regno form-control" placeholder="14/u/4433/PS" required>
				</div>
				<br>
                <div class="form-group">
					<select class="program form-control" name="program">
						<option value="0" selected>Select you program of Study</option>
						<option value="BSC Computer Science">BSC Computer Science</option>
						<option value="BSC Information Technology">BSC Information Technology</option>
						<option value="BSC Software Engineering">BSC Software Engineering</option>
						<option value="BSC Information Systems">BSC Information Systems</option>
					</select>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Field Placement</span>
					<input name="fp"  type="text" class="fp form-control" placeholder="Bank of Uganda" required>
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
           
						
			<Button type="submit" class="continue btn btn-primary">Register <span class="fa fa-angle-right"></span></Button>
			</form>
			<br>
			
				<p class="text-left page-header">I already have an acount !</p>
			<a href="index.php"class="continue btn btn-default">Login from here <span class="fa fa-edit"></span></a>
			<br>
			<br>
		</div>
	</div>
	<br>


</div>

<?php
	include("inc/footer.php");
?>