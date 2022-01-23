let $cartPreview;
let $previewTitle;
let $closePreview;
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
    $previewTitle = $("body > aside > header > h2");
    $closePreview = $("body > aside > header > img");

    const CART_PREVIEW_HEADER_HEIGHT = $("body > aside > header").outerHeight();
    const CART_PREVIEW_MARGINS = 10;
    const CLOSED_PREVIEW_BOTTOM = ($cartPreview.height() + CART_PREVIEW_MARGINS) * -1 + CART_PREVIEW_HEADER_HEIGHT;

    // close / open cart preview
    $closePreview.click(function () {
        togglePreview(CLOSED_PREVIEW_BOTTOM, "100%", $closePreview);
    });

    $previewTitle.click(function () {
        togglePreview(0, "0%", $closePreview);
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
});

/**
 * Executes a GET request to server for search products. Then calls displayProducts.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {String} query string with the query to be searched
 * @param {String} filter string with the filter to be used (0 = cd, 1 = vinyl)
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
                        <span>Autore: ${product.name}</span>
                        <span>Tipologia: ${product.type == 0 ? "CD" : "Vinile"}</span>
                        <span>Disponibilità: ${product.quantity}</span>
                    </div>
                    <div>
                        <span>€ ${product.price}</span>
                        <button>Aggiungi al carrello</button>
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

            $("main").append($product);
        }
    }
}

/**
 * Toggles the cart preview.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} bottom integer value of the bottom position of the cart preview
 * @param {String} titleWidth string with the width of the title in percentage
 * @return {None}
 */
function togglePreview(bottom, titleWidth) {
    if (window.innerWidth > 992) return;

    $cartPreview.css("bottom", bottom);
    $previewTitle.css("width", titleWidth);

    if (bottom === 0) {
        setTimeout(() => {
            $closePreview.fadeIn(50);
        }, 500);
    } else {
        $closePreview.fadeOut(50);
    }
}


function readProduct() {
    let product;

    //legge prodotto dal bottone, accordo con malachia
    addToCart(products[0].idProduct, 5);
}

//function that populate the cart client side
function addToCart(idProduct, quantity) {
    if(quantity > 0 && idProduct > 0){
        reqHelper.post("cart", "addEntry", {
            idProduct: idProduct,
            quantity: quantity
        },
        function (data) {
            if (data.success) {
                console.log(data)
            }
        });
    }
}
