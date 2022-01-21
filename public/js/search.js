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
        search($searchInput.val(), $searchFilter.find(":selected").text());
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
 * @return {Array} array of products
 */
function searchProducts(query, filter) {
    if (query.length == 0 && filter.length == 0) return;

    reqHelper.get("search", "search", {
        "query": query,
        "filter": filter,
    }, function (data) {
        if (data.success) {
            products = data.data;
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
 * @return {None}
 */
function displayProducts(products) {
    if (products) {
        for (let i = 0; i < products.length; i++) {
            const product = products[i];
            const $product = $(`
            <section>
                <img src="public/img/products/${product.imgPath}" alt="article image" />
                <aside>
                    <div>
                        <h2>${product.name}</h2>
                        <p>Lorem ipsum dolor sit amet  jd ffu eufgfugefugf ue gudw dwu gu expedita.</p>
                        <span>Tipologia: ${product.type == 0 ? "CD" : "Vinile"}</span>
                        <span>Disponibilità: ${product.quantity}</span>
                    </div>
                    <div>
                        <span>€ ${product.price}</span>
                        <input type="button" value="Aggiungi al carrello" />
                    </div>
                </aside>
            </section>`);

            $product.click(function () {
                location.href = `articleDetail.php?id=${product.idProduct}`;
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
