$(document).ready(function () {
    getOrders();

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
 * Executes a GET request to server for get user orders. Then calls displayOrders.
 *
 * @author Alberto Paganelli <albi1600@gmail.com>
 */
 function getOrders() {
    reqHelper.post("order", "getOrder", {}, function (res) {
        if (res.success) {
            orders = res.data;
            console.log(orders);
            //displayOrders(orders);
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
        $("main > .notifications-list").empty();
        for (let i = 0; i < notifications.length; i++) {
            const notification = notifications[i];
            const $notification = $(`
            <li id="${notification.id}">
                <div>
                    <div>
                        <div>
                            <span class="dot"></span>
                            <h2 class="subject">${notification.subject}</h2>
                        </div>
                        <span class="date">${notification.date}</span>
                    </div>
                    <div>
                        <button>Leggi</button>
                        <img class="trash-icon" src="./public/img/icons/bin.png" alt="trash bin icon" tabindex="0">
                    </div>
                </div>
                <p class="message">${notification.message}</p>
            </li>`);
            
            $("main > .notifications-list").append($notification);

            // hide the dot if notification is read
            $notification.find(".dot").css("visibility", notification.isRead === 1 ? "hidden" : "");

            // add listener to the button to open the notification
            $notification.find("button").click(function () {
                $notification.find(".message").slideToggle("fast");
                $(this).text($(this).text() === "Leggi" ? "Chiudi" : "Leggi");
                // notification is not read, update it on db
                if (notification.isRead === 0) {
                    $notification.find(".dot").css("visibility", "hidden");
                    reqHelper.post("notification", "readnotification", {
                        notificationId: notification.id
                    }, function (res) {
                        if (!res.success) {
                            console.error("An error occurred while marking notification as read.");
                        }
                    });
                }
            });

            // add listener to the icon to delete the notification
            $notification.find(".trash-icon").click(function (event) {
                if (!$(".confirm-modal").hasClass("hidden")) {
                    $(".confirm-modal").addClass("hidden");
                    return;
                }
                event.stopPropagation();
                $(".confirm-modal").removeClass("hidden");
                $(".confirm-modal #yes").val(notification.id);
            });
        }
    }
}

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
