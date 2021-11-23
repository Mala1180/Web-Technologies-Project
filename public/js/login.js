    //store is the store for the jwt for now.. :(
    const store = {};
    const loginButton = document.querySelector('#SubmitLogin');
    const form = document.forms[0];

    store.setJWT = (data) => {
      this.JWT = data;
    };

    loginButton.addEventListener('click', async (e) => {
      e.preventDefault();
      const res = await fetch('./login.php', {
        method: 'POST',
        headers: {
          'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        },
        body: JSON.stringify({
          username: txtEmail.value,
          password: txtPassword.value
        })
      });

      if (res.status >= 200 && res.status <= 299) {
        const jwt = await res.text();
        store.setJWT(jwt);
        console.log(jwt);
      } else {
        // Handle errors
        console.log(res.status, res.statusText);
      }
    });

    // btnGetResource.addEventListener('click', async (e) => {
    //   const res = await fetch('/ajax&jwt/basicJWT/public/resource.php', {
    //     headers: {
    //       'Authorization': `Bearer ${store.JWT}`
    //     }
    //   });
    //   const timeStamp = await res.text();
    //   console.log(timeStamp);
    // });