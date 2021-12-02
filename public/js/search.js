$(document).ready(function () {
    const $cartPreview = $("body > aside");
    const $closePreview = $("body > aside img");
    const $previewTitle = $("body > aside h1");

    // close / open cart preview
    $closePreview.click(function () {
        $cartPreview.css("bottom", $cartPreview.height() * -1 + 80);
        $closePreview.hide();
    });

    $previewTitle.click(function () {
        $cartPreview.css("bottom", 0);
        $closePreview.show();
    });

    // go to cart
    $("body aside footer").click(function () {
        location.href = "Web-Technologies-Project/cart.php";
    });
});
