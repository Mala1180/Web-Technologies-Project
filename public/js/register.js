$(document).ready(function () {
    $("input[type=radio][name=type]").change(function () {
        const userType = $("input[type=radio]:checked").val();
        /* se è cliente mostro nome cognome e nascondo nome d'arte */
        if (userType == "artista") {
            $("form > ul > li:first-of-type").hide().next().hide().next().show();
        } else {
            $("form > ul > li:first-of-type").show().next().show().next().hide();
        }
    })

    $("#SubmitRegister").click((e) => {
        e.preventDefault();
        const userType = $("input[type=radio]:checked").val();
        let payload = {
            email: txtEmail.value,
            username: txtUsername.value,
            password: txtPassword.value,
            type: userType
        };
        if (userType == "cliente") {
            payload.name = txtName.value;
            payload.surname = txtSurname.value;
        } else if (userType == "artista") {
            payload.artName = txtArtName.value;
        }
        reqHelper.post("userAccess", "register",
            payload, function (data) {
                console.log(data);
                //location.href = "index.php";
            }
        );
    });
})