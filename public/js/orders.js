$(document).ready(function () {
    getOrders();

    $("header #search-section form").remove();
    $("header #search-section").append(`<h1>Ordini</h1>`);
    $("header nav ul li > button#search-button").remove();
    $("header #menu-section a").not(":last-of-type").remove();
});

/**
 * Executes a POST request to server for get user orders. Then calls displayOrders.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 */
 function getOrders() {
    reqHelper.post("order", "getOrder", {}, function (res) {
        if (res.success) {
            displayOrders(res.data);
            console.log(res.data)
        } else {
            console.error("An error occurred while getting orders.");
        }
    });
}

/**
 * Appends orders in the list.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 * @param {Array} orders array of orders to be displayed
 */
 function displayOrders(orders) {
    if (orders) {
        $("main > .orders-list").empty();
        for (let i = 0; i < orders.length; i++) {
            const order = orders[i];
            const $order = $(`
            <li>
                <section class="order-header">
                    <div>
                        <h2 class="date">Ordine #${order["order"][0]["idOrder"]} del ${toITString(order["order"][0]["orderDate"])}</h2>
                        <span class="total">Totale: € ${getTotalFromOrder(order.products[0])}</span>
                        <span class="total">Stato: ${getStringState(order["order"][0]["state"])}</span>
                    </div>
                </section>
                <section>
                    <button id="btnChangeState" value="${order["order"][0]["idOrder"]}"></button>
                </section>
                <section class="order-details">
                    <h2>Linee d'ordine</h2>
                    <ul class="order-details-list">
                        
                    </ul>
                </section>
            </li>`);

            $("main > .orders-list").append($order);

            for (let j = 0; j < order.products[0].length; j++) {
                const $orderDetail = $(`
                <li>
                    <div>
                        <h3>${order.products[0][j].name}</h3>
                        <span>Tipologia: ${getStringType(order.products[0][j].type)}</span>
                        <span>Prezzo: € ${Math.round(order.products[0][j].subprice / order.products[0][j].quantity * 100) / 100}</span>
                        <span>Quantità: ${order.products[0][j].quantity}</span>
                        <span>Totale: € ${order.products[0][j].subprice}</span>
                    </div>
                </li>`);
                $order.find(".order-details-list").append($orderDetail);
            }

            switch (order["order"][0]["state"]) {
                case 0: 
                $order.find("#btnChangeState").html("Spedisci");
                $order.find("#btnChangeState").click(function() {changeOrderState($order.find("#btnChangeState").val(), 1)});
                break;
                case 1: 
                $order.find("#btnChangeState").html("Consegna");
                $order.find("#btnChangeState").click(function() {changeOrderState($order.find("#btnChangeState").val(), 2)});
                break;
                case 2: 
                $order.find("#btnChangeState").remove();
                break;
            }

        }
    }
}

/**
 * Executes a POST request to server for accept or decline an order.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 * @param {Number} idOrder id of the order to be accepted or declined
 * @param {Number} state the state that will be setted
 */
 function changeOrderState(idOrder, state) {
    reqHelper.post("order", "changeState", {
        idOrder: idOrder,
        state: state
        }, function (res) {
        if (res.success) {
            //change graphic to accettato
            getOrders();
        } else {
            console.error("An error occurred while changing order state.");
        }
    });
}

/** Utilities */
function getTotalFromOrder(products) {
    let total = 0;
    products.forEach(product => {
        total += product.subprice;
    });
    return Math.round(total * 100) / 100;
}

//from Y-m-d to d-m-Y
function toITString(date) {
    return date.split("-")[2] + "-" + date.split("-")[1] + "-" + date.split("-")[0];
}

function getStringState(state) {
    switch(state){
        case 0:
        return "Effettuato";
        case 1:
        return "In consegna";
        case 2:
        return "Consegnato";
    }
}

function getStringType(type) {
    switch(type){
        case 0:
        return "CD";
        case 1:
        return "Vinile";
    }
}
