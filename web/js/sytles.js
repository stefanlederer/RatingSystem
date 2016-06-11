/**
 * Created by stefanlederer on 11.06.16.
 */
//for active passive styles in css

// $(document).ready(function() {
//     if($('#username').is(":focus")) {
//         $( ".username" ).addClass("active");
//     }
// });
$(document).ready(function() {

   //datepicker
   //  var nowTemp = new Date();
   //  var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
   //
   //  var checkin = $('#dpd1').datepicker({
   //      onRender: function(date) {
   //          return date.valueOf() < now.valueOf() ? 'disabled' : '';
   //      }
   //  }).on('changeDate', function(ev) {
   //      if (ev.date.valueOf() > checkout.date.valueOf()) {
   //          var newDate = new Date(ev.date)
   //          newDate.setDate(newDate.getDate() + 1);
   //          checkout.setValue(newDate);
   //      }
   //      checkin.hide();
   //      $('#dpd2')[0].focus();
   //  }).data('datepicker');
   //  var checkout = $('#dpd2').datepicker({
   //      onRender: function(date) {
   //          return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
   //      }
   //  }).on('changeDate', function(ev) {
   //      checkout.hide();
   //  }).data('datepicker');

    //get answerOption boxes
    console.log("hello");
    var quantity = $('answerQuantity').val();
    for(var i = 0; i <= quantity; i++) {
        $('.answerOption').append('<input type="text"');
    }
});