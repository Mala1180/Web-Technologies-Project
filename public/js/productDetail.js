$(document).ready(function () {
    const _URL = new URL(location.href);
    const ID_PRODUCT = _URL.searchParams.get("id");



});


/**
 * Executes a GET request to get details of a product.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {String} idProduct string with the id of the product to be searched
 * @return {Object} object with the product details
 */
 function getProductDetails(idProduct) {
    if (idProduct) {
        reqHelper.get("search", "productDetails", {
            "idProduct": idProduct,
        }, function (data) {
            if (data.success) {
                products = data.data;
                console.log(products);
                displayProductDetails(products);
            } else {
                console.error("An error occurred while searching products.");
            }
        });
    }
}

/**
 * Fills the page with the product details.
 *
 * @author Mattia Matteini <matteinimattia@gmail.com>
 * @param {String} details object with the product details
 */
 function displayProductDetails(details) {
    if (details) {
        
    }
}
