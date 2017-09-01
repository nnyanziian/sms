$(function () {
    imageVerify(".imageUpload");
   pdfVerify(".pdfUpload");
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
    $('.deleteSerialBtn').click(function (e) {
        e.preventDefault();
        var cc=confirm("Do you want to Delete");
        if(cc==true){
        Serialx.delete();
        }
    });

    $('#editSerialForm').submit(function (e) {
        e.preventDefault();
        Serialx.editSerial();
    });

    //editSerialCoverForm
    $('#editSerialCoverForm').submit(function (e) {
        e.preventDefault();
        // Serialx.editCover();
        var serial_id = $('#editSerialCoverForm').attr("data-id");
        //  var serial_coverFile = $('#serial_cover')[0].files[0];

        //var file = serial_coverFile.files[0];
        //  var FormData = {
        //    "serial_cover": serial_coverFile
        //};

        var formSettings = {
            "type": "POST",
            "headers": {
                "cache-control": "no-cache",
                "mimeType": "multipart/form-data"
            },
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            "data": new FormData(this),
            "url": "api/serial/setcover/" + serial_id
        };
        console.log(JSON.stringify(formSettings));
        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to update Cover: , " + response.message, "warning");
            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Cover Updated", "success");
                setTimeout(function () {
                    window.location.reload();
                }, 2000);
                // window.location.reload();
            } else {

            }

        }).done(function (response) {
            console.log(JSON.stringify(response));
        });
    });

        //editSerialCoverForm
        $('#editSerialFileForm').submit(function (e) {
            e.preventDefault();
            // Serialx.editCover();
            var serial_id = $('#editSerialFileForm').attr("data-id");
            //  var serial_coverFile = $('#serial_cover')[0].files[0];
    
            //var file = serial_coverFile.files[0];
            //  var FormData = {
            //    "serial_cover": serial_coverFile
            //};
    
            var formSettings = {
                "type": "POST",
                "headers": {
                    "cache-control": "no-cache",
                    "mimeType": "multipart/form-data"
                },
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                "data": new FormData(this),
                "url": "api/serial/setdoc/" + serial_id
            };
            console.log(JSON.stringify(formSettings));
            $.ajax(formSettings).success(function (response) {
                if (response.status == 'failed' || response.status == 'error') {
                    console.log(JSON.stringify(response));
                    notify("Failed to update File: , " + response.message, "warning");
                } else if (response.status == 'success') {
                    console.log(JSON.stringify(response));
                    notify("File Updated", "success");
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                    // window.location.reload();
                } else {
    
                }
    
            }).done(function (response) {
                console.log(JSON.stringify(response));
            });
        });

    //click to edit Profile
    $('.editProfileBtn').click(function () {
        getUserProfileInPlace(adminId);
    });

    $('.editSerialBtn').click(function () {
        var serial_id = $(this).attr('data-id');
        getIdInForm(serial_id, "#editSerialCoverForm");
    });

    $('.editFileBtn').click(function () {
        var serial_id = $(this).attr('data-id');
        getIdInForm(serial_id, "#editSerialFileForm");
    });

    $('.editSerialContentBtn').click(function () {
        var serial_id = $(this).attr('data-id');
        getSerialInPlace(serial_id);
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

function getIdInForm(serialId = "", formx = "") {
    $(formx)[0].reset();
    $(formx).attr("data-id", serialId);
}

function getSerialInPlace(serial_id = "") {
    $('#editSerialForm')[0].reset();
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/serial/" + serial_id
    };

    $.ajax(formsSettings).success(function (response) {

        if (response.status == 'failed' || response.status == 'error') {
            notify("Failed to get serial Details", "warning");

        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            $('#editSerialForm').attr("data-id", serial_id);
            //username
            $('#editSerialForm .serial_title').val(response.data[0].serial_title)
            //fullname
            $('#editSerialForm .serial_issue').val(response.data[0].serial_issue);
            $('#editSerialForm .serial_publisher').val(response.data[0].serial_publisher);
            $('#editSerialForm .serial_details').val(response.data[0].serial_details);

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
                    $('.contentDetails .editSerialContentBtn').attr("data-id", serialId);
                    $('.contentDetails .editFileBtn').attr("data-id", serialId);
                    $('.contentDetails .editSerialBtn').attr("data-id", serialId);
                    $('.contentDetails .deleteSerialBtn').attr("data-id", serialId);

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
    this.delete = function () {
        var serial_id = $('.deleteSerialBtn').attr("data-id");
            var formsSettings = {
                "type": "GET",
                "dataType": "json",
                "url": "api/serial/delete/"+serial_id
            };
        
        $.ajax(formsSettings).success(function (response) {
           // $(".serialContent").html("");
            if (response.status == 'failed' || response.status == 'error') {
                notify("Failed to remove Serial Publicatios, Reload to Try again", "warning");

            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Removed", "success");
                setTimeout ( function(){
                    window.location.reload();
                }, 2000);
                
            }

        });
    }
    this.addSerial = function () {
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
    this.editSerial = function () {
        var serial_id = $('#editSerialForm').attr("data-id");
        var serial_title = $('#editSerialForm .serial_title').val();
        var serial_issue = $('#editSerialForm .serial_issue').val();
        var serial_publisher = $('#editSerialForm .serial_publisher').val();
        var serial_details = $('#editSerialForm .serial_details').val();

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
            "url": "api/serial/update/" + serial_id
        };

        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to update Serial: , " + response.message, "warning");
            } else if (response.status == 'success') {
                $('#addSerial').modal('hide');
                $('.addSerialForm')[0].reset();
                console.log(JSON.stringify(response));

                //var Serialx = new serial();
                topThis.getAll();
                notify("Serial Updated", "success");
                window.location.reload();
            } else {

            }

        });

    }
    this.editCover = function () {
        var serial_id = $('#editSerialCoverForm').attr("data-id");
        var serial_coverFile = $('#serial_cover')[0].files[0];

        //var file = serial_coverFile.files[0];
        //  var FormData = {
        //    "serial_cover": serial_coverFile
        //};

        var formSettings = {
            "type": "POST",
            "headers": {
                "cache-control": "no-cache",
                "mimeType": "multipart/form-data"
            },
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            "data": new FormData($('#editSerialCoverForm')),
            "url": "api/serial/setcover/" + serial_id
        };
        console.log(JSON.stringify(formSettings));
        $.ajax(formSettings).success(function (response) {
            if (response.status == 'failed' || response.status == 'error') {
                console.log(JSON.stringify(response));
                notify("Failed to update Cover: , " + response.message, "warning");
            } else if (response.status == 'success') {
                console.log(JSON.stringify(response));
                notify("Cover Updated", "success");
                window.location.reload();
            } else {

            }

        }).done(function (response) {
            console.log(JSON.stringify(response));
        });

    }
};