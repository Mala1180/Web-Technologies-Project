/**
*	Simple class for making ajax requests.
*/
const BASE_URL = "./";

class RequestHelper {	
	constructor() {

	}
	async makeRequest(method, action, myHeaders, parameters = []) {
		const res = await fetch('./' + action + '.php', {
		  method: method,
		  headers: myHeaders,
		  body: JSON.stringify(parameters)
		});

		return res;
	}
}
const reqHelper = new RequestHelper();