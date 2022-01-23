$(document).ready(function () {

    const $searchSection = $("#search-section");
    const $menuSection = $("#menu-section");
    const $searchButton = $("#search-button");
    const $menuButton = $("#menu-button");

    $searchButton.click(function () {
        if ($searchSection.css("display") === "none") {
            $searchSection.fadeIn(100).css("display", "flex");
        } else {
            $searchSection.fadeOut(100).css("display", "flex");
        }
        if ($menuSection.css("display") !== "none") {
            $menuSection.hide();
        }
    });

    $menuButton.click(function () {
        if ($menuSection.css("display") === "none") {
            $menuSection.fadeIn(100).css("display", "flex");
        } else {
            $menuSection.fadeOut(100).css("display", "flex");
        }
        if ($searchSection.css("display") !== "none") {
            $searchSection.hide();
        }
    });

    $("#logoutBtn").click(function (e) {
        e.preventDefault();
        jwt.unsetJWT();
        location.href = "index.php";
    })
});
