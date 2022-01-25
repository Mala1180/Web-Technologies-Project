$(document).ready(function () {
    reqHelper.post("userMgr", "getUserType", {}, function(res) {
        if (res.success) {
            if (res.data === "artista") {
                $("header #search-section form").remove();
                $("header nav ul li > button#search-button").remove();
                $("header #menu-section a[href='./userNotifications.php'").prevAll().remove();
                $("header #menu-section").prepend(`<a href="./vendorDashboard.php">Dashboard</a>`);
            } else if (res.data === "shipper") {
                $("header #search-section form").remove();
                $("header #search-section").append(`<h1>Ordini</h1>`);
                $("header nav ul li > button#search-button").remove();
                $("header #menu-section a").not(":last-of-type").remove();
            }
        }
    });
});


//from Y-m-d to d-m-Y
function toITString(date) {
    return date.split("-")[2] + "-" + date.split("-")[1] + "-" + date.split("-")[0];
}
