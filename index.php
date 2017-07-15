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
			System, The platform allows students and 
			supervisors to manage logbooks during intern training</h2>
		</div>

		<div class="col-md-5 loginForm">
			
			<form class="mainLogin">
			
			<h3 class="text-center">Login</h3>

			<div class="input-group">
					<span class="input-group-addon">Login as</span>
					<select class="type form-control">
						<option selected value="1">Student</option>
						<option value="2">Supervisor</option>
						<option value="3">Internship Coordinator</option>
					</select>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input name="username" type="text" class="username form-control" placeholder="Username / Student No" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
					<input name="password" type="password" class="password form-control" placeholder="Password" required>
			</div>
			<br>
			

			
			
			
			<Button type="submit" class="continue btn btn-primary">Login <span class="fa fa-angle-right"></span></Button>
			</form>
			<br>
			
				<p class="text-left page-header">I do not have a student acount !</p>
			<a href="register.php"class="continue btn btn-default">Register <span class="fa fa-edit"></span></a>
			<br>
			<br>
		</div>
	</div>
	
	</div>

</div>


<?php
	include("inc/footer.php");
?>