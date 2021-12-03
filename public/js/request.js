$(document).ready(function () {
    $("#GetResource").click((e) => {
        reqHelper.post("resource", "", {}, function (data) {
            console.log(data);
        });
    });
});
