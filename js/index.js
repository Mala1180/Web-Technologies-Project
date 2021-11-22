/**
 * Are you happy Kel?
 */
$(document).ready(function() {
    $("header section").hide();

    const $searchSection = $("header section:first-of-type");
    const $menuSection = $("header section:last-of-type");
    const $searchIcon =  $("header nav ul li:nth-child(2) img");
    const $menuIcon =  $("header nav ul li:nth-child(3) img");

    $("header nav ul li:nth-child(2)").click(function() {
        if ($searchSection.css("display") === "none") {
            replaceIconSrc($searchIcon, "img/icons/cancel.png");
        } else {
            replaceIconSrc($searchIcon, "img/icons/search.png");
        }
        if ($menuIcon.attr("src") === "img/icons/cancel.png") {
            replaceIconSrc($menuIcon, "img/icons/menu.png");
            $menuSection.hide();
        }
        $searchSection.fadeToggle(100);
    });

    $("header nav ul li:nth-child(3)").click(function() {
        if ($menuSection.css("display") === "none") {
            replaceIconSrc($menuIcon, "img/icons/cancel.png");
        } else {
            replaceIconSrc($menuIcon, "img/icons/menu.png");
        }
        if ($searchIcon.attr("src") === "img/icons/cancel.png") {
            replaceIconSrc($searchIcon, "img/icons/search.png");
            $searchSection.hide();
        }
        $menuSection.fadeToggle(100);
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


