
document.querySelector('#SubmitLogin').addEventListener('click', async (e) => {
  e.preventDefault();
  login(txtUsername.value, txtPassword.value);
});

async function login(username, password) {
  const res = await reqHelper.makeRequest("POST", "login",
    {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'},
    {"username": username, "password": password});

  if (res.status >= 200 && res.status <= 299) {
    jwt.setJWT(await res.text());
  } else {
    console.log(res.status, res.statusText);
  }
}