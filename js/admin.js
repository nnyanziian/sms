$(function () {
    var adminId = document.cookie.replace(/(?:(?:^|.*;\s*)adminId\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    //load profile details
    var Serialx = new serial();
    Serialx.getAll();
    getUserProfle(adminId);
    $('#userProfileEdit').submit(function (e) {
        e.preventDefault();
        editUserProfile(adminId);
    });
    $('#addSerialForm').submit(function (e) {
        e.preventDefault();
        Serialx.addSerial();
    });
    //click to edit Profile
    $('.editProfileBtn').click(function () {
        getUserProfileInPlace(adminId);
    });
    $('.logoutBtn').click(function (e) {
        e.preventDefault();
        logout();
    });

    $('.search-filfter').submit(function (e) {
        e.preventDefault();
        var searchText = $(this).find('.search').val();
        if (searchText.length > 3) {
            var stringed = searchText.toString();
            Serialx.getAll(stringed);
        } else {
            Serialx.getAll();
        }

    });
});

function logout() {
    notify("Signing out...", "success");
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/logout"
    };
    $.ajax(formsSettings).success(function (response) {
        window.location.reload();
    });
}

function getUserProfle(adminId = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/admin/" + adminId
    };

    $.ajax(formsSettings).success(function (response) {
        $(".profileBar .profileName").text("");
        if (response.status == 'failed' || response.status == 'error') {
            notify("Failed to get user Details", "warning");

        } else if (response.status == 'success') {
            //console.log(JSON.stringify(response));
            $(".profileBar .profileName").text(response.data[0].admin_fullname);
            var bgImage = response.data[0].admin_photo;
            $(".profile_image").attr("style", "background-image:url('./uploads/" + bgImage + "');");
        }

    });
}

function getUserProfileInPlace(adminId = "") {
    $('#userProfileEdit')[0].reset();
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/admin/" + adminId
    };

    $.ajax(formsSettings).success(function (response) {

        if (response.status == 'failed' || response.status == 'error') {
            notify("Failed to get user Details", "warning");

        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            //username
            $('#userProfileEdit .username').val(response.data[0].admin_username)
            //fullname
            $('#userProfileEdit .user_fullname').val(response.data[0].admin_fullname);

        }

    });
}

function editUserProfile(adminId = "") {
    var username = $('#userProfileEdit .username').val();
    var user_fullname = $('#userProfileEdit .user_fullname').val();

    var formdata = {
        "admin_username": username,
        "admin_fullname": user_fullname,
    };

    console.log(JSON.stringify(formdata));
    var formSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/admin/update/" + adminId,
    };

    $.ajax(formSettings).success(function (response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("Failed to update profile, please try again " + response.message, "warning");
        } else if (response.status == 'success') {
            // $('.studentRegister')[0].reset();
            getUserProfle(adminId);
            console.log(JSON.stringify(response));
            notify("Profile updated", "success");
        } else {

        }

    });
}

var serial = function () {
var topThis = this;
    function read(link = '', title = "") {
        $('#readSerial .modal-title').text(title);
        $('.pdfViewer').attr("src", "./uploads/" + link + '#toolbar=0&navpanes=0&scrollbar=0');
    }
    this.getAll = function (searchText = '') {
        if (searchText.length > 3) {
            var formsSettings = {
                "type": "GET",
                "dataType": "json",
                "url": "api/serial/search/" + searchText
            };
        } else {

            var formsSettings = {
                "type": "GET",
                "dataType": "json",
                "url": "api/serials/all"
            };
        }

        $.ajax(formsSettings).success(function (response) {
            $(".serialContent").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to get Serial Publicatios, Reload to Try again", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                var appendData = "";
                $.each(response.data, function (key, value) {
                    var image = 'background-image:url(./uploads/' + value.serial_cover + ')';
                    appendData += '<div class="serial" data-link="' + value.serial_file + '" data-id="' + value.serial_id + '">' +
                        '<button class="getDetailsBtn btn btn-md btn-default"><span class="fa fa-newspaper-o"></span></button>' +
                        '<div class="serial_image" data-image="" style="' + image + '">' +

                        ' </div>' +
                        '<h5 class="serial_title">' + value.serial_title + '</h5>' +
                        ' <p class="serial_details">' + value.serial_details + '</p>' +

                        ' </div>';
                    //$(".profile_image").attr("style", "background-image:url('./uploads/" + bgImage + "');");
                });
                $(".serialContent").html(appendData);
                $(".serial").click(function () {
                    $('.contentDetails').removeClass('opace');
                    var serialId = $(this).attr('data-id');
                    var serialFile = $(this).attr('data-link');
                    var serialImage = $(this).find('.serial_image').attr('style');
                    var serialTitle = $(this).find('.serial_title').text();
                    var serialDesc = $(this).find('.serial_details').text();
                    //console.log(serialId);
                    $('.contentDetails').attr("data-id", serialId);
                    $('.contentDetails .serial_view_image').attr("style", serialImage);
                    $('.contentDetails .sTitle').text(serialTitle);
                    $('.contentDetails .sDetails').text(serialDesc);
                    $('.contentDetails .readViewBtn').attr("data-link", serialFile);

                    //read(link='')
                    $('.contentDetails .readViewBtn').click(function (e) {
                        event.preventDefault()
                        var link = $(this).attr('data-link');
                        read(link, serialTitle);
                    })
                });
            }

        });
    }
    this.addSerial = function() {
        var serial_title = $('#addSerialForm .serial_title').val();
        var serial_issue = $('#addSerialForm .serial_issue').val();
        var serial_publisher = $('#addSerialForm .serial_publisher').val();
        var serial_details = $('#addSerialForm .serial_details').val();
    
        var formdata = {
            "serial_title": serial_title,
            "serial_issue": serial_issue,
            "serial_publisher": serial_publisher,
            "serial_details": serial_details,
    
        };
    
        var formSettings = {
            "type": "POST",
            //"dataType": "json",
            "data": formdata,
            "url": "api/serial/add",
        };
    
        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Serial not created, " + response.message, "warning");
            } else if (response.status == 'success') {
                $('#addSerial').modal('hide');
                $('.addSerialForm')[0].reset();
                console.log(JSON.stringify(response));
                
                //var Serialx = new serial();
                topThis.getAll();
                notify("Serial Created", "success");
            } else {
    
            }
    
        });
    
    }
};
