$(document).ready(function () {
    $("#SubmitRegister").click((e) => {
        e.preventDefault();
        //make post request with the helper, eh 
        reqHelper.post("register", "",
            {
                name: txtName.value,
                surname: txtSurname.value,
                email: txtEmail.value,
                username: txtUsername.value,
                password: txtPassword.value
            }, function (data) {
                /*let newUrl = location.href.replace("Register.php", "Login.php");
                location.href = newUrl;*/
                console.log(data);
            }
        );
    });
})