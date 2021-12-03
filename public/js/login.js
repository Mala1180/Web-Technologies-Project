$(document).ready(function () {
    $("#SubmitLogin").click((e) => {
        e.preventDefault();
        login(txtUsername.value, txtPassword.value);
    });

    function login(username, password) {
        reqHelper.post("login", "", {
            "username": username,
            "password": password
        }, function (data) {
            console.log(data);
        });
        /*
         * TODO: Set AuthToken in localStorage
         */
    }
});
