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
                setTimeout(function () {
                    switch (type) {
                        case "cliente":
                            location.href = "/";
                            break;
                        case "artista":
                            location.href = "vendorDashboard.php";
                            break;
                        case "shipper":
                            location.href = "userShipper.php";
                            break;
                    }
                }, 1000);
            } else {
                $("section > p:first-of-type").show();
            }
        });
    }
});
