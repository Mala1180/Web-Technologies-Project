$(document).ready(function () {
    const $cartPreview = $("body > aside");
    const $previewTitle = $("body > aside > header > h2");
    const $togglePreview = $("body > aside > header > img");

    const CART_PREVIEW_HEADER_HEIGHT = $("body > aside > header").outerHeight();
    const CART_PREVIEW_MARGINS = 10;

    // close / open cart preview
    $togglePreview.click(function () {
        $cartPreview.css("bottom", ($cartPreview.height() + CART_PREVIEW_MARGINS) * -1 + CART_PREVIEW_HEADER_HEIGHT);
        $togglePreview.fadeOut(10, function () {
            $togglePreview.attr("src", "public/img/icons/up-arrow.png");
            $togglePreview.fadeIn(10);
        });
    });

    $previewTitle.click(function () {
        $cartPreview.css("bottom", 0);
        $togglePreview.fadeOut(10, function () {
            $togglePreview.attr("src", "public/img/icons/cancel.png");
            $togglePreview.fadeIn(10);
        });
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
