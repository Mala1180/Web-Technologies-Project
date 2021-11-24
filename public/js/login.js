    //store is the store for the jwt for now.. :(
    const reqHelper = new RequestHelper();
    const jwt = new MyJWT();

    document.querySelector('#SubmitLogin').addEventListener('click', async (e) => {
      e.preventDefault();

      //make post request with the helper, eh 
      const res = await reqHelper.makeRequest("POST", "login",
        {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'},
        {"username": txtEmail.value, "password": txtPassword.value});

      if (res.status >= 200 && res.status <= 299) {
        jwt.setJWT(await res.text());
      } else {
        console.log(res.status, res.statusText);
      }
    });

    document.querySelector('#GetResource').addEventListener('click', async (e) => {

      const res = await reqHelper.makeRequest("POST", "resource", {'Authorization': 'Bearer ' + jwt.getJWT()}, {'Authorization': jwt.getJWT()});
      const esito = await res.text();
      console.log(esito);
    });