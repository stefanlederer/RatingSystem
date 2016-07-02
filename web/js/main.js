/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function () {
    //send post when button clicked
    var clicked = false;
    var elem = '';

    var myChart = null;

    var countActions = [];
    var answersOptions = [];
    $('.date').datepicker({
        dateFormat: "yy-mm-dd"
    });

    $('.time').timepicker({
        timeFormat: 'H:mm:ss',
        interval: 60,
        minTime: '0',
        maxTime: '23:00',
        startTime: '0:00',
        dynamic: false,
        dropdown: true,
        scrollbar: false
    });

    $('.button').click(function () {
        clicked = true;
        elem = this;
        $('.button-form').submit();
    });
    $(".button-form").submit(function (e) {
        e.preventDefault();
        if (clicked) {
            console.log('clicked');

            $('.button').fadeTo("slow", 0.2);
            $('.button').prop("disabled", true);
            setTimeout(function () {
                $('.button').fadeTo("slow", 1);
                $('.button').prop("disabled", false);
            }, 400);

            var buttontype = $(elem).val();
            console.log(buttontype);
            $.ajax({
                type: "POST",
                url: "/",
                data: {
                    button: buttontype
                },
                success: console.log("success")
            });
            clicked = false;
        }
    });

    //Admin Area

    $('select').material_select();

    //get answerOption boxes
    $(".answerQuantity").change(function () {
        $("input[class=options]").remove();
        var quantity = $(".answerQuantity option:selected").text();
        for (var i = 1; i <= quantity; i++) {
            $('.answerOption').append('<input type="text" name="answerOptions[]" class="options" placeholder="Antwortmöglichkeiten"/>');
        }
    });

    //delete button clicked in change survey
    $('.delete-icon').click(function () {
        $('#deleteSurvey-modal').openModal();
        var table_id = $(this).parents('TR').find('.survey-id').text();
        var deleteIcon = this;
        $('#absoluteDeleteButton').click(function () {
            $.ajax({
                type: "POST",
                url: "/admin/changeSurvey/delete",
                data: {
                    id: table_id
                },
                success: function () {
                    $(deleteIcon).parents('tr').remove();
                }
            });
        });
    });

    //delete button clicked in change devices
    $('.delete-icon-device').click(function () {
        $('#deleteDevice-modal').openModal();
        var table_id = $(this).parents('TR').find('.device-id').text();
        var deleteIcon = this;
        $('#absoluteDeleteButton').click(function () {
            $.ajax({
                type: "POST",
                url: "/admin/changeDevice/delete",
                data: {
                    id: table_id
                },
                success: function () {
                    $(deleteIcon).parents('tr').remove();
                }
            });
        });
    });

    //delete button clicked in change user
    $('.delete-icon-user').click(function () {
        $('#deleteUser-modal').openModal();
        var table_id = $(this).parents('TR').find('.user-id').text();
        var deleteIcon = this;
        $('#absoluteDeleteButton').click(function () {
            $.ajax({
                type: "POST",
                url: "/admin/changeUser/delete",
                data: {
                    id: table_id
                },
                success: function () {
                    $(deleteIcon).parents('tr').remove();
                }
            });
        });
    });

    //statistics
    var question;
    var sumRatings;
    var sumButtons;
    var period;
    $('.icon-statistic').click(function () {
        var parentTR = $(this).parents("tr");
        question = $(parentTR).children('td.table-question').text();
        sumRatings = $(parentTR).children('td.table-rating').text();
        sumButtons = $(parentTR).children('td.table-count').text();
        period = $(parentTR).children('td.table-period').text();

        $.ajax({
            type: "POST",
            url: "/admin/statistic/chart"
        });

    });
    bindPencil();
    $('.chart-controls .pie-chart').click(function () {
        if (!$(this).hasClass('active')) {
            $(this).parents('.chart-controls').find('i').removeClass('active');
            $(this).addClass('active');
            myChart.destroy();
            var ctx = $('.chart');
            myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: answersOptions,
                    datasets: [{
                        label: '# of Votes',
                        data: countActions,
                        backgroundColor: [
                            'rgba(113,225,13,0.8)',
                            'rgba(232,160,12, 0.8)',
                            'rgba(255,0,0,0.8)',
                            'rgba(57,13,232, 0.8)',
                            'rgba(0,255,230,0.8)'
                        ],
                        borderColor: [
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff'
                        ],
                        borderWidth: 2
                    }]
                }
            });
        }
    });
    $('.chart-controls .bar-chart').click(function () {
        if (!$(this).hasClass('active')) {
            $(this).parents('.chart-controls').find('i').removeClass('active');
            $(this).addClass('active');
            myChart.destroy();
            var ctx = $('.chart');
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: answersOptions,
                    datasets: [{
                        label: '# of Votes',
                        data: countActions,
                        backgroundColor: [
                            'rgba(113,225,13,0.8)',
                            'rgba(232,160,12, 0.8)',
                            'rgba(255,0,0,0.8)',
                            'rgba(57,13,232, 0.8)',
                            'rgba(0,255,230,0.8)'
                        ],
                        borderColor: [
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff'
                        ],
                        borderWidth: 2
                    }]
                }
            });
        }
    })
    $('.icon-statistic').click(function () {
        var survey_id = $(this).parents('tr').find('.survey-id').text();
        $('.chart-controls').find('i').removeClass('active');
        $('.chart-controls .pie-chart').addClass('active');
        $.get('/admin/statistic/csv/' + survey_id, function (data) {
        }).success(function (data) {
            $('.csv').attr('href', '/' + data.path);
            $('.csv2').attr('href', '/' + data.path2);
        });
        $.get('/admin/survey/getAnswers/' + survey_id, {}, function (data) {
        }).success(function (data) {
            var surveyInformation = data.content;
            countActions = [];
            answersOptions = [];
            data.content.forEach(function (value) {
                countActions.push(parseInt(value[1]));
                answersOptions.push(value['answerOption']);
            });
            // var allInformation = data.allContent;
            // var aOptions = [];
            // var devices = [];
            // var time = [];
            // allInformation.forEach(function(value) {
            //
            // });
            var ctx = $('.chart');
            if (myChart !== null) {
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: answersOptions,
                    datasets: [{
                        label: '# of Votes',
                        data: countActions,
                        backgroundColor: [
                            'rgba(113,225,13,0.8)',
                            'rgba(232,160,12, 0.8)',
                            'rgba(255,0,0,0.8)',
                            'rgba(57,13,232, 0.8)',
                            'rgba(0,255,230,0.8)'
                        ],
                        borderColor: [
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff',
                            '#ffffff'
                        ],
                        borderWidth: 2
                    }]
                }
            });
            $('#chart-modal').openModal();
        });

    });

});

