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
            const summary = order.order[0];
            const $order = $(`
            <li>
                <section class="order-header">
                    <div>
                        <h2 class="date">Ordine del ${summary.orderDate}</h2>
                        <span class="total"></span>
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
                    </ul>
                </section>
            </li>
            `);
            $("main > .orders-list").append($order);
            // solve accessibility problem
            $order.find("." + summary.state).siblings().attr("aria-hidden", "true");
            if (summary.state === 1) {
                $order.find(".order-storyline")
                     .children()
                     .eq(3).prevAll()
                     .css("background", "#3a71ea")
                     .css("border-color", "#3a71ea");
            }
            if (summary.state === 2) {
                $order.find(".order-storyline").children().css("background", "#3a71ea")
                                                          .css("border-color", "#3a71ea");
            }
            $order.find("button").click(function () {
                $order.find(".order-details").slideToggle("fast");
            });

            const products = order.products[0];
            let orderTotal = 0;
            for (const product of products) {
                const $product = $(`
                <li id="${product.idProduct}">
                    <img src="./public/img/products/${product.imgPath}" alt="immagine dell'album">
                    <div>
                        <h3>${product.name}</h3>
                        <span>Prezzo: € ${product.subprice / product.quantity}</span>
                        <span>Quantità: ${product.quantity}</span>
                        <span>Totale: € ${product.subprice}</span>
                    </div>
                </li>`);
                $order.find(".order-details > ul").append($product);

                $product.find("img").click(function () {
                    location.href = `./productDetail.php?id=${product.idProduct}`;
                });
                $product.find("h3").click(function () {
                    location.href = `./productDetail.php?id=${product.idProduct}`;
                });
                orderTotal += product.subprice;
            }
            $order.find(".total").text(`Totale: € ${Math.round(orderTotal * 100) / 100}`);

        }
    }
}