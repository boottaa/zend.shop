/**
 * Created by b.akhmedov on 12.12.18.
 */
function sendGetRequest(url){
    $.get(url, function(result){
        alert("Товар добавлен " + result);
    });
}