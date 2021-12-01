document.querySelector('#btnAddCard').addEventListener('click', async (e) => {
    e.preventDefault();
    addCardToUser(txtCardNumber.value, txtCircuit.value, expiryDateCreditCard.value, cmbDefault.checked);
  });
  
  async function addCardToUser($cardNumber, $circuit, $expiryDate, $isDefault) {
    const res = await reqHelper.makeRequest("POST", "actions",
      {'Content-type' : 'application/x-www-form-urlencoded; charset=UTF-8'},
      {"action" : "addcard", 
      "Authorization" : jwt.getJWT(), 
      "cardNumber": $cardNumber,
      "circuit": $circuit, 
      "expiryDate": $expiryDate,
      "isDefault" : $isDefault});
  
    if (res.status >= 200 && res.status <= 299) {
      console.log(await res.text());
    } else {
      console.log(res.status, res.statusText);
    }
  }