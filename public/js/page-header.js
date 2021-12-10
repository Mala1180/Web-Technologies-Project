$(document).ready(function () {
    const links = $("header > div > section:last-of-type > span");
    $(links[1]).hide();
    if (jwt.getJWT() != null) {
        $(links[0]).hide();
        $(links[1]).show();
    }
});