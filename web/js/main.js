/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function () {
    //send post when button clicked
    var clicked = false;
    var elem = '';
    $('.button').click(function () {
        clicked = true;
        elem = this;
        $('.button-form').submit();
    });
    $(".button-form").submit(function (e) {
        e.preventDefault();
        if (clicked) {
            console.log('clicked');

            var elementVal = $(elem).val();
            $('.button[value!=' + elementVal + ']').fadeTo("slow", 0.2);
            $('.button').prop("disabled", true);
            setTimeout(function () {
                $('.button[value!=elementVal]').fadeTo("slow", 1);
                $('.button').prop("disabled", false);
            }, 3000);

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


    //get answerOption boxes
    $(".answerQuantity").change(function () {
        $("input[class=options]").remove();
        var quantity = $(".answerQuantity option:selected").text();
        for (var i = 1; i <= quantity; i++) {
            $('.answerOption').append('<input type="text" class="options" placeholder="Antwortmöglichkeiten"/>');
        }
    });

    //delete button clicked
    $('.delete-icon').click(function () {

        console.log("delete button clicked");

        var table_id = $('.survey-id').val();
        $.ajax({
            type: "POST",
            url: "/admin/changeSurvey/delete",
            data: {
                id: table_id
            }
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
    console.log("chart");
    var ctx = $('.chart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

});

function bindPencilEvents() {
    //noChange button clicked
    $('.noChange-icon').click(function () {
        var parentTR = $(this).parents("tr");
        var parentTD = $(this).parent();
        var table_question = parentTR.children('td.table-question').find('input');
        var table_start = parentTR.children('td.table-start').find('input');
        var table_end = parentTR.children('td.table-end').find('input');
        var table_count = parentTR.children('td.table-count').find('input');
        var table_activity = parentTR.children('td.table-activity').find('input');

        var table_question_oldValue = table_question.val();
        var table_start_oldValue = table_start.val();
        var table_end_oldValue = table_end.val();
        var table_count_oldValue = table_count.val();
        var table_activity_oldValue = table_activity.val();
        $(parentTD).children('a').remove();
        $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');


        $(table_question.parent()).html(table_question_oldValue);
        $(table_start.parent()).html(table_start_oldValue);
        $(table_end.parent()).html(table_end_oldValue);
        $(table_count.parent()).html(table_count_oldValue);
        $(table_activity.parent()).html(table_activity_oldValue);
        bindPencil();
    });

    //save button clicked
    $('.save-icon').click(function () {
        var table_id = $('.survey-id').val();
        var table_question_newValue = $('.table-question').val();
        var table_start_newValue = $('.table-start').val();
        var table_end_newValue = $('.table-end').val();
        var table_count_newValue = $('.table-count').val();
        var table_activity_newValue = $('.table-activity').val();
        $.ajax({
            type: "POST",
            url: "/admin/changeSurvey/change",
            data: {
                id: table_id,
                question: table_question_newValue,
                date_start: table_start_newValue,
                date_end: table_end_newValue,
                count: table_count_newValue,
                activity: table_activity_newValue
            },
            success: function () {
                $(parentTD).children('a').remove();
                $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');

                $(table_question).html(table_question_newValue);
                $(table_start).html(table_start_newValue);
                $(table_end).html(table_end_newValue);
                $(table_count).html(table_count_newValue);
                $(table_activity).html(table_activity_newValue);
                bindPencil();
            }
        });
    });
}
function bindPencil() {
    //change survey
    $('.info-icon').click(function () {
        var parentTR = $(this).parents("tr");
        var parentTD = $(this).parent();
        var table_question = parentTR.children('td.table-question');
        var table_start = parentTR.children('td.table-start');
        var table_end = parentTR.children('td.table-end');
        var table_count = parentTR.children('td.table-count');
        var table_activity = parentTR.children('td.table-activity');

        var table_question_oldValue = table_question.text();
        var table_start_oldValue = table_start.text();
        var table_end_oldValue = table_end.text();
        var table_count_oldValue = table_count.text();
        var table_activity_oldValue = table_activity.text();

        $(table_question).html('<input class="table-question" name="table-question" value="' + table_question_oldValue + '" />');
        $(table_start).html('<input class="table-start" name="table-start" value="' + table_start_oldValue + '" />');
        $(table_end).html('<input class="table-end" name="table-end" value="' + table_end_oldValue + '" />');
        $(table_count).html('<input class="table-count" name="table-count" value="' + table_count_oldValue + '" />');
        $(table_activity).html('<input class="table-activity" name="table-activity" value="' + table_activity_oldValue + '" />');

        //remove pencil icon
        $(this).remove();
        $(parentTD).html('<a class="save-icon"><i class="fa fa-check" aria-hidden="true"></i></a>' +
            '<a class="noChange-icon"><i class="fa fa-times" aria-hidden="true"></i></a>');
        bindPencilEvents();
    });
}