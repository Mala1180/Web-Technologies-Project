document.querySelector('#GetResource').addEventListener('click', async (e) => {
    const res = await reqHelper.makeRequest("POST", "resource", {'Authorization': 'Bearer ' + jwt.getJWT()}, {'Authorization': jwt.getJWT()});
    const esito = await res.text();
    console.log(esito);
});