// function bindPencilEvents() {
//noChange button clicked in change survey
// $('.noChange-icon').click(function () {
//     var parentTR = $(this).parents("tr");
//     var parentTD = $(this).parent();
//     var table_question = parentTR.children('td.table-question').find('input');
//     var table_start = parentTR.children('td.table-start').find('input');
//     var table_end = parentTR.children('td.table-end').find('input');
//     var table_timeStart = parentTR.children('td.table-timeStart').find('input');
//     var table_timeEnd = parentTR.children('td.table-timeEnd').find('input');
//     var table_count = parentTR.children('td.table-count').find('input');
//     var table_activity = parentTR.children('td.table-activity').find('input');
//
//     var table_question_oldValue = table_question.val();
//     var table_start_oldValue = table_start.val();
//     var table_end_oldValue = table_end.val();
//     var table_timeStart_oldValue = table_timeStart.val();
//     var table_timeEnd_oldValue = table_timeEnd.val();
//     var table_count_oldValue = table_count.val();
//     var table_activity_oldValue = table_activity.val();
//     $(parentTD).children('a').remove();
//     $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//
//     $(table_question.parent()).html(table_question_oldValue);
//     $(table_start.parent()).html(table_start_oldValue);
//     $(table_end.parent()).html(table_end_oldValue);
//     $(table_timeStart.parent()).html(table_timeStart_oldValue);
//     $(table_timeEnd.parent()).html(table_timeEnd_oldValue);
//     $(table_count.parent()).html(table_count_oldValue);
//     $(table_activity.parent()).html(table_activity_oldValue);
//     bindPencil();
// });

