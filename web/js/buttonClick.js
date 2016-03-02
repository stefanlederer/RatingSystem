/**
 * Created by stefan on 24.02.16.
 */

$(document).ready(function() {
    $('.button').click(function(event) {

        console.log('clicked');
        $('.popUp').css("visibility","visible");
        setTimeout(function() {
            $('.popUp').css("visibility","hidden");
        },4000);

        event.preventDefault();
    });
});
