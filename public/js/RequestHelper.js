const BASE_URL = "./server/";

function getDefaultHeaders() {
    let authorizationToken = jwt.getJWT();
    const headers = {};
    if (authorizationToken != null) {
        headers.Authorization = "Bearer " + authorizationToken;
    }
    return headers;
}

/**
 * Returns the complete URL of a php file.
 *
 * @param {String} name name of php file
 * @returns {String} the url of the php resource
 */
function makeUrl(name) {
    return BASE_URL + name + ".php";
}

/**
 * Simple class for making ajax requests.
 *
 * @author Kelvin Olaiya <kelvinoluwada.olaiya@studio.unibo.it>
 */
class RequestHelper {
    constructor() {}

    /* We need to add Authorization header for every request */
    makeRequest(method, url, action, data, callback = function () {}) {
        data.action = action;
        $.ajax({
            method: method,
            url: makeUrl(url),
            data: data,
            success: callback,
            dataType: "json",
            headers: getDefaultHeaders(),
        });
    }

    get(url, action, data, callback) {
        this.makeRequest("GET", url, action, data, callback);
    }

    post(url, action, data, callback) {
        this.makeRequest("POST", url, action, data, callback);
    }
}
const reqHelper = new RequestHelper();
