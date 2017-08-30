<?php
session_start();
if (isset($_SESSION['sms-user_id']) && !empty($_SESSION['sms-user_id']) &&
    isset($_SESSION['sms-user_name']) && !empty($_SESSION['sms-user_name']) &&
    isset($_SESSION['sms-user_account']) && $_SESSION['sms-user_account'] == 'user')
    {
        //setting cokiees for the user type to be used when user is loged in
    $cookie_name = "userId";
    $cookie_value = $_SESSION['sms-user_id'];
//set for 30 day most probably a month
    if (!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value, time() + (66400 * 30), "/");
    }
}
else {
    $_SESSION = array();
    session_destroy();
    header("location:./welcome");
}
?>
<?php
include ("inc/header.php");
?>
    <div class="container customContainer">
    <div class="row">
        <div class="col-md-3 col-sm-3 profileBar" data-profile-id="">
            <div class="topProfile">
                <div class="profile_image" style="" >
                    
                </div>
                
                <h4 class="profileName text-center"></h4>
                <p class="text-center profile_username">@<?php echo $_SESSION['sms-user_name']; ?></p>
                <button data-toggle="modal" data-target="#editProfile" class="editProfileBtn btn btn-sm btn-default"><span class="fa fa-pencil"> </span> Edit Profile</button>
                <br>
            </div>

            <button class="logoutBtn btn btn-md btn-danger">Logout</button>
        </div>
        <div class="col-md-6 col-sm-6 mainContent">
            <br style="clear:both;">
            <form class="form-inline search-filfter"> <h3>Serial Publications</h3> <input type="text" class="form-control search" placeholder="Search..."><button class="btn btn-default" type="submit"><span class="fa fa-search"></span></button></form>
            <br style="clear:both;">
            <div class="serialContent">

                <div class="serial" data-id="">
                    <div class="serial_image" data-image="">

                    </div>
                    <h5 class="serial_title">Serial for real for real</h5>
                    <p class="serial_details">The details go on and on and on until they get over and over and over then so on</p>

                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 contentDetails opace" data-id="">
            
            <div class="serial_view_image" style="">
            
            </div>
            <h3 class="page-header sTitle">####</h3>
            <p class="sDetails">########################</p>

            <button data-target="#readSerial" data-toggle="modal" class="btn btn-lg btn-default readViewBtn" data-link="">Read</button>
        </div>
            
        </div>
    </div>

    <div id="readSerial" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:90%;">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close btn-danger" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Serial Title</h4>
            </div>
            <div class="modal-body">
            <embed class="pdfViewer" src="" width="100%" height="500" type='application/pdf'>
        </div>
     </div>
    </div>
</div>

    <div id="editProfile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Profile</h4>
            </div>
            <div class="modal-body">
    <form id="userProfileEdit" class="userProfileEdit">
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
			<Button type="submit" class="continue btn btn-primary">Save Changes <span class="fa fa-angle-right"></span></Button>
				</form>
</div>
</div>
</div>
    </div>


<?php
include ("inc/footer.php");
?>
<script src="./js/user.js"></script>
</body>

</html>