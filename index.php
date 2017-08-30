<?php
session_start();
if (isset($_SESSION['sms-user_id']) && !empty($_SESSION['sms-user_id']) &&
    isset($_SESSION['sms-user_name']) && !empty($_SESSION['sms-user_name']) &&
    isset($_SESSION['sms-user_account']) && $_SESSION['sms-user_account'] == 'user')
    {
		header("location:./user");
}
else {
    $_SESSION = array();
    session_destroy();

}
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
			
			<form class="mainLogin" id="userLogin">
				<h3 class="text-center">User Sign in</h3>
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




			<form id="userRegister" class="mainRegister hiddenElement">
				<h3 class="text-center">User Sign up</h3>
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