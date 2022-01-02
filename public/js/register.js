$(document).ready(function () {
    $("#SubmitRegister").click((e) => {
        e.preventDefault();
        //make post request with the helper, eh 
        reqHelper.post("userAccess", "register",
            {
                name: txtName.value,
                surname: txtSurname.value,
                email: txtEmail.value,
                username: txtUsername.value,
                password: txtPassword.value
            }, function (data) {
                location.href = "index.php";
            }
        );
    });
})