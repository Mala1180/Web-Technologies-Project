$(document).ready(function () {
    const $modifyButton = $("main form input[type=button]");

    $modifyButton.click(function () {
        if ($(this).val() === "Modifica dati") {
            $(this).val("Conferma modifiche");
            $("form input").prop("disabled", false);
        } else {
            $(this).val("Modifica dati");
            $("form input").not(this).prop("disabled", true);
            modifyInfo();
        }
    });   

    getUserInfo();
});



function getUserInfo() {
    reqHelper.post("userMgr", "getUserInfo", {}, function(data) {
        console.log(data);
        if (data.success) {
            let info = data.data[0];
            $("#name").val(info.name);
            $("#surname").val(info.surname);
            $("#username").val(info.username);
            $("#email").val(info.email);
        } else {
            console.error("Error while getting user info");
        }
    });
}


function modifyInfo() {
    reqHelper.post("userMgr", "updateUserInfo", {
        "name": $("#name").val(),
        "surname": $("#surname").val(),
        "username": $("#username").val(),
        "email": $("#email").val(),
    }, function (data) {
        if (data.success) {
            console.log("User info updated");
        } else {
            console.error("Error while modifying user info");
        }
    });
}