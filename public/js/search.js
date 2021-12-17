$(document).ready(function () {
    const $cartPreview = $("body > aside");
    const $previewTitle = $("body > aside > header > h2");
    const $togglePreview = $("body > aside > header > img");

    const CART_PREVIEW_HEADER_HEIGHT = $("body > aside > header").outerHeight();
    const CART_PREVIEW_MARGINS = 10;

    // close / open cart preview
    $togglePreview.click(function () {
        $cartPreview.css("bottom", ($cartPreview.height() + CART_PREVIEW_MARGINS) * -1 + CART_PREVIEW_HEADER_HEIGHT);
        $togglePreview.fadeOut(function () {
            $togglePreview.attr("src", "public/img/icons/up-arrow.png");
            $togglePreview.fadeIn();
        });
    });

    $previewTitle.click(function () {
        $cartPreview.css("bottom", 0);
        $togglePreview.fadeOut(function () {
            $togglePreview.attr("src", "public/img/icons/cancel.png");
            $togglePreview.fadeIn();
        });
    });

    const $searchIcon = $("header section:first-of-type img");
    const $searchInput = $("header section:first-of-type input");
    const $goToCart = $("body > aside > footer");

    // search products
    $searchIcon.click(function () {
        search($searchInput.val());
    });

    $searchInput.keypress(function (e) {
        if (e.key === "Enter") {
            search($searchInput.val());
        }
    });

    // go to cart
    $goToCart.click(function () {
        location.href = "cart.php";
    });
});

function search(query) {
    location.href = "search.php?query=" + query;
}
