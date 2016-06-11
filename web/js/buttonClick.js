/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function () {
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

    //get answerOption boxes
    $(".answerQuantity").change(function () {
        $("input[class=options]").remove();
        var quantity = $(".answerQuantity option:selected").text();
        console.log(quantity);
        for (var i = 1; i <= quantity; i++) {
            $('.answerOption').append('<input type="text" class="options"/>');
        }
    });
});
