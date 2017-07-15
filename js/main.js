NProgress.start();
//loadHeader();
$(function() {
    NProgress.done();
    //$('.loader').fadeOut();

    $(document).ajaxSend(function() {
        $('.loader').fadeIn();
        NProgress.configure({ showSpinner: true });
        NProgress.start();
        $('#nprogress .bar').css({ 'background': '#7dccbf' });
        $('#nprogress .peg').css({ 'box-shadow': '0 0 10px #7dccbf, 0 0 5px #7dccbf' });
        $('#nprogress .spinner-icon').css({ 'border-top-color': '#fff', 'border-left-color': '#fff' });

    });

    $(document).ajaxStart(function() {
        $('.loader').fadeIn();
    });

    $(document).ajaxStop(function() {
        NProgress.done();
        $('.loader').fadeOut();
    });

    //student register

    $('.studentRegister').submit(function(event) {
        console.log("Form is being submited");
        registerStudent();
        event.preventDefault();

    });

    //main login
    $('.mainLogin').submit(function(event) {
        event.preventDefault();
        console.log("Login Form is being submited");
        var type = $('.mainLogin .type').val();
        if (type == '1') {
            studentLogin();
        } else if (type == '2') {
            suLogin();
        } else if (type == '3') {
            cordinatorLogin();
        } else {
            notify("Could not get User Type", "error");
        }



    });

    $('.logout').click(function(event) {
        event.preventDefault();
        logout();
    });



});


function registerStudent() {
    var student_no = $('.student_no').val();
    var reg_no = $('.regno').val();
    var program = $('.program').val();
    var fp = $('.fp').val();
    var tel = $('.tel').val();
    var password = $('.password').val();
    var email = $('.email').val();
    var name = $('.name').val();



    var formdata = {
        "student_no": student_no,
        "reg_no": reg_no,
        "program": program,
        "field_attachment": fp,
        "tel": tel,
        "password": password,
        "email": email,
        "name": name
    };
    var LoginSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/student/register",
    };



    $.ajax(LoginSettings).success(function(response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("Student Account not created, " + response.message, "warning");
        } else if (response.status == 'success') {
            $('.studentRegister')[0].reset();
            console.log(JSON.stringify(response));
            notify("Student Account Created, Please click login to access your Account", "success");
            //window.location.href = "index.php";
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
    $(mType).slideDown(function() {

        $(mType + " p").text('');
        $(mType + " p").text(textM);

        $(mType).click(function() {
            $(this).slideUp();

        });
        setTimeout(function() {
            $(mType).slideUp();
        }, 5000);
    });
}



function studentLogin() {
    var username = $('.username').val();
    var password = $('.password').val();


    var formdata = {
        "student_no": username,
        "password": password,
    };
    var LoginSettings = {
        "type": "POST",
        //"dataType": "json",
        "data": formdata,
        "url": "api/student/login"
    };

    $.ajax(LoginSettings).success(function(response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify(response.message, "warning");
        } else if (response.status == 'success') {
            $('.mainLogin')[0].reset();
            console.log(JSON.stringify(response));
            notify("Logging in as Student " + response.student_no, "success");
            location.reload();
            //window.location.href = "student.php";
        } else {

        }

    });


}

function cordinatorLogin() {
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
        "url": "api/internc/login"
    };

    $.ajax(LoginSettings).success(function(response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify(response.message, "warning");
        } else if (response.status == 'success') {
            $('.mainLogin')[0].reset();
            console.log(JSON.stringify(response));
            notify("Logging in as Cordinator: " + response.username, "success");
            location.reload();
            //window.location.href = "codinator.php";
        } else {

        }

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

    $.ajax(LoginSettings).success(function(response) {
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
    $.ajax(getSettings).success(function(response) {
        console.log(JSON.stringify(response));
        notify("Logging out", "success");
        location.reload();
    });

}