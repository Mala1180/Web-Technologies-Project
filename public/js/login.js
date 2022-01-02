$(document).ready(function () {
    $("#SubmitLogin").click((e) => {
        e.preventDefault();
        login(txtUsername.value, txtPassword.value);
    });

    function login(username, password) {
        $("section > p:first-of-type").hide();
        reqHelper.post("userAccess", "login", {
            "username": username,
            "password": password
        }, function (data) {
            if (data.success) {
                jwt.setJWT(data.data);
                location.href = "index.php";
            } else {
                $("section > p:first-of-type").show();
            }
        });
    }
});