//save button clicked in change survey
// $('.save-icon').click(function () {
//     var table_id = $(this).parents("TR").find('.survey-id').text();
//     var table_question_newValue = $('.table-question').find('input').val();
//     var table_start_newValue = $('.table-start').find('input').val();
//     var table_end_newValue = $('.table-end').find('input').val();
//     var table_timeStart_newValue = $('.table-timeStart').find('input').val();
//     var table_timeEnd_newValue = $('.table-timeEnd').find('input').val();
//     var table_count_newValue = $('.table-count').find('input').val();
//     var table_activity_newValue = $('.table-activity').find('input').val();
//     var elem = this;
//
//     $.ajax({
//         type: "POST",
//         url: "/admin/changeSurvey/change",
//         data: {
//             id: table_id,
//             question: table_question_newValue,
//             date_start: table_start_newValue,
//             date_end: table_end_newValue,
//             time_start: table_timeStart_newValue,
//             time_end: table_timeEnd_newValue,
//             count: table_count_newValue,
//             activity: table_activity_newValue
//         },
//         success: function () {
//             var parentTR = $(elem).parents("tr");
//             var parentTD = $(elem).parent();
//             var table_question = parentTR.children('td.table-question');
//             var table_start = parentTR.children('td.table-start');
//             var table_end = parentTR.children('td.table-end');
//             var table_timeStart = parentTR.children('td.table-timeStart');
//             var table_timeEnd = parentTR.children('td.table-timeEnd');
//             var table_count = parentTR.children('td.table-count');
//             var table_activity = parentTR.children('td.table-activity');
//
//             $(parentTD).children('a').remove();
//             $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//             $(table_question).html(table_question_newValue);
//             $(table_start).html(table_start_newValue);
//             $(table_end).html(table_end_newValue);
//             $(table_timeStart).html(table_timeStart_newValue);
//             $(table_timeEnd).html(table_timeEnd_newValue);
//             $(table_count).html(table_count_newValue);
//             $(table_activity).html(table_activity_newValue);
//             bindPencil();
//         }
//     });
// });

