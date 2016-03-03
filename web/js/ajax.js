/**
 * Created by stefan on 02.03.16.
 */
setInterval(function() {
    query();
}, 3600000); //one hour = 3600000

function query() {
    $.ajax({
        type: "POST",
        url: "/",
        data: "FunctionName=ajax",
        success: successed()
    })
}

function successed() {
    console.log('ajax');
}