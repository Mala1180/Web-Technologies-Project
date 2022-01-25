let $cartPreview;
let $togglePreview;
let products = [];

$(document).ready(function () {
    const _URL = new URL(location.href);
    const QUERY = _URL.searchParams.get("query");
    const FILTER = _URL.searchParams.get("filter");
    $("header #search-section input[name=query]").val(QUERY);
    $("header #search-section select[name=filter]").val(FILTER);
    // do search request
    searchProducts(QUERY, FILTER);

    $cartPreview = $("body > aside");
    $togglePreview = $("body > aside > header > button");

    // close / open cart preview
    $togglePreview.click(function () {
        if (window.innerWidth > 992) return;

        const CART_PREVIEW_HEADER_HEIGHT = $("body > aside > header").outerHeight();
        const CART_PREVIEW_MARGINS = 10;
        const CLOSED_CART_PREVIEW_BOTTOM = ($cartPreview.height() + CART_PREVIEW_MARGINS) * -1 + CART_PREVIEW_HEADER_HEIGHT;

        const $img = $(this).find("img");
        // if is closing
        if ($img.attr("src") === "public/img/icons/cancel.png") {
            $img.attr("src", "public/img/icons/up-arrow.png");
            $cartPreview.css("bottom", CLOSED_CART_PREVIEW_BOTTOM);
        } else { // if is opening
            $img.attr("src", "public/img/icons/cancel.png");
            $cartPreview.css("bottom", 0);
        }
    });

    const $searchIcon = $("header section:first-of-type img");
    const $searchInput = $("header section:first-of-type form input[type=text]");
    const $searchFilter = $("header section:first-of-type form select");

    const $goToCart = $("body > aside > footer");

    // search products
    $searchIcon.click(function () {
        searchProducts($searchInput.val(), $searchFilter.find(":selected").val());
    });

    // go to cart
    $goToCart.click(function () {
        location.href = "cart.php";
    });


    getCartEntries();
});

/**
 * Executes a GET request to server for search products. Then calls displayProducts.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {String} query string with the query to be searched
 * @param {String} filter string with the filter to be used (0 = cd, 1 = vinyl)
 * @see displayProducts
 */
function searchProducts(query, filter) {
    if (query.length == 0 && filter.length == 0) return;

    reqHelper.get("search", "search", {
        "query": query,
        "filter": filter,
    }, function (res) {
        if (res.success) {
            products = res.data;
            console.log(products);
            displayProducts(products);
        } else {
            console.error("An error occurred while searching products.");
        }
    });
}

/**
 * Appends products in the page.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} products array of products to be displayed
 */
function displayProducts(products) {
    if (products) {
        $("main").empty();
        for (let i = 0; i < products.length; i++) {
            const product = products[i];
            const $product = $(`
            <section>
                <img src="public/img/products/${product.imgPath}" alt="article image" />
                <aside>
                    <div>
                        <h2>${product.name}</h2>
                        <span>Autore: ${product.author}</span>
                        <span>Tipologia: ${product.type === 0 ? "CD" : "Vinile"}</span>
                        <span>Disponibilità: ${product.quantity}</span>
                    </div>
                    <div>
                        <span>€ ${product.price}</span>
                        <button value="${product.idProduct}">Aggiungi al carrello</button>
                    </div>
                </aside>
            </section>`);

            const DETAILS_LINK = `productDetail.php?id=${product.idProduct}`;
            $product.children().eq(0).click(function () {
                location.href = DETAILS_LINK;
            });
            $product.find("h2").click(function () {
                location.href = DETAILS_LINK;
            });
            $product.find("button").click(function () {
                addToCart(parseInt($(this).val()));
            });
            $("main").append($product);
        }
    }
}

//function that populate the cart client side
function addToCart(idProduct) {
    if (idProduct > 0) {
        reqHelper.post("cart", "addEntry", {
            idProduct: idProduct
        },
        function (data) {
            if (data.success) {
                Swal.fire("", "prodotto aggiunto al carrello", "success");
                getCartEntries();
                // products.forEach(product => {
                //     if (product.idProduct === idProduct) {
                //         if ($cartPreview.is(":hidden")) {
                //             $cartPreview.fadeIn("medium");
                //         }
                //         const $articlePreview = $(`
                //         <li>
                //             <section>
                //                 <div>
                //                     <img src="public/img/vinile1.jpg" alt="article image" />
                //                     <h2>Nome Vinile molto lungo</h2>
                //                 </div>
                //                 <div>
                //                     <span class="material-icons-outlined">remove</span>
                //                     <span>2</span>
                //                     <span class="material-icons-outlined">add</span>
                //                 </div>
                //             </section>
                //         </li>`);
                //         $("aside ul").append($articlePreview);
                //     }
                // });
            } else {
                Swal.fire("", "Verifica la disponibilità del prodotto", "error");
            }
        });
    }
}

/**
 * Executes a GET request to server for getting cart entries. Then calls updateCartPreview.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @see updateCartPreview
 */
function getCartEntries() {
    // get cart entries
    reqHelper.get("cart", "getcart", {}, function (res) {
        if (res.success) {
            updateCartPreview(res.data);
        }
    });
}


/**
 * Appends cart entries in the cart preview.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} cartEntries array of cart entries to be displayed
 */
function updateCartPreview(cartEntries) {
    if (cartEntries) {
        const $cartPreviewList = $("aside ul");
        $cartPreviewList.empty();
        for (let i = 0; i < cartEntries.length; i++) {
            const cartEntry = cartEntries[i];
            console.log(cartEntry);
            const $articlePreview = $(`
            <li id="${cartEntry.idCartEntry}">
                <section>
                    <div>
                        <img src="public/img/products/${cartEntry.imgPath}" alt="" />
                        <h2>(${cartEntry.type === 0 ? "CD" : "Vinile"}) ${cartEntry.name}</h2>
                    </div>
                    <div>
                        <span class="material-icons-outlined remove">remove</span>
                        <span>${cartEntry.quantity}</span>
                        <span class="material-icons-outlined add">add</span>
                    </div>
                </section>
            </li>`);
            $cartPreviewList.append($articlePreview);
            $articlePreview.find("span.remove").click(function () {
                // if quantity is 1, remove the entry
                if (cartEntry.quantity - 1 === 0) {
                    reqHelper.post("cart", "removeentry", {
                        idCartEntry: cartEntry.idCartEntry
                    }, function (data) {
                        if (data.success) {
                            Swal.fire("", "Articolo rimosso correttamente", "success");
                            getCartEntries();
                        } else {
                            console.error("An error occurred while removing an entry from cart.");
                        }
                    });
                } else {
                    modifyEntryCartQuantity(parseInt(cartEntry.idCartEntry), cartEntry.quantity - 1);
                }
            });
            $articlePreview.find("span.add").click(function () {
                modifyEntryCartQuantity(parseInt(cartEntry.idCartEntry), cartEntry.quantity + 1);
            });
        }
        if ($cartPreviewList.children().length > 0 && $cartPreview.is(":hidden")) {
            $cartPreview.slideDown();
        }
    }
}

/**
 * Executes a POST request to server for modiy a cart entry quantity.
 * 
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} idCartEntry 
 * @param {Number} quantity 
 */
function modifyEntryCartQuantity(idCartEntry, quantity) {
    reqHelper.post("cart", "setquantity", {
        idCartEntry: idCartEntry,
        quantity: quantity
    }, function (data) {
        if (data.success) {
            Swal.fire("", "Modifica effettuata correttamente", "success");
            getCartEntries();
        } else {
            Swal.fire("", "Verifica la disponibilità del prodotto", "error");
        }
    });
}