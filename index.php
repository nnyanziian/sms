<?php
/*
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
*/
?>
<?php
	include("inc/header.php");
?>
<div class="homeBg">

</div>
<div class="container topScreen">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 loginView">
			<a href="./welcome"><img src="img/logo.png" class="sms-logo img-responsive"></a>
			
			<form class="mainLogin">
				<h3 class="text-center">User Login</h3>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input name="username" type="text" class="username form-control" placeholder="Username" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
					<input name="password" type="password" class="password form-control" placeholder="Password" required>
			</div>
			<br>
			<Button type="submit" class="continue btn btn-primary">Login <span class="fa fa-angle-right"></span></Button>
			<p class="text-center page-header">I do not have a user acount !</p>
			<a href="#"class="continue registerMain btn btn-default">Register <span class="fa fa-edit"></span></a>
			</form>




			<form class="mainRegister hiddenElement">
				<h3 class="text-center">Register</h3>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input name="username" type="text" class="username form-control" placeholder="Username" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Full name</span>
					<input name="user_fullname" type="text" class="user_fullname form-control" placeholder="Full name" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input name="user_dob" type="date" class="user_dob form-control" placeholder="Date of Birth" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
					<input name="user_contact" type="tel" class="user_contact form-control" placeholder="Phone contact" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-globe"></i></span>
					<input name="user_address" type="tel" class="user_address form-control" placeholder="Address" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
					<input name="user_password" type="password" class="user_password form-control" placeholder="Password" required>
			</div>
			<br>
			<Button type="submit" class="continue btn btn-primary">Register <span class="fa fa-angle-right"></span></Button>
				<p class="text-center page-header">I alredy have a user acount !</p>
			<a href="#"class="continue loginMain btn btn-default">Login <span class="fa fa-edit"></span></a>
			</form>
			
			<br>
			<br>
			<br>
		</div>
	</div>
	<a href="./admin-login" class="fab-to-admin"><span class="fa fa-user"> </span> Staff<span class="ripple"></span></a>
</div>


<?php
	include("inc/footer.php");
?>

</body>

</html>