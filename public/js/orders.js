$(document).ready(function () {
    getOrders();

    // $("#addSong").click(function () {
    //     console.log(readSongs());
    //     const list = $("fieldset:nth-child(2) > ul");
    //     let count = $(list).children().length + 1;
    //     const songTemplate = `
    //     <li>
    //         <label for="songTitle_${count}">Titolo</label>
    //         <input id="songTitle_${count}" type="text" placeholder="titolo"/>
    //         <label for="songDuration_${count}">Durata</label>
    //         <input id="songDuration_${count}" type="text" placeholder="mm:ss"/>
    //     </li>`;
    //     $(list).append(songTemplate);
    // });
    // setup confirm modal
    //$(".confirm-modal h2").text("Vuoi eliminare questa notifica?");
    // $(".confirm-modal #yes").click(function () {
    //     deleteNotification($(this).val());
    // });
    // $(".confirm-modal #no").click(function () {
    //     $(".confirm-modal").addClass("hidden");
    // });
});


/**
 * Executes a POST request to server for get user orders. Then calls displayOrders.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 */
 function getOrders() {
    reqHelper.post("order", "getOrder", {}, function (res) {
        if (res.success) {
            orders = res.data;
            console.log(res.data);
            displayOrders(orders);
        } else {
            console.error("An error occurred while getting orders.");
        }
    });
}

function getTotalFromOrder(products){
    let total = 0;
    products.forEach(product => {
        total += product.subprice;
    });
    return total;
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
            const $orderDetails = $('<ul/>');
            for (let j = 0; j < order.products[0].length; j++) {
                const $orderDetail = $(`<li>
                                        <div>
                                        <h3>NomeProdotto</h3>
                                        <span>Prezzo: € ${order.products[0][j].price}</span>
                                        <span>Quantità: ${order.products[0][j].quantity}</span>
                                        <span>Totale: € ${order.products[0][j].subprice}</span>
                                    </div>
                                </li>`);
                $orderDetails.append($orderDetail);
            }

            console.log($orderDetails.children());

            const $order = $(`
            <li>
                    <section class="order-header">
                        <div>
                            <h2 class="date">Ordine del ${order.orderDate}</h2>
                            <span class="total">Totale: € ${getTotalFromOrder(order.products)}</span>
                        </div>
                    </section>
                    <section>
                        <button id="btnChangeState" value="${order.idOrder}"></button>
                        <button id="btnChangeDate" value="${order.idOrder}"></button>
                    </section>
                    <section class="order-details">
                        <h2>Linee d'ordine</h2>
                        ${$orderDetails}
                    </section>
                </li>`);
            
             $("main > .notifications-list").append($order);


        }
    }
}

            // // hide the dot if notification is read
            // $notification.find(".dot").css("visibility", notification.isRead === 1 ? "hidden" : "");

            // // add listener to the button to open the notification
            // $notification.find("button").click(function () {
            //     $notification.find(".message").slideToggle("fast");
            //     $(this).text($(this).text() === "Leggi" ? "Chiudi" : "Leggi");
            //     // notification is not read, update it on db
            //     if (notification.isRead === 0) {
            //         $notification.find(".dot").css("visibility", "hidden");
            //         reqHelper.post("notification", "readnotification", {
            //             notificationId: notification.id
            //         }, function (res) {
            //             if (!res.success) {
            //                 console.error("An error occurred while marking notification as read.");
            //             }
            //         });
            //     }
            // });

            // // add listener to the icon to delete the notification
            // $notification.find(".trash-icon").click(function (event) {
            //     if (!$(".confirm-modal").hasClass("hidden")) {
            //         $(".confirm-modal").addClass("hidden");
            //         return;
            //     }
            //     event.stopPropagation();
            //     $(".confirm-modal").removeClass("hidden");
            //     $(".confirm-modal #yes").val(notification.id);
            // });

/**
 * Executes a POST request to server for accept or decline an order.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 * @param {Number} idOrder id of the order to be accepted or declined
 */
 function changeOrderState(idOrder, state) {
    reqHelper.post("order", "changeState", {
        idOrder: idOrder,
        state: state
        }, function (res) {
        if (res.success) {
            //change graphic to accettato
            //$("#" + notificationId).remove();
        } else {
            console.error("An error occurred while changing order state.");
        }
    });
}


/**
 * Executes a POST request to server for changing order date.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 * @param {Number} orderId id of the order
 */
//spedito o consegnato // da cambiare in numeri.
 function changeOrderDate(idOrder, type) {
    reqHelper.post("order", "setDate", {
        idOrder: idOrder,
        type: type
    }, function (res) {
        if (res.success) {
            //change graphic con data di spedizione o consegna.
        } else {
            console.error("An error occurred while changing order date.");
        }
    });
}
