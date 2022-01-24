$(document).ready(function () {
    $("#btnRequestChange").click((e) => {
        e.preventDefault();
        requestChangePassword();
    });
});


// function changePassword() {
//     reqHelper.get("password_recovery", "recover", {
//         "mail": txtMail.value,
//         "type": "cliente"
//     }, function (data) {
//         console.log(data);
//     });
// }


function requestChangePassword() {
    reqHelper.get("password_recovery", "requestChange", {
        "mail": txtMail.value,
        "type": "cliente"
    }, function (data) {
        console.log(data);
    });
}
