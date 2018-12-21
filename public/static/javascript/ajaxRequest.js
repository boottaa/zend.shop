/**
 * Created by b.akhmedov on 12.12.18.
 */
function sendGetRequest(url, callback){
    if(callback === undefined){
        callback = function () {}
    }

    $('.sendGetRequest').remove();
    $.get(url, function(result){
        $('body').prepend("<div class=\"alert alert-danger alert-dismissible fade show sendGetRequest\" style='position: fixed; z-index: 9999; right: 20%; top 10%;' role=\"alert\"> \
        " + result + " \
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> \
            <span aria-hidden=\"true\">&times;</span> \
        </button> \
        </div>");


        $('.sendGetRequest').delay(1000).fadeOut("slow", callback());
    });
}