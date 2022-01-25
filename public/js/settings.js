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

/**
 * Executes a POST request to server to get user info. Then display them in the page.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 */
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

/**
 * Executes a POST request to server to modify user info.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 */
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