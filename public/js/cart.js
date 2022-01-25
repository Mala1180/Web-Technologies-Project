function populateCart() {
    reqHelper.get("cart", "getcart", {}, function (data) {
        const cartEntries = data.data;
        if (cartEntries.length) {
            $("main > p").hide();
            $("main > footer").show();
        } else {
            $("main > footer").hide();
            $("main > p").show();
        }
        console.log(cartEntries);
        cartEntries.forEach(cartEntry => {
            let $cartHtml = $(`
            <li class="cart-item">  
                <img src="./public/img/products/${cartEntry.imgPath}" alt="" />
                <section>
                    <header>
                        <h2>${cartEntry.name}</h2>
                        <span>€${cartEntry.price}</span>
                    </header>
                    <p>${cartEntry.type == 0 ? "CD" : "Vinile"} di ${cartEntry.artName} - ${cartEntry.quantity} pezzi</p>
                    <footer>
                        <form id="form_${cartEntry.idCartEntry}"method="POST" action="#">
                            <label for="quantity">Quantità</label><input id="quantity_${cartEntry.idCartEntry}" type="number" min="1" name="quantity" value="${cartEntry.quantity}"/> <input id="saveQuantity_${cartEntry.idCartEntry}" type="submit" value="Salva"/>
                        </form>
                        <button id="editQuantity_${cartEntry.idCartEntry}">Modifica quantità</button> <button id="remove_${cartEntry.idCartEntry}">Rimuovi</button>
                    </footer>
                </section>
            </li>`);
            $("main > ul").append($cartHtml);
            $("#form_" + cartEntry.idCartEntry).submit(function (event) {
                event.preventDefault();
                reqHelper.post("cart", "setquantity", {
                    idCartEntry: cartEntry.idCartEntry,
                    quantity: $("#quantity_" + cartEntry.idCartEntry).val()
                }, function (data) {
                    if (data.success) {
                        $(".cart-item").remove();
                        Swal.fire("", "Quantità modificata con successo", "success");
                        populateCart();
                    } else {
                        Swal.fire("", "Verifica la disponibilità del prodotto", "error");
                    }
                });
            });

            $("#remove_" + cartEntry.idCartEntry).click(function () {
                reqHelper.post("cart", "removeentry", {
                    idCartEntry: cartEntry.idCartEntry
                }, function (data) {
                    if (data.success) {
                        $(".cart-item").remove();
                        populateCart();
                    }
                });
            });

            $("#editQuantity_" + cartEntry.idCartEntry).click(function () {
                $("#form_" + cartEntry.idCartEntry).show();
                $(this).hide().next().hide();
            });
        });
    })
}
$(document).ready(function () {
    populateCart();
});