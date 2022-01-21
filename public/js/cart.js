$(document).ready(function () {
    reqHelper.get("cart", "getcart", {}, function (data) {
        data.data.forEach(e => {
            let cartHtml = `
            <section class="cart-item">  
                <img src="public/img/ordini.jpg" alt="" />
                <section>
                    <header>
                        <h2>${e.name}</h2>
                        <span>€${e.price}</span>
                    </header>
                    <p>${e.type == 0 ? "CD" : "Vinile"} di ${e.artName} - ${e.quantity} pezzi</p>
                    <footer>
                        <form id="form_${e.idCartEntry}"method="POST" action="#">
                            <label for="quantity">Quantità</label><input id="quantity_${e.idCartEntry}" type="number" min="1" max="99" name="quantity" value="${e.quantity}"/><input id="saveQuantity_${e.idCartEntry}" type="submit" value="Salva"/>
                        </form>
                        <button id="editQuantity_${e.idCartEntry}">Modifica quantità</button><button id="remove_${e.idCartEntry}">Rimuovi</button>
                    </footer>
                </section>
            </section>
            `
            $("main > div").append(cartHtml);
            $("#form_" + e.idCartEntry).submit(function (event) {
                reqHelper.post("cart", "setquantity", {
                    idCartEntry: e.idCartEntry,
                    quantity: $("#quantity_" + e.idCartEntry).val()
                });
            })

            $("#remove_" + e.idCartEntry).click(function () {
                reqHelper.post("cart", "removeentry", {
                    idCartEntry: e.idCartEntry
                }, function (data) {
                    console.log(data);
                });
            });

            $("#editQuantity_" + e.idCartEntry).click(function () {
                $("#form_" + e.idCartEntry).show();
                $(this).hide().next().hide();
            });
        });
    })
});