<?php
session_start();
if (isset($_SESSION['sms-admin_id']) && !empty($_SESSION['sms-admin_id']) &&
    isset($_SESSION['sms-admin_username']) && !empty($_SESSION['sms-admin_username']) &&
    isset($_SESSION['sms-admin_account']) && $_SESSION['sms-admin_account'] == 'admin')
    {
        //setting cokiees for the user type to be used when user is loged in
    $cookie_name = "adminId";
    $cookie_value = $_SESSION['sms-admin_id'];
//set for 30 day most probably a month
    if (!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value, time() + (66400 * 30), "/");
    }
}
else {
    $_SESSION = array();
    session_destroy();
    header("location:./admin-login");
}
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
                <p class="text-center profile_username">@<?php echo $_SESSION['sms-admin_username']; ?></p>
                <button data-toggle="modal" data-target="#editProfile" class="editProfileBtn btn btn-sm btn-default"><span class="fa fa-pencil"> </span> Edit Profile</button>
                <br>
            </div>
            <div class="activity">
                <a href="#" data-toggle="modal" data-target="#addSerial"><span class="fa fa-plus"></span> Add Serial</a>
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
            
            <div class="serial_view_image" data-image="">
                <button class="btn btn-sm btn-default editSerialBtn" data-toggle="modal" data-target="#editSerialCover" data-id="" data-link="">Edit Cover</button>
            </div>
            <h3 class="page-header sTitle">Serial Title is here</h3>
            <p class="sDetails">Serial details are here and there</p>
            <button data-toggle="modal" data-target="#editSerial" data-id=""  class="editSerialContentBtn btn btn-sm btn-default"><span class="fa fa-pencil"> </span> Update Serial</button>
            <button data-toggle="modal" data-target="#editSerialFile" data-id=""  class="editFileBtn btn btn-sm btn-default"><span class="fa fa-pencil"> </span> Update File</button>
            <button data-id=""  class="deleteSerialBtn btn btn-sm btn-danger"><span class="fa fa-close"> </span> Delete</button>
            <button data-target="#readSerial" data-toggle="modal" data-id=""  class="btn btn-lg btn-default readViewBtn" data-link="">Read</button>
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

			<Button type="submit" class="continue btn btn-primary">Save Changes <span class="fa fa-angle-right"></span></Button>
				</form>
</div>
</div>
</div>
    </div>

    <div id="addSerial" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Serial</h4>
            </div>
            <div class="modal-body">
    <form id="addSerialForm" class="addSerialForm">
				<div class="input-group">
                <span class="input-group-addon">Title</span>
					<input name="serial_title" type="text" class="serial_title form-control" placeholder="Title" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Issue</span>
					<input name="serial_issue" type="text" class="serial_issue form-control" placeholder="Issue" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Publisher</span>
					<input name="serial_publisher" type="text" class="serial_publisher form-control" placeholder="Publisher" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Description</span>
					<textarea name="serial_details" class="serial_details form-control" placeholder="Description" required></textarea>
				</div>
				<br>

			<Button type="submit" class="continue btn btn-primary">Add <span class="fa fa-plus"> </span></Button>
				</form>
</div>
</div>
</div>
    </div>


    <div id="editSerial" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Serial</h4>
            </div>
            <div class="modal-body">
    <form id="editSerialForm" class="addSerialForm" data-id="">
				<div class="input-group">
                <span class="input-group-addon">Title</span>
					<input name="serial_title" type="text" class="serial_title form-control" placeholder="Title" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon">Issue</span>
					<input name="serial_issue" type="text" class="serial_issue form-control" placeholder="Issue" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Publisher</span>
					<input name="serial_publisher" type="text" class="serial_publisher form-control" placeholder="Publisher" required>
				</div>
				<br>
                <div class="input-group">
					<span class="input-group-addon">Description</span>
					<textarea name="serial_details" class="serial_details form-control" placeholder="Description" required></textarea>
				</div>
				<br>

			<Button type="submit" class="continue btn btn-primary">Save changes and Exit <span class="fa fa-save"> </span></Button>
				</form>
</div>
</div>
</div>
    </div>




    
    <div id="editSerialCover" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Serial Cover </h4>
            </div>
            <div class="modal-body">
    <form id="editSerialCoverForm" class="editSerialCoverForm" data-id=""  method="post" enctype="multipart/form-data">
				<div class="input-group">
                <span class="input-group-addon">Cover File</span>
					<input name="serial_cover" id="serial_cover" type="file" class="imageUpload serial_cover form-control" placeholder="Cover" required>
				</div>
				<br>


			<Button type="submit" class="continue btn btn-primary">Save changes and Exit <span class="fa fa-save"> </span></Button>
				</form>
</div>
</div>
</div>
    </div>


    <div id="editSerialFile" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Serial File </h4>
            </div>
            <div class="modal-body">
    <form id="editSerialFileForm" class="editSerialCoverForm" data-id=""  method="post" enctype="multipart/form-data">
				<div class="input-group">
                <span class="input-group-addon">Serial File</span>
					<input name="serial_file" id="serial_file" type="file" class="pdfUpload serial_file form-control" placeholder="File" required>
				</div>
				<br>


			<Button type="submit" class="continue btn btn-primary">Save changes and Exit <span class="fa fa-save"> </span></Button>
				</form>
</div>
</div>
</div>
    </div>


<?php
	include("inc/footer.php");
?>
<script src="./js/admin.js"></script>
</body>

</html>