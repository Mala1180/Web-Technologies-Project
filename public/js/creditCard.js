$(document).ready(function () {
    $("#btnAddCard").click((e) => {
        e.preventDefault();
        addCardToUser(txtCardNumber.value, txtCircuit.value, expiryDateCreditCard.value, cmbDefault.checked);
    });

    function addCardToUser($cardNumber, $circuit, $expiryDate, $isDefault) {
        reqHelper.post("userMgr", "addcard", {
            "cardNumber": $cardNumber,
            "circuit": $circuit,
            "expiryDate": $expiryDate,
            "isDefault": $isDefault
        }, function (data) {
            console.log(data);
        });
    }
});