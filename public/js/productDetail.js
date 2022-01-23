let details = {};
let songs = [];
let genres = [];

$(document).ready(function () {
    const _URL = new URL(location.href);
    const ID_PRODUCT = _URL.searchParams.get("id");

    getProductDetails(ID_PRODUCT);

});


/**
 * Executes a GET request to get details of a product.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {String} idProduct string with the id of the product to be searched
 */
function getProductDetails(idProduct) {
    if (idProduct) {
        reqHelper.get("search", "productDetails", {
            "idProduct": idProduct,
        }, function (res) {
            if (res.success) {
                summary = res.data;
                details = summary[0][0];
                songs = summary[1];
                genres = summary[2];
                console.log(summary);
                console.log(details, songs, genres);
                displayProductDetails(details, songs, genres);
                $("#addToCart").click(function () {
                    addToCart(idProduct);
                });
            } else {
                console.error("An error occurred while searching the product details.");
            }
        });
    }
}

function addToCart(idProduct) {
    if (idProduct > 0) {
        reqHelper.post("cart", "addEntry", {
            idProduct: idProduct
        },
            function (data) {
                if (data.success) {
                    Swal.fire("", "prodotto aggiunto al carrello", "success");
                } else {
                    Swal.fire("", "Verifica la disponibilità del prodotto", "error");
                }
            }
        );
    }
}

/**
 * Fills the page with the product details.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Object} details object with the product details
 * @param {Array} genres array with the genres of the album
 * @param {Array} songs array with the songs of the album
 */
function displayProductDetails(details, songs, genres) {
    if (details) {
        $("main .album-img").attr("src", `public/img/products/${details.imgPath}`);
        $("main .name").text(details.name);
        $("main .product-description").text(details.productDescription);
        $("main .type").text(details.type == 0 ? "CD" : "Vinile");
        $("main .quantity").text(details.quantity);
        $("main .author").text(details.author);
        if (genres) {
            genres.forEach(function (genre, index) {
                $("main .genres").append(index > 0 ? ", " + genre.genre : genre.genre);
            });
        }
        $("main .price").text("€ " + details.price);
        $("main .album-duration").text(secondsToTime(details.albumDuration));
        $("main .album-description").text(details.albumDescription);
        if (songs) {
            songs.forEach(function (song) {
                const $song = $(`<li>${song.name} <em>[${secondsToTime(song.duration)}]</em></li>`);
                $("main .track-list").append($song);
            });
        }
    }
}


/**
 * Function that convert seconds in human readable format.
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {Number} seconds number of seconds to be converted
 * @returns {String} string with the converted time
 */
function secondsToTime(seconds) {
    let _hours = Math.floor(seconds / 3600);
    let _minutes = Math.floor((seconds - (_hours * 3600)) / 60);
    let _seconds = seconds - (_hours * 3600) - (_minutes * 60);
    return (_hours > 0 ? _hours + ":" : "") +
        (_minutes < 10 && _hours > 0 ? "0" + _minutes : _minutes) +
        ":" + (_seconds < 10 ? "0" + _seconds : _seconds);
}