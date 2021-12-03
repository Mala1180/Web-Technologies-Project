$(document).ready(function () {
    $("#btnMyProfile").click((e) => {
        e.preventDefault();
        requireUserInfo();
    });
    function requireUserInfo() {
        reqHelper.post("actions", "myprofile",
            {}, function (data) {
                console.log(data);
            }
        );
    }
});