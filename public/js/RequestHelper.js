/**
*	Simple class for making ajax requests.
*/
const BASE_URL = "./";

class RequestHelper {	
	constructor() {}
	
	makeRequest(method, action, myHeaders, parameters = []) {
		return fetch('./' + action + '.php', {
		  method: method,
		  headers: myHeaders,
		  body: JSON.stringify(parameters)
		});
	}
}
const reqHelper = new RequestHelper();