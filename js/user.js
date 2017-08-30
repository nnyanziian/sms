$(function () {
    var userId = document.cookie.replace(/(?:(?:^|.*;\s*)userId\s*\=\s*([^;]*).*$)|^.*$/, "$1");
    //load profile details
    getUserProfle(userId);

    //click to edit Profile
    $('.editProfileBtn').click(function () {
        getUserProfileInPlace(userId);
    });
    $('.logoutBtn').click(function (e) {
        e.preventDefault();
        logout();
    });

    var Serialx = new serial();
    Serialx.getAll();
    $('.search-filfter').submit(function (e) {
        e.preventDefault();
        var searchText = $(this).find('.search').val();
        if (searchText.length > 3) {
            var stringed = searchText.toString();
            Serialx.getAll(stringed);
        }
        else{
            Serialx.getAll();   
        }

    });
});

function logout(){
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

function getUserProfle(userId = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/user/" + userId
    };

    $.ajax(formsSettings).success(function (response) {
        $(".profileBar .profileName").text("");
        if (response.status == 'failed' || response.status == 'error') {
            notify("Failed to get user Details", "warning");

        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            $(".profileBar .profileName").text(response.data[0].user_fullname);
            var bgImage = response.data[0].user_image;
            $(".profile_image").attr("style", "background-image:url('./uploads/" + bgImage + "');");
        }

    });
}

function getUserProfileInPlace(userId = "") {
    $('#userProfileEdit')[0].reset();
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/user/" + userId
    };

    $.ajax(formsSettings).success(function (response) {

        if (response.status == 'failed' || response.status == 'error') {
            notify("Failed to get user Details", "warning");

        } else if (response.status == 'success') {
            //username
            $('#userProfileEdit .username').val(response.data[0].user_name)
            //fullname
            $('#userProfileEdit .user_fullname').val(response.data[0].user_fullname);
            //dateofbirth
            $('#userProfileEdit .user_dob').val(response.data[0].user_dob);
            //phone
            $('#userProfileEdit .user_contact').val(response.data[0].user_contact);
            //address
            $('#userProfileEdit .user_address').val(response.data[0].user_address);

        }

        $('#userProfileEdit').submit(function (e) {
            e.preventDefault();
            editUserProfile(userId);
        });

    });
}

function editUserProfile(userId = "") {
    var username = $('#userProfileEdit .username').val();
    var user_fullname = $('#userProfileEdit .user_fullname').val();
    var user_dob = $('#userProfileEdit .user_dob').val();
    var user_contact = $('#userProfileEdit .user_contact').val();
    var user_address = $('#userProfileEdit .user_address').val();

    var formdata = {
        "user_name": username,
        "user_fullname": user_fullname,
        "user_dob": user_dob,
        "user_contact": user_contact,
        "user_address": user_address,
    };

    console.log(JSON.stringify(formdata));
    var formSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/user/update/" + userId,
    };

    $.ajax(formSettings).success(function (response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("Failed to update profile, please try again " + response.message, "warning");
        } else if (response.status == 'success') {
            // $('.studentRegister')[0].reset();
            getUserProfle(userId);
            console.log(JSON.stringify(response));
            notify("Profile updated", "success");
        } else {

        }

    });
}

var serial = function () {

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
};