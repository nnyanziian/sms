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
<div class="adminBg">

</div>
<div class="container topScreen">
	<div class="row">
		<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 loginView">
			<a href="./welcome"><img src="img/logo.png" class="sms-logo img-responsive"></a>
			<h3 class="text-center">Admin Login</h3>
			<form class="mainLogin">
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