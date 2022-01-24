$(document).ready(function () {
    $("#btnSelectCard").click((e) => {
        e.preventDefault();
        readCardData();
    });
    $("#btnAddCard").click((e) => {
        e.preventDefault();
        readCardData();
    });

    $("#btnProceed").click((e) => {
        e.preventDefault();
        addOrder();
    });
    getPaymentDetails();
    getMyCards();
});

function readCardData() {
    if (cardHolder.value != "" && cardNumber.value != "" && cardCircuit.value != "" && cardExpiration.value != "" && cardCvv.value != "") {
        addCardToUser(cardHolder.value, cardNumber.value, cardCircuit.value, cardExpiration.value + "-01", cardCvv.value, isDefault.checked);
    }
}

function addCardToUser(cardHolder, cardNumber, circuit, expiryDate, cvv, isDefault) {
    reqHelper.post("card", "addCard", {
        "holder": cardHolder,
        "cardNumber": cardNumber,
        "circuit": circuit,
        "expiryDate": expiryDate,
        "cvv": cvv,
        "isDefault": isDefault
    }, function (data) {
        console.log(data);
        getMyCards();
    });
}


function addOrder() {
    reqHelper.post("order", "addOrder", {
        "cardNumber": selectCard.value
    }, function (data) {
        Swal.fire("", "Ordine effettuato correttamente", "success");
    });
}


function getMyCards() {
    reqHelper.post("card", "getCard", {},
    function(data) {
       if (data.success) {
        document.getElementById("selectCard").options.length = 0;
        for (let i = 0; i < data.data.length; i++){
            var opt = document.createElement('option');
            opt.value = data.data[i]["number"];
            opt.innerHTML = data.data[i]["number"];
            selectCard.appendChild(opt);
        }
       }
   });
}