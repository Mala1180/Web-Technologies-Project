$(document).ready(function () {
    $("#SubmitLogin").click((e) => {
        e.preventDefault();
        login(txtUsername.value, txtPassword.value);
    });

    function login(username, password) {
        reqHelper.post("userAccess", "login", {
            "username": username,
            "password": password
        }, function (data) {
            //da correggere, da errore ma va(??)
            jwt.setJWT(data["data"]);
        });
        /*
         * TODO: Set AuthToken in localStorage
         */
    }
});
