$(document).ready(function () {
    if (getCode() === undefined) {
        $("#formRecover").hide();      
    }
    else {
        $("#formRequestRecover").hide();
    }
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
            if(data.data){
                location.href = "./userLogin.php"
            } else {
                console.log("Ops... qualcosa è andato storto");
            }
        });
    }   
}

//DA CAMBIARE TYPE CON SELECT ARTISTA O CLIENTE.
function requestChangePassword() {
    reqHelper.get("password_recovery", "requestChange", {
        "mail": txtMail.value,
        "type": $("input[type=radio]:checked").val()
    }, function (data) {
        if(data.data){
            //location.href = "./userLogin.php"
            console.log("Ti è stata inviata una mail per il recupero password all'indirizzo " + txtMail.value);
        } else {
            console.log("Ops... qualcosa è andato storto");
        }
    });
}
