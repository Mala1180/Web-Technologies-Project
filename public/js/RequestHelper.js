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

    /**
     * Makes an AJAX request to the server. Need to add Authorization header for every request
     * 
     * @param {String} method method of the request
     * @param {String} url name of php file
     * @param {String} action name of action to be executed
     * @param {Object} data data to be sent to the server
     * @param {Function} callback function to be called when the request is completed
     * @author Kelvin Olaiya <kelvinoluwada.olaiya@studio.unibo.it>
     */
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

    /**
     * Makes a GET request to the server.
     * 
     * @param {String} url name of php file
     * @param {String} action name of action to be executed
     * @param {Object} data data to be sent to the server
     * @param {Function} callback function to be called when the request is completed
     * @see makeRequest
     * @author Kelvin Olaiya <kelvinoluwada.olaiya@studio.unibo.it>
     */
    get(url, action, data, callback) {
        this.makeRequest("GET", url, action, data, callback);
    }

    /**
     * Makes a POST request to the server.
     * 
     * @param {String} url name of php file
     * @param {String} action name of action to be executed
     * @param {Object} data data to be sent to the server
     * @param {Function} callback function to be called when the request is completed
     * @see makeRequest
     * @author Kelvin Olaiya <kelvinoluwada.olaiya@studio.unibo.it>
     */
    post(url, action, data, callback) {
        this.makeRequest("POST", url, action, data, callback);
    }
}
const reqHelper = new RequestHelper();
