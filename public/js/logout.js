
document.querySelector('#SubmitLogout').addEventListener('click', async (e) => {
  e.preventDefault();
  logout();
});

async function logout() {
    const res = await reqHelper.makeRequest("POST", "logout",
      {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'});
    if (res.status >= 200 && res.status <= 299) {
      jwt.setJWT(await res.text());
    } else {
      console.log(res.status, res.statusText);
    }
}