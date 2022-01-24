$(document).ready(function () {
    $("#btnRequestChange").click((e) => {
        e.preventDefault();
        requestChangePassword();
    });
    $("#btnChangePassword").click((e) => {
        e.preventDefault();
        changePassword();
    });
});

function getCode() {
    return location.href.split("code=")[1];
}


function changePassword() {
    if(txtNewPassword.value == txtConfirmNewPassword.value) {
        reqHelper.get("password_recovery", "recover", {
            "code": getCode(),
            "newPassword": txtNewPassword.value
        }, function (data) {
            console.log(data);
        });
    }   
}

//DA CAMBIARE TYPE CON SELECT ARTISTA O CLIENTE.
function requestChangePassword() {
    reqHelper.get("password_recovery", "requestChange", {
        "mail": txtMail.value,
        "type": "cliente"
    }, function (data) {
        console.log(data);
    });
}
