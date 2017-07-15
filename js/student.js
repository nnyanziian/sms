$(function() {
    //alert("You are a Student");
    $('.disabledP').hide();
    $('.disabledP .addActivityForm').hide();
    $('.disabledP .activity_list').hide();


    var student_id = $('.listOfDays').attr("st-id");
    getDaysOfStudent(student_id);


    // add Activity
    $('.addActivity').click(function(e) {
        e.preventDefault();

        $('.disabledP').fadeIn(function() {
            $('.disabledP .activity_list').fadeIn();
            $('.disabledP .addActivityForm').fadeIn();
        });

        $('.addActivityForm').submit(function(event) {

            console.log("Form is being submited");
            addActivity();
            event.preventDefault();

        });

    });






    //getProress

});



function addActivity() {

    var student_id = $('.addActivityForm').attr("st-id");
    var activity_details = $('.addActivityForm .activity_details').val();


    var formdataC = {
        "student_id": student_id,
        "activity_details": activity_details
    };

    var formSettingsC = {
        "type": "POST",
        //"dataType": "json",
        "data": formdataC,
        "url": "api/logbook/add",
    };
    // console.log("1");
    $.ajax(formSettingsC).success(function(response) {

        if (response.status == 'failed' || response.status == 'error') {
            console.log(JSON.stringify(response));
            notify("Activity not Created Please check your submited details", "warning");
        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            notify("Activity Created", "success");

            setTimeout(function() {
                window.location.reload();
            }, 5000);



        } else {

        }

    });

}


function getDaysOfStudent(id = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/progress/" + id,
    };


    $.ajax(formsSettings).success(function(response) {
        $('.day_no_list').html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("You have not Added To your Logbook Please Add some thing", "warning");

        } else if (response.status == 'success') {
            var elementV = response.data;
            var progressP = response.percentage;
            $('.progressP').html("");
            $('.progressP').html(progressP);

            var appendData = "";
            $.each(elementV, function(key, value) {
                appendData += ' &nbsp; <a href="' + value.date_created + '" class="dayBtn btn btn-sm btn-default">' + value.date_created + '</a> &nbsp; ';

            });
            $('.day_no_list').html(appendData);

            $('.dayBtn').click(function(event) {
                event.preventDefault();
                var dayNox = $(this).attr('href');
                var std = $('.listOfDays').attr("st-id");

                activityByDay(dayNox, std);
            });


        }



    });

}


function activityByDay(id = "", st = "") {

    $('.disabledP').fadeIn(function() {
        $('.disabledP .addActivityForm').fadeOut();
        $('.disabledP .activity_list').fadeIn();
    });

    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/activity/" + id + "/" + st,
    };


    $.ajax(formsSettings).success(function(response) {
        console.log(JSON.stringify(response));
        $('.activity_list').html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("There are no Activities", "warning");
            $('.disabledP').hide();

        } else if (response.status == 'success') {
            console.log(JSON.stringify(response));
            var elementV = response.data;
            var date_created = response.data[0].date_created;
            var appendData = "";
            $.each(elementV, function(key, value) {
                if (value.approved == 0) {
                    var color = "warning"
                } else {
                    var color = "success"
                }
                appendData += '<p class="alert alert-' + color + '" href="' + value.id + '">' + value.activity_details + '<br><button href="' + value.id + '" class="comBtn pull-left btn btn-default btn-xs">comments</button>&nbsp;<button href="' + value.id + '" class="delActivity pull-right btn btn-danger btn-xs">x</button></p><br>';

            });
            $('.activity_list').html(appendData);

            $('.delActivity').click(function(event) {
                event.preventDefault();
                var actId = $(this).attr('href');


                activityDel(actId, date_created);

                // $(this).parent().remove();

            });

            //comBtn comments
            $('.comBtn').click(function(event) {
                event.preventDefault();
                var actId = $(this).attr('href');
                viewComments(actId);
            });


        }



    });

}

function activityDel(actId = "", date_created = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/activity/delete/" + actId + "/" + date_created
    };

    $.ajax(formsSettings).success(function(response) {


        if (response.status == 'failed' || response.status == 'error') {

            notify(response.message, "warning");
            //$('.disabledP').hide();

        } else if (response.status == 'success') {
            notify("Activity removed", "success");


            location.reload();


        }



    });
}


function viewComments(id = "") {
    var formsSettings = {
        "type": "GET",
        "dataType": "json",
        "url": "api/comment/activity/" + id,
    };


    $.ajax(formsSettings).success(function(response) {
        $('.commentsBySupervisor').html("");

        if (response.status == 'failed' || response.status == 'error') {

            notify("There are no Comments", "warning");

        } else if (response.status == 'success') {
            var elementV = response.data;

            var appendData = "";
            $.each(elementV, function(key, value) {
                appendData += '<p class="alert alert-success" href="' + value.id + '">' + value.comment_details + '</p><br>';

            });
            $('.commentsBySupervisor').html(appendData);

        }



    });

}