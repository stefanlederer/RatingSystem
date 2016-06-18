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

    //change survey
    $('.info-icon').click(function() {
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

        $(table_question).html('<input class="table-question" name="table-question" value="'+table_question_oldValue+'" />');
        $(table_start).html('<input class="table-start" name="table-start" value="'+table_start_oldValue+'" />');
        $(table_end).html('<input class="table-end" name="table-end" value="'+table_end_oldValue+'" />');
        $(table_count).html('<input class="table-count" name="table-count" value="'+table_count_oldValue+'" />');
        $(table_activity).html('<input class="table-activity" name="table-activity" value="'+table_activity_oldValue+'" />');

        //remove pencil icon
        $(this).remove();
        $(parentTD).html('<a class="save-icon"><i class="fa fa-check" aria-hidden="true"></i></a>' +
            '<a class="noChange-icon"><i class="fa fa-times" aria-hidden="true"></i></a>');

        //noChange button clicked
        $('.noChange-icon').click(function() {
            $(parentTD).children('a').remove();
            $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');

            $(table_question).html(table_question_oldValue);
            $(table_start).html(table_start_oldValue);
            $(table_end).html(table_end_oldValue);
            $(table_count).html(table_count_oldValue);
            $(table_activity).html(table_activity_oldValue);
        });

        //save button clicked
        $('.save-icon').click(function() {
            var table_question_newValue = $('.table-question').val();
            var table_start_newValue = $('.table-start').val();
            var table_end_newValue = $('.table-end').val();
            var table_count_newValue = $('.table-count').val();
            var table_activity_newValue = $('.table-activity').val();

            $.ajax({
                type: "POST",
                url: "",
                data: {
                    question: table_question_newValue,
                    date_start: table_start_newValue,
                    date_end: table_end_newValue,
                    count: table_count_newValue,
                    activity: table_activity_newValue
                },
                success: function() {
                    $(parentTD).children('a').remove();
                    $(parentTD).html('<a class="info-icon"><i class="fa fa-pencil" aria-hidden="true"></i></a>');

                    $(table_question).html(table_question_newValue);
                    $(table_start).html(table_start_newValue);
                    $(table_end).html(table_end_newValue);
                    $(table_count).html(table_count_newValue);
                    $(table_activity).html(table_activity_newValue);
                }
            });
        });

        //delete button clicked
        $('.delete-icon').click(function() {
            $.ajax({
                
            });
        });

    });



});
