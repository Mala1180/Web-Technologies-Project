let $cartPreview;
let $previewTitle;
let $closePreview;

$(document).ready(function () {
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

    // $searchInput.keypress(function (e) {
    //     if (e.key === "Enter") {
    //         console.log($searchInput.val());
    //         search($searchInput.val(), $searchFilter.find(":selected").text());
    //         e.preventDefault();
    //     }
    // });

    // go to cart
    $goToCart.click(function () {
        location.href = "cart.php";
    });
});

function search(query, filter) {
    if (query.length > 0) {
        reqHelper.get("search", "search", { query: query, filter: filter }, function (data) {
            console.log(data);
        });
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
