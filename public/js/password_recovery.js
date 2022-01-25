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
                Swal.fire("Password modificata", "La sua password è stata modificata con successo", "success")
                .then((result) => {
                    location.href = "./userLogin.php";
                });
            } else {
                Swal.fire("Ops... qualcosa è andato storto", "Qualcosa è andato storto con la modifica della sua password, la preghiamo di riprovare", "error")
                .then((result) => {
                    location.href = "./userLogin.php";
                });
            }
        });
    }   
}

function requestChangePassword() {
    reqHelper.get("password_recovery", "requestChange", {
        "mail": txtMail.value,
        "type": $("input[type=radio]:checked").val()
    }, function (data) {
        if(data.data){
            //location.href = "./userLogin.php"
            Swal.fire("E-Mail inviata", "Ti è stata inviata una mail per il recupero password all'indirizzo " + txtMail.value, "success")
            .then((result) => {
                location.href = "./userLogin.php";
            });
        } else {
            Swal.fire("Ops... qualcosa è andato storto", "Qualcosa è andato storto con la modifica della sua password, la preghiamo di riprovare", "error")
            .then((result) => {
                location.href = "./userLogin.php";
            });
        }
    });
}
