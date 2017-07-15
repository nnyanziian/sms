
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
	

    <title>Imels</title>

    
	

		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" href="css/nprogress.css">
	<link href="css/style1.css" rel="stylesheet">
	
	
	
	</head>
<body>

<div class="loader">
</div>

   <div id="successNot" class="notification alert alert-success">
   <i class="fa fa-close pull-right"></i>
		<p class="text-success text-center"></p>	
		</div>
	<div id="warnNot" class="notification alert alert-warning">
	<i class="fa fa-close pull-right"></i>
		<p class="text-warning text-center"></p>	
	</div>
<nav class="navbar navbar-inverse navbar-fixed-top custom-head">
  <div class="container">
    <div class="navbar-header" style="overflow:auto; padding-right:20px;">
      <a class="navbar-brand" href="index.php">
        Imels
      </a>

      
</div>
<ul class="nav navbar-nav navbar-right">
        <li><a href="#">Help</a></li>
        <li><a href="#">About</a></li>
 
        <?php
  if(isset($_SESSION['elms-user_id']) && 
    isset($_SESSION['elms-username']) && 
    isset($_SESSION['elms-type'])){

      $stype="";
      
      if ($_SESSION['elms-type']==1){
          $stype="Student: ";
      }
      else if($_SESSION['elms-type']==2){
          $stype="Supervisor: ";
      }
      else if($_SESSION['elms-type']==3){
        $stype="Coordinator: ";

      }
    //logged
 
        ?>
<li><a href="#"><span class="fa fa-user"> </span> <?php echo $stype.$_SESSION['elms-username']; ?></a></li>
        <li><a class="logout" href="#">Logout</a></li>
        
        <?php
         }
else{


        ?>
<li><a href="index.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
        <?php

}
        ?>

    </ul>
  </div>
</nav>

<br>
<br>
<br>
