$(document).ready(function () {
    $("#SubmitLogin").click((e) => {
        e.preventDefault();
        const userType = $("input[type=radio]:checked").val();
        login(txtUsername.value, txtPassword.value, userType);
    });

    function login(username, password, type) {
        $("section > p:first-of-type").hide();
        reqHelper.post("userAccess", "login", {
            "username": username,
            "password": password,
            "type": type
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
