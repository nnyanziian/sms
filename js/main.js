NProgress.start();
//loadHeader();
$(function () {
    NProgress.done();
    //$('.loader').fadeOut();

    $(document).ajaxSend(function () {
        $('.loader').fadeIn();
        NProgress.configure({
            showSpinner: true
        });
        NProgress.start();
        $('#nprogress .bar').css({
            'background': '#7dccbf'
        });
        $('#nprogress .peg').css({
            'box-shadow': '0 0 10px #7dccbf, 0 0 5px #7dccbf'
        });
        $('#nprogress .spinner-icon').css({
            'border-top-color': '#fff',
            'border-left-color': '#fff'
        });

    });

    $(document).ajaxStart(function () {
        $('.loader').fadeIn();
    });

    $(document).ajaxStop(function () {
        NProgress.done();
        $('.loader').fadeOut();
    });

    //student register

    $('#userRegister').submit(function (event) {
        event.preventDefault();
        console.log("User is registering");
        registerUser();

    });
    //user login

    $('#userLogin').submit(function (event) {
        event.preventDefault();
        console.log("User is loging in");
        userLogin();

    });

    $('.registerMain').click(function (e) {
        e.preventDefault();
        $('.mainLogin').animate({
            top: "-=500px"
        }, function () {
            $('.mainRegister').fadeIn();
            $('.mainLogin').hide();
        });

        $('.loginMain').click(function (e) {
            $('.mainLogin').fadeIn();
            $('.mainRegister').fadeOut();
            $('.mainLogin').animate({
                top: "0px"
            }, function () {

            });

        });

    });

    $('.logout').click(function (event) {
        event.preventDefault();
        logout();
    });

    $('.fab-to-admin').click(function () {
        $('.fab-to-admin .ripple').addClass('rippleFx');
        setTimeout(function () {
            $('.fab-to-admin .ripple').removeClass('rippleFx');
        }, 200);

    });

});

function registerUser() {
    var username = $('#userRegister .username').val();
    var user_fullname = $('.user_fullname').val();
    var user_dob = $('.user_dob').val();
    var user_contact = $('.user_contact').val();
    var user_address = $('.user_address').val();
    var user_password = $('.user_password').val();

    var formdata = {
        "user_name": username,
        "user_fullname": user_fullname,
        "user_dob": user_dob,
        "user_contact": user_contact,
        "user_address": user_address,
        "user_password": user_password,
    };

    alert(JSON.stringify(formdata));
    var registerSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/user/register",
    };

    $.ajax(registerSettings).success(function (response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("User Account not created, " + response.message, "warning");
        } else if (response.status == 'success') {
            // $('.studentRegister')[0].reset();
            console.log(JSON.stringify(response));
            notify("User Account Created, Please login to access your Account", "success");
            setTimeout(function () {
                window.location.reload();
            }, 5000);
        } else {

        }

    });

}

function notify(textM, type) {
    $('.notification').fadeOut();

    if (type === "error") {
        mType = "#errorNot";
    } else if (type === "success") {
        mType = "#successNot";
    } else if (type === "warning") {
        mType = "#warnNot";
    } else {
        console.log("Error on Notify Plugin (var type)");
    }
    $(mType).slideDown(function () {

        $(mType + " p").text('');
        $(mType + " p").text(textM);

        $(mType).click(function () {
            $(this).slideUp();

        });
        setTimeout(function () {
            $(mType).slideUp();
        }, 5000);
    });
}

function userLogin() {
    var username = $('#userLogin .username').val();
    var password = $('#userLogin .password').val();

    var formdata = {
        "user_name": username,
        "user_password": password,
    };
    //alert(JSON.stringify(formdata));
    var LoginSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/user/login"
    };

    $.ajax(LoginSettings).success(function (response) {
        console.log("Hello");
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify(response.message, "warning");
        } else if (response.status == 'success') {
            $('#userLogin')[0].reset();
            console.log(JSON.stringify(response));
            notify("Signing in", "success");
           // setTimeout(function () {
                window.location.reload();
            //}, 5000);
            //window.location.href = "codinator.php";
        } else {
            console.log("Else "+JSON.stringify(response));
        }

    }).error(function(response){
        console.log(JSON.stringify(response));
    });

}

function suLogin() {
    var username = $('.username').val();
    var password = $('.password').val();

    var formdata = {
        "username": username,
        "password": password,
    };
    var LoginSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/supervisor/login"
    };

    $.ajax(LoginSettings).success(function (response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify(response.message, "warning");
        } else if (response.status == 'success') {
            $('.mainLogin')[0].reset();
            console.log(JSON.stringify(response));
            notify("Logging in as Supervisor: " + response.username, "success");
            location.reload();
            //window.location.href = "codinator.php";
        } else {

        }

    });

}

function logout() {
    var getSettings = {
        "type": "GET",
        "url": "api/user/logout",
    };
    $.ajax(getSettings).success(function (response) {
        console.log(JSON.stringify(response));
        notify("Logging out", "success");
        location.reload();
    });

}