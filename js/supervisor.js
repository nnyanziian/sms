$(function() {
    window.su_id = $('.super').attr("su-id");
    window.su_type = $('.super').attr("su-type");
    window.sutyped = "";
    if (window.su_type == '1') {
        window.sutyped = "hiddenE";
    } else if (window.su_type == '2') {
        window.sutyped = "";
    }
    disableLocation(".activityStudent *");
    disableLocation(".commmentOnActivity *");
    getSupervisor(".assignedStudents");

    $('.assignedStudents').on("change", function(e) {
        var stu = "";
        stu = $(this).val();
        enableLocation(".activityStudent *");
        //console.log(stu);
        getDaysOfStudent(".datesFilled", stu);
    });
    $('.addComment').submit(function(e) {
        e.preventDefault();
        var activityId = $(this).attr('data-id');
        notify("Commenting...", "success");
        commentOnActivity('.addComment', activityId);
    });


});





function getDaysOfStudent(loc = "", id = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/progress/" + id,
    };


    $.ajax(formsSettings).success(function(response) {
        console.log(JSON.stringify(response));
        $(loc).html("");
        $('.progressP').html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("Student has not put anything to his logbook", "warning");

        } else if (response.status == 'success') {
            var elementV = response.data;
            var progressP = response.percentage;
            $('.progressP').html(progressP);

            var appendData = "";
            $.each(elementV, function(key, value) {
                appendData += ' &nbsp; <a href="' + value.date_created + '" class="dayBtn btn btn-sm btn-default">' + value.date_created + '</a> &nbsp; ';

            });
            $(loc).html(appendData);

            $('.dayBtn').click(function(event) {
                event.preventDefault();
                var dayNox = $(this).attr('href');
                activityByDay(".activtyList", dayNox, id);
            });


        }



    });

}


function activityByDay(loc = "", id = "", st = "") {

    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/activity/" + id + "/" + st,
    };


    $.ajax(formsSettings).success(function(response) {
        $(loc).html("");

        if (response.status == 'failed' || response.status == 'error') {
            notify("There are no Activities", "warning");
        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            var elementV = response.data;
            var appendData = "";
            $.each(elementV, function(key, value) {
                if (value.approved == 0) {
                    var color = "warning"
                    var AppText = 'Approve';
                    var btnState = "";
                } else {
                    var color = "success"
                    var AppText = 'Approved';
                    var btnState = "disabled";
                }


                appendData += '<p class = "activityItem alert alert-' + color + '" href = "' + value.id + '" > <span class = "vAlign" >' + value.activity_details + '</span>  <button value="' + value.id + '" ' + btnState + ' class="approveBtn pull-right btn btn-sm btn-default ' + window.sutyped + '">' + AppText + '</button> <button value="' + value.id + '"class = "goToComments pull-right btn btn-sm btn-default" > Comment </button></p> ';

            });
            $(loc).html(appendData);
            $('.approveBtn').click(function(e) {
                e.preventDefault();
                actId = $(this).attr("value");
                notify("Approving...", "success");
                approveActivity(actId);
                $(this).html('Approved <i class="fa fa-check"></i>');
                $(this).addClass('btn-success');
                $(this).removeClass('btn-default');
                $(this).attr("disabled", true);
                $(this).parent().addClass('alert-success');
                $(this).parent().removeClass('alert-warning');

            });

            $('.goToComments').click(function(e) {
                var activity_id = $(this).val();
                e.preventDefault();
                enableLocation('.commmentOnActivity *');
                $('.commmentOnActivity form').attr("data-id", activity_id);
                viewComments(".commentList", activity_id);
            });

        }



    });

}

function disableLocation(loc = "") {
    $(loc).addClass("disabled", function() {
        $(loc).attr("disabled", true);
    });

}

function enableLocation(loc = "") {
    $(loc).removeClass("disabled", function() {
        $(loc).attr("disabled", false);
    });
}

function getSupervisor(loc = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/assign/supervisor/" + window.su_id
    };


    $.ajax(formsSettings).success(function(response) {
        $(loc).html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("No SupervisStudents assigned to you yet", "warning");
            disableLocation(loc);

        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            var elementV = response.data;
            var appendData = "";
            appendData += '<option value="0">Select a Student</option>';
            $.each(elementV, function(key, value) {
                appendData += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            $(loc).html(appendData);

        }



    });
}

function approveActivity(actId = "") {
    ///activity/approve/{id}
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/activity/approve/" + actId
    };


    $.ajax(formsSettings).success(function(response) {

        if (response.status == 'failed' || response.status == 'error') {

            notify("Cannot be approved", "warning");

        } else if (response.status == 'success') {

            notify("Approved", "success");



        }



    });
}


function commentOnActivity(elemento, activityId) {
    var suType = window.su_type;
    var supervisor_id = window.su_id;
    var supType3 = window.su_type;
    var comment_details = $(elemento + ' .comment_details').val();



    var formdata = {
        "supervisor_id": supervisor_id,
        "comment_details": comment_details,
        "supervisor_type": supType3,
        "activity_id": activityId

    };


    var formSettings = {
        "type": "POST",
        "data": formdata,
        "url": "api/comment/add",
    };

    $.ajax(formSettings).success(function(response) {
        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("Commenting Failed", "warning");
        } else if (response.status == 'success') {
            notify("Comment added", "success");
            console.log(JSON.stringify(response));
            $(elemento)[0].reset();
            viewComments(".commentList", activityId);
        } else {

        }

    });
}


function viewComments(loc = "", id = "") {

    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/comment/activity/" + id,
    };


    $.ajax(formsSettings).success(function(response) {
        $(loc).html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("There are no Comments", "warning");

        } else if (response.status == 'success') {
            var elementV = response.data;

            var appendData = "";
            $.each(elementV, function(key, value) {
                appendData += '<p class="commentItem" href="' + value.id + '"><span class="vAlign">' + value.comment_details + '</span></p>';

            });
            $(loc).html(appendData);

        }



    });

}