//     //noChange button clicked in change devices
//     $('.noChange-icon-device').click(function () {
//         var parentTR = $(this).parents("tr");
//         var parentTD = $(this).parent();
//
//         var table_device = parentTR.children('td.table-device').find('input');
//
//         var table_device_oldValue = table_device.val();
//
//         $(parentTD).children('a').remove();
//         $(parentTD).html('<a class="info-icon-device"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//         $(table_device.parent()).html(table_device_oldValue);
//         bindPencil();
//     });
//
//     //save button clicked in change devices
//     $('.save-icon-device').click(function () {
//         var table_id = $(this).parents('TR').find('.device-id').text();
//         var table_device_newValue = $('.table-device').find('input').val();
//         var elem = this;
//
//         $.ajax({
//             type: "POST",
//             url: "/admin/changeDevice/change",
//             data: {
//                 id: table_id,
//                 device: table_device_newValue
//             },
//             success: function () {
//                 var parentTR = $(elem).parents("tr");
//                 var parentTD = $(elem).parent();
//                 var table_device = parentTR.children('td.table-device');
//
//                 $(parentTD).children('a').remove();
//                 $(parentTD).html('<a class="info-icon-device"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//                 $(table_device).html(table_device_newValue);
//                 bindPencil();
//             }
//         });
//     });
//
//     //noChange button clicked in change user
//     $('.noChange-icon-user').click(function () {
//         var parentTR = $(this).parents("tr");
//         var parentTD = $(this).parent();
//
//         var table_username = parentTR.children('td.table-username').find('input');
//         var table_role = parentTR.children('td.table-role').find('input');
//
//         var table_username_oldValue = table_username.val();
//         var table_role_oldValue = table_role.val();
//
//         $(parentTD).children('a').remove();
//         $(parentTD).html('<a class="info-icon-user"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//         $(table_username.parent()).html(table_username_oldValue);
//         $(table_role.parent()).html(table_role_oldValue);
//         bindPencil();
//     });
//
//     //save button clicked in change users
//     $('.save-icon-user').click(function () {
//         var table_id = $(this).parents('TR').find('.user-id').text();
//         var table_username_newValue = $('.table-username').find('input').val();
//         var table_role_newValue = $('.table-role').find('input').val();
//         var elem = this;
//
//         $.ajax({
//             type: "POST",
//             url: "/admin/changeUser/change",
//             data: {
//                 id: table_id,
//                 username: table_username_newValue,
//                 role: table_role_newValue
//             },
//             success: function () {
//                 var parentTR = $(elem).parents("tr");
//                 var parentTD = $(elem).parent();
//                 var table_username = parentTR.children('td.table-username');
//                 var table_role = parentTR.children('td.table-role');
//
//                 $(parentTD).children('a').remove();
//                 $(parentTD).html('<a class="info-icon-user"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
//
//                 $(table_username).html(table_username_newValue);
//                 $(table_role).html(table_role_newValue);
//                 bindPencil();
//             }
//         });
//     });
// }
//change survey
$('.info-icon').click(function () {

    $('#changeSurvey-modal').openModal();

    var surveyId = $(this).parents("TR").find('.survey-id').text();

    var parentTR = $(this).parents("tr");
    var elem = $(this).parent();
    var table_question = parentTR.children('td.table-question');
    var table_start = parentTR.children('td.table-start');
    var table_end = parentTR.children('td.table-end');
    var table_timeStart = parentTR.children('td.table-timeStart');
    var table_timeEnd = parentTR.children('td.table-timeEnd');
    var table_count = parentTR.children('td.table-count');
    var table_activity = parentTR.children('td.table-activity');
    var table_devicesId = parentTR.children('td.survey-devicesId')

    var table_question_oldValue = table_question.text();
    var table_start_oldValue = table_start.text();
    var table_end_oldValue = table_end.text();
    var table_timeStart_oldValue = table_timeStart.text();
    var table_timeEnd_oldValue = table_timeEnd.text();
    var table_count_oldValue = table_count.text();
    var table_activity_oldValue = table_activity.text();
    var NOT_table_activity_oldValue;
    if (table_activity_oldValue == "Aktiv") {
        NOT_table_activity_oldValue = "Inaktiv";
    } else {
        NOT_table_activity_oldValue = "Aktiv";
    }
    var buttonCount = [];
    switch (table_count_oldValue) {
        case "2":
            buttonCount[0] = "2";
            buttonCount[1] = "3";
            buttonCount[2] = "4";
            buttonCount[3] = "5";
            break;
        case "3":
            buttonCount[0] = "3";
            buttonCount[1] = "2";
            buttonCount[2] = "4";
            buttonCount[3] = "5";
            break;
        case "4":
            buttonCount[0] = "4";
            buttonCount[1] = "2";
            buttonCount[2] = "3";
            buttonCount[3] = "5";
            break;
        case "5":
            buttonCount[0] = "5";
            buttonCount[1] = "2";
            buttonCount[2] = "3";
            buttonCount[3] = "4";
            break;
    }
    $('.modal-surveyId').val(surveyId);
    $('.modal-question').val(table_question_oldValue);
    $('.modal-start').val(table_start_oldValue);
    $('.modal-end').val(table_end_oldValue);
    $('.modal-timeStart').val(table_timeStart_oldValue);
    $('.modal-timeEnd').val(table_timeEnd_oldValue);
    $('.modal-status').html('<select><option>' + table_activity_oldValue + '</option><option>' + NOT_table_activity_oldValue + '</option></select>');
    $('.modal-buttonCount').html('<select><option>' + buttonCount[0] + '</option><option>' + buttonCount[1] + '</option><option>' + buttonCount[2] + '</option><option>' + buttonCount[3] + '</option></select>');
    $("input[class=options]").remove();
    var quantity = $(".modal-buttonCount option:selected").text();
    for (var i = 1; i <= quantity; i++) {
        $('.modal-answerOption').append('<input type="text" name="answerOptions[]" class="options" placeholder="Antwortmöglichkeiten"/>');
    }
    $('.modal-buttonCount').change(function () {
        $("input[class=options]").remove();
        var quantity = $(".modal-buttonCount option:selected").text();
        for (var i = 1; i <= quantity; i++) {
            $('.modal-answerOption').append('<input type="text" name="answerOptions[]" class="options" placeholder="Antwortmöglichkeiten"/>');
        }
    });

    //get devices
    var devicesId_oldValue = table_devicesId.text();
    $.ajax({
        type: "POST",
        url: "/admin/change/getDevices",
        data: {
            deviceId: devicesId_oldValue
        },
        success: function (data) {
            var device = data.devices;
            var htmlOutputDevices;
            htmlOutputDevices = "<select><option>Alle Geräte</option>";
            for (i = 0; i < device.length; i++) {
                htmlOutputDevices = htmlOutputDevices + "<option>" + device[i]['connection'] + "</option>";
            }
            htmlOutputDevices = htmlOutputDevices + "</select>";
            $('.modal-device').html(htmlOutputDevices);
            // $('.modal-device').html('<select><option>Testgerät</option></select>')
            // console.log(htmlOutputDevices);
            $('select').material_select();
        }
    });

    //get answerOptions
    // var surveyId = $(this).parents("TR").find('.survey-id').text();
    $.ajax({
        type: "POST",
        url: "/admin/change/getAnswerOptions",
        data: {
            answerOption_surveyId: surveyId
        },
        success: function (data) {
            var answerOptions = data.answerOptions;
            // console.log(answerOptions);

            $('.options').each(function (i) {
                $(this).val(answerOptions[i]['answerOption']);
            });
        }
    });


    //if save button is clicked
    $('.save-icon').click(function () {
        var table_id = $('.modal-surveyId').val();
        var table_question_newValue = $('.modal-question').val();
        var table_start_newValue = $('.modal-start').val();
        var table_end_newValue = $('.modal-end').val();
        var table_timeStart_newValue = $('.modal-timeStart').val();
        var table_timeEnd_newValue = $('.modal-timeEnd').val();
        var table_status_newValue = $('.modal-status option:selected').val();
        var table_device_newValue = $('.modal-device option:selected').val();
        var table_count_newValue = $('.modal-buttonCount option:selected').val();
        var table_answerOptions_newValue = $('.options').serializeArray();
        // table_answerOptions_newValue = table_answerOptions_newValue.value;
        // console.log(table_id);
        // console.log(table_answerOptions_newValue);
        // console.log(table_question_newValue);

        $.ajax({
            type: "POST",
            url: "/admin/changeSurvey/change",
            data: {
                id: table_id,
                question: table_question_newValue,
                date_start: table_start_newValue,
                date_end: table_end_newValue,
                time_start: table_timeStart_newValue,
                time_end: table_timeEnd_newValue,
                status: table_status_newValue,
                device: table_device_newValue,
                count: table_count_newValue,
                answerOptions: table_answerOptions_newValue
            },
            success: function () {
                var parentTR = $(elem).parents("tr");
                var table_question = parentTR.children('td.table-question');
                $(table_question).html(table_question_newValue);
                var table_start = parentTR.children('td.table-start');
                $(table_start).html(table_start_newValue);
                var table_end = parentTR.children('td.table-end');
                $(table_end).html(table_end_newValue);
                var table_timeStart = parentTR.children('td.table-timeStart');
                $(table_timeStart).html(table_timeStart_newValue);
                var table_timeEnd = parentTR.children('td.table-timeEnd');
                $(table_timeEnd).html(table_timeEnd_newValue);
                var table_count = parentTR.children('td.table-count');
                $(table_count).html(table_count_newValue);
                var table_activity = parentTR.children('td.table-activity');
                $(table_activity).html(table_status_newValue);
                $('#changeSurvey-modal').closeModal();
            }
        });

        // $(table_question).html('<input class="table-question" name="table-question" value="' + table_question_oldValue + '" />');
        // $(table_start).html('<input class="table-start date" type="text" name="table-start" value="' + table_start_oldValue + '" />');
        // $(table_end).html('<input class="table-end date" type="text" name="table-end" value="' + table_end_oldValue + '" />');
        // $(table_timeStart).html('<input class="time" type="text" name="table-timeStart" value="' + table_timeStart_oldValue + '" />');
        // $(table_timeEnd).html('<input class="time" type="text" name="table-timeEnd" value="' + table_timeEnd_oldValue + '" />');
        // $(table_count).html('<input class="table-count" name="table-count" value="' + table_count_oldValue + '" />');
        // // $(table_activity).html('<input class="table-activity" name="table-activity" value="' + table_activity_oldValue + '" />');
        // $(table_activity).html('<select><option>'+ table_activity_oldValue +'</option><option>'+ NOT_table_activity_oldValue +'</option></select>');

        $('.date').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('.time').timepicker({
            timeFormat: 'H:mm:ss',
            interval: 60,
            minTime: '0',
            maxTime: '23:00',
            startTime: '0:00',
            dynamic: false,
            dropdown: true,
            scrollbar: false
        });

        $('select').material_select();

        //remove pencil icon
        // $(this).remove();
        // $(parentTD).html('<a class="save-icon"><i class="fa fa-check" aria-hidden="true"></i></a>' +
        //     '<a class="noChange-icon"><i class="fa fa-times" aria-hidden="true"></i></a>');
        // bindPencilEvents();
    });
});
//change device
$('.info-icon-device').click(function () {
    $('#changeDevice-modal').openModal();
    var parentTR = $(this).parents("tr");
    var elem = $(this).parent();
    var table_device = parentTR.children('td.table-device');
    var table_deviceId = parentTR.children('td.device-id');

    var table_deviceId_oldValue = table_deviceId.text();
    var table_device_oldValue = table_device.text();

    // $(table_device).html('<input class="table-device" name="table-device" value="' + table_device_oldValue + '" />');
    $('.modal-deviceId').val(table_deviceId_oldValue);
    $('.modal-device').val(table_device_oldValue);
    // $(this).remove();
    // $(parentTD).html('<a class="save-icon-device"><i class="fa fa-check" aria-hidden="true"></i></a>' +
    //     '<a class="noChange-icon-device"><i class="fa fa-times" aria-hidden="true"></i></a>');
    // bindPencilEvents();
    $('.save-icon-device').click(function () {
        var table_id = $('.modal-deviceId').val();
        var table_device_newValue = $('.modal-device').val();

        $.ajax({
            type: "POST",
            url: "/admin/changeDevice/change",
            data: {
                id: table_id,
                device: table_device_newValue
            },
            success: function () {
                var parentTR = $(elem).parents("tr");
                var parentTD = elem;
                var table_device = parentTR.children('td.table-device');

                // $(parentTD).children('a').remove();
                // $(parentTD).html('<a class="info-icon-device"><i class="fa fa-pencil" aria-hidden="true"></i></a>');

                $(table_device).html(table_device_newValue);
                $('#changeDevice-modal').closeModal();
                // bindPencil();
            }
        });
    });
});

