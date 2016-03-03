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

            $('.button').prop("disabled", true);
            $('.popUp').css("visibility", "visible");
            setTimeout(function () {
                $('.button').prop("disabled", false);
                $('.popUp').css("visibility", "hidden");
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
});
