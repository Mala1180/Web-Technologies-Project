$(document).ready(function () {
    $("#btnRequestChange").click((e) => {
        e.preventDefault();
        requestChangePassword();
    });
});



function requestChangePassword() {
    reqHelper.get("password_recovery", "requestChange", {
        "mail": txtMail.value,
        "type": "cliente"
    }, function (data) {
        console.log(data);
    });
}
