/**
 * Are you happy Kel?
 */
$(document).ready(function() {
    const $searchSection = $("header section:first-of-type");
    const $menuSection = $("header section:last-of-type");
    const $searchIcon =  $("header nav ul li:nth-child(2) img");
    const $menuIcon =  $("header nav ul li:nth-child(3) img");

    $("header nav ul li:nth-child(2)").click(function() {
        if ($searchSection.css("display") === "none") {
            replaceIconSrc($searchIcon, "img/icons/cancel.png");
            $searchSection.fadeIn(100).css("display", "flex");
        } else {
            replaceIconSrc($searchIcon, "img/icons/search.png");
            $searchSection.fadeOut(100).css("display", "flex");
        }
        if ($menuIcon.attr("src") === "img/icons/cancel.png") {
            replaceIconSrc($menuIcon, "img/icons/menu.png");
            $menuSection.hide();
        }
    });

    $("header nav ul li:nth-child(3)").click(function() {
        if ($menuSection.css("display") === "none") {
            replaceIconSrc($menuIcon, "img/icons/cancel.png");
            $menuSection.fadeIn(100).css("display", "flex");
        } else {
            replaceIconSrc($menuIcon, "img/icons/menu.png");
            $menuSection.fadeOut(100).css("display", "flex");
        }
        if ($searchIcon.attr("src") === "img/icons/cancel.png") {
            replaceIconSrc($searchIcon, "img/icons/search.png");
            $searchSection.hide();
        }
    });
});


/**
 * Replace with fading the src of an image with a new one.
 * 
 * @param {jQuery} icon The jquery img object
 * @param {String} src The new src
 */
function replaceIconSrc($icon, src) {
    $icon.fadeOut(100, function () {
        $icon.attr("src", src);
        setTimeout(() => {
            $icon.fadeIn(100);
        }, 100);
    });
}