//change user
$('.info-icon-user').click(function () {

    $('#changeUser-modal').openModal();

    var parentTR = $(this).parents("tr");
    var elem = $(this).parent();
    var table_userId = parentTR.children('td.user-id');
    var table_username = parentTR.children('td.table-username');
    var table_role = parentTR.children('td.table-role');

    var table_userId_Value = table_userId.text();
    var table_username_oldValue = table_username.text();
    var table_role_oldValue = table_role.text();
    var NOT_table_role_oldValue;
    if (table_role_oldValue == "ROLE_ADMIN") {
        NOT_table_role_oldValue = "ROLE_USER";
    } else {
        NOT_table_role_oldValue = "ROLE_ADMIN";
    }
    $('.modal-userId').val(table_userId_Value);
    $('.modal-username').val(table_username_oldValue);
    // $(tableusername).html('<input class="table-username" name="table-username" value="' + table_username_oldValue + '" />');
    $('.modal-role').html('<select><option>' + table_role_oldValue + '</option><option>' + NOT_table_role_oldValue + '</option></select>');

    $('select').material_select();

    // $(this).remove();
    // $(parentTD).html('<a class="save-icon-user"><i class="fa fa-check" aria-hidden="true"></i></a>' +
    //     '<a class="noChange-icon-user"><i class="fa fa-times" aria-hidden="true"></i></a>');
    // bindPencilEvents();
    $('.save-icon-user').click(function () {
        var table_id = $('.modal-userId').val();
        var table_username_newValue = $('.modal-username').val();
        var table_role_newValue = $('.modal-role option:selected').val();

        $.ajax({
            type: "POST",
            url: "/admin/changeUser/change",
            data: {
                id: table_id,
                username: table_username_newValue,
                role: table_role_newValue
            },
            success: function () {
                var parentTR = $(elem).parents("tr");
                var parentTD = $(elem).parent();
                var table_username = parentTR.children('td.table-username');
                var table_role = parentTR.children('td.table-role');

                // $(parentTD).children('a').remove();
                // $(parentTD).html('<a class="info-icon-user"><i class="fa fa-pencil" aria-hidden="true"></i></a>');
                //
                $(table_username).html(table_username_newValue);
                $(table_role).html(table_role_newValue);
                $('#changeUser-modal').closeModal();
                // bindPencil();
            }
        });
    });
});
