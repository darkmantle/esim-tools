var url = "/change-server";

//delete task and remove it from list
window.onServerChange = function (server) {

    $.ajax({
        type: "GET",
        url: url + '/' + server,
        success: function (data) {
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}