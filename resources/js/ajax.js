$(document).ready(function () {
    $("#box-search").submit(function (e) {
        e.preventDefault();
        doSearch(1);
        return;
    });
    // doSearch(1);
})
function doSearch(page) {
    var url = $("#box-search").prop("action");
    var data = $("#box-search").serializeArray();
    data.push({ "name": "page", "value": page });
    console.log(data);

    $.ajax({
        url: url,
        type: "GET",
        data: data,
        error: function () {
            alert("Your request is not valid!");
        },
        success: function (data) {
            $("html").html(data);
        }
    });

    return;
}
