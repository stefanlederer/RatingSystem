/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function () {
    $(".button-form").submit(function (event) {

        console.log('clicked');

        $('.button').prop("disabled", true);
        $('.popUp').css("visibility","visible");
        setTimeout(function () {
            $('.button').prop("disabled", false);
            $('.popUp').css("visibility","hidden");
        }, 3000);

        var buttontype = $('.button').val();
        console.log(buttontype);
        $.ajax({
            type: "POST",
            url: "/",
            data: {
                button: buttontype
            },
            success: console.log("success")
        });

        event.preventDefault();
    });
});
