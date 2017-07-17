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
    <div class="container customContainer">
    <div class="row">
        <div class="col-md-3 col-sm-3 profileBar" data-profile-id="">
            <div class="topProfile">
                <div class="profile_image" data-image="" >
                    <button class="editProfileImgBtn btn btn-xs btn-default"><span class="fa fa-pencil"></span></button>
                </div>
                
                <h4 class="profileName text-center">Name in Full</h4>
                <p class="text-center profile_username">@myusername</p>
                <button class="editProfileBtn btn btn-sm btn-default"><span class="fa fa-pencil"> </span> Edit Profile</button>
                <br>
            </div>

            <button class="logoutBtn btn btn-md btn-danger">Logout</button>
        </div>
        <div class="col-md-6 col-sm-6 mainContent">
            <br style="clear:both;">
            <form class="form-inline search-filfter"> <h3>Serial Publications</h3> <input type="text" class="form-control" placeholder="Search..."><span class="btn btn-default" type="submit"><span class="fa fa-search"></span></span></form>
            <br style="clear:both;">
            <div class="serialContent">
                <div class="serial" data-id="">
                    <button class="getDetailsBtn btn btn-md btn-default"><span class="fa fa-newspaper-o"></span></button>
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>

                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>

                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>

                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 contentDetails" data-id="">
            
            <div class="serial_view_image" data-image="">
                <button class="btn btn-sm btn-default editSerialBtn" data-link="">Edit</button>
            </div>
            <h3 class="page-header">Serial Title is here</h3>
            <p>Serial details are here and there</p>

            <button class="btn btn-lg btn-default readViewBtn" data-link="">Read</button>
        </div>
            
        </div>
    </div>


<?php
	include("inc/footer.php");
?>

</body>

</html>