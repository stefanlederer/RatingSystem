/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function() {
    var value;
    $('.button').click(function (e) {
        e.preventDefault();
        value = $(this).val();
        $('.button-form').submit();
    });
    $('.button-form').submit(function (e) {
        e.preventDefault();

        console.log(value);
        var url = "/abgabe";
        $.post( url, {
            button: value
        }).fail(function() {
            console.log( "error" );
        });
    });
});
