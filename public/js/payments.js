let cards = [];

$(document).ready(function() {
    $(".confirm-modal h2").text("Sei sicuro di voler eliminare questa carta?");

    $("#btnAddCard").click((e) => {
        e.preventDefault();
        readCardData();
    });

    getCards();
});


function readCardData() {
    if (cardHolder.value !== "" && cardNumber.value !== "" && cardCircuit.value !== "" &&
        cardExpiration.value !== "" && cardCvv.value !== "") {
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
        getCards();
    });
}


/**
 * Gets user cards from the server. Then calls displayCards function.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 */
function getCards() {
    reqHelper.post("card", "getCard", {},
    function(data) {
        if (data.success) {
            // document.getElementById("selectCard").options.length = 0;
            // for (let i = 0; i < data.data.length; i++){
            //     var opt = document.createElement('option');
            //     opt.value = data.data[i]["cardNumber"];
            //     opt.innerHTML = data.data[i]["cardNumber"];
            //     selectCard.appendChild(opt);
            // }
            cards = data.data;
            console.log(cards);
            displayCards(cards);
        }
   });
}

/**
 * Appends user cards in the list.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Array} cards array of cards
 */
function displayCards(cards) {
    if (cards) {
        $("main .cards-list").empty();
        for (let i = 0; i < cards.length; i++) {
            const card = cards[i];
            const cardNumber = card.number.match(/.{1,4}/g)[0] + " **** **** " + card.number.match(/.{1,4}/g)[3]
            console.log(cardNumber);
            const $card = $(`
            <li>
                <div class="card-header">
                    <span class="card-number">${cardNumber}</span>
                    <div>
                        <button class="details-button">Dettagli</button>
                        <button class="trash-button">Rimuovi</button>
                    </div>
                </div>
                
                <div class="card-details">
                    <p>Titolare</p>
                    <span class="card-holder">${card.holder}</span>
                    <p>Circuito</p>
                    <span class="card-circuit">${card.circuit}</span>
                    <p>Data di scadenza</p>
                    <span class="card-expiry-date">${card.expiryDate}</span>
                </div>
            </li>
            `);
            $("main .cards-list").append($card);

            $card.find(".details-button").click(function () {
                $card.find(".card-details").slideToggle("fast");
            });
            $card.find(".trash-button").click(function (event) {
                if (!$(".confirm-modal").hasClass("hidden")) {
                    $(".confirm-modal").addClass("hidden");
                    return;
                }
                event.stopPropagation();
                $(".confirm-modal").removeClass("hidden");
                $(".confirm-modal #yes").val(card.id);
            });
        }
    }
}