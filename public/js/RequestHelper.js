/**
*	Simple class for making ajax requests.
*/
const BASE_URL = "./server/";

function getDefaultHeaders() {
	authorizationToken = localStorage.getItem("AuthToken");
	const headers = {};
	if (authorizationToken != null) {
		headers.Authorization = "Bearer " + authorizationToken;
	}
	return headers;
}

function makeUrl(name) {
	return BASE_URL + name + ".php";
}

class RequestHelper {
	constructor() { }

	makeRequest(method, action, myHeaders, parameters = []) {
		return fetch(BASE_URL + action + '.php', {
			method: method,
			headers: myHeaders,
			body: JSON.stringify(parameters)
		});
	}
	/* We need to add Authorization header for every request */
	get(url, action, data, callback) {
		data.action = action;
		$.ajax({
			url: makeUrl(url),
			data: data,
			success: callback,
			dataType: "json",
			headers: getDefaultHeaders()
		});
	}

	post(url, action, data, callback) {
		data.action = action;
		$.ajax({
			method: "POST",
			url: makeUrl(url),
			data: data,
			success: callback,
			dataType: "json",
			headers: getDefaultHeaders()
		})
	}
}
const reqHelper = new RequestHelper();