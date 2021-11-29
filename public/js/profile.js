document.querySelector('#btnMyProfile').addEventListener('click', async (e) => {
    e.preventDefault();
    requireUserInfo();
  });
  
  async function requireUserInfo() {
    const res = await reqHelper.makeRequest("POST", "actions",
      {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'},
      {"action" : "myprofile", 
      "Authorization" : jwt.getJWT()});
  
    if (res.status >= 200 && res.status <= 299) {
      console.log(await res.text());
    } else {
      console.log(res.status, res.statusText);
    }
  }