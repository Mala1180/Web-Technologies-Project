
document.querySelector('#SubmitRegister').addEventListener('click', async (e) => {
    e.preventDefault();

    //make post request with the helper, eh 
    const res = await reqHelper.makeRequest("POST", "register",
        {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'},
        {"name": txtName.value, "surname": txtSurname.value, "email": txtEmail.value, "username": txtUsername.value, "password":  txtPassword.value});
        
    if (res.status >= 200 && res.status <= 299) {
        $esito = await res.text();
        if($esito){
        let newUrl = location.href.replace("Register.php", "Login.php");
        location.href = newUrl;
        }
    } else {
        //errore nella registrazione.
        console.log(res.status, res.statusText);
    }
});