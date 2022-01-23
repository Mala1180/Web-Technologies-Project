$(document).ready(function () {
    getOrders();
});

/**
 * Executes a POST request to server for get user orders. Then calls displayOrders.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 */
 function getOrders() {
    reqHelper.post("order", "getCustomerOrders", {}, function (res) {
        if (res.success) {
            orders = res.data;
            console.log(orders);
            displayOrders(orders);
        } else {
            console.error("An error occurred while getting orders.");
        }
    });
}

/**
 * Appends orders in the list.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Array} orders array of orders to be displayed
 */
function displayOrders(orders) {
    if (orders) {
        $("main > .orders-list").empty();
        for (let i = 0; i < orders.length; i++) {
            const order = orders[i];
            const $order = $(`
            <li id="${order.id}">
                <section class="order-header">
                    <div>
                        <h2 class="date">Ordine del ${order.orderDate}</h2>
                        <span class="total">Totale: € 30</span>
                    </div>
                    <button>Dettagli</button>
                </section>
                <section class="order-storyline">
                    <span class="dot"></span>
                    <span class="line"></span>
                    <span class="dot"></span>
                    <span class="line"></span>
                    <span class="dot"></span>
                </section>
                <section class="order-steps">
                    <span class="0">Ordine effettuato</span>
                    <span class="1">In transito</span>
                    <span class="2">Consegnato</span>
                </section>
                <section class="order-details">
                    <ul>
                        <li>
                            <img src="./public/img/products/TheEminemShow.png" alt="immagine dell'album">
                            <div>
                                <h3>The Eminem Show</h3>
                                <span>Prezzo: € 30</span>
                                <span>Quantità: 2</span>
                                <span>Totale: € 60</span>
                            </div>
                        </li>
                    </ul>
                </section>
            </li>
            `);
            $("main > .orders-list").append($order);
            // solve accessibility problem
            $order.find("." + order.state).siblings().attr("aria-hidden", "true");
            $order.find("button").click(function () {
                $order.find(".order-details").slideToggle("fast");
            });
        }
    }
}