<?php
session_start();
if (isset($_SESSION['sms-admin_id']) && !empty($_SESSION['sms-admin_id']) &&
    isset($_SESSION['sms-admin_username']) && !empty($_SESSION['sms-admin_username']) &&
    isset($_SESSION['sms-admin_account']) && $_SESSION['sms-admin_account'] == 'admin')
    {
		header("location:./admin");
}
else {
    $_SESSION = array();
    session_destroy();
}
?>
<?php
	include("inc/header.php");
?>
<div class="adminBg">

</div>
<div class="container topScreen">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 loginView">
			<a href="./welcome"><img src="img/logo.png" class="sms-logo img-responsive"></a>
			<h3 class="text-center">Admin Login</h3>
			<form class="mainLogin" id="adminLogin">
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
			</form>
			
			<br>
		</div>
	</div>
		
		<a href="./welcome" class="fab-to-admin"><span class="fa fa-home"> </span> Home<span class="ripple"></span></a>
</div>



<?php
	include("inc/footer.php");
?>

</body>

</html>