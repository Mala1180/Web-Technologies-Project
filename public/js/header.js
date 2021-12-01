$(document).ready(function () {
    const $searchSection = $("header section:first-of-type");
    const $menuSection = $("header section:last-of-type");
    const $searchIcon = $("header nav ul li:nth-child(2) img");

    $("header nav ul li:nth-child(2)").click(function () {
        if ($searchSection.css("display") === "none") {
            $searchSection.fadeIn(100).css("display", "flex");
        } else {
            $searchSection.fadeOut(100).css("display", "flex");
        }
        if ($menuSection.css("display") !== "none") {
            $menuSection.hide();
        }
    });

    $("header nav ul li:nth-child(3)").click(function () {
        if ($menuSection.css("display") === "none") {
            $menuSection.fadeIn(100).css("display", "flex");
        } else {
            $menuSection.fadeOut(100).css("display", "flex");
        }
        if ($searchIcon.css("display") !== "none") {
            $searchSection.hide();
        }
    });
});
