/**
 * Created by b.akhmedov on 12.12.18.
 */
function sendGetRequest(url){
    $.get(url, function(result){
        $('div.container').prepend("<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"> \
        " + result + " \
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> \
            <span aria-hidden=\"true\">&times;</span> \
        </button> \
        </div>")
    });
}