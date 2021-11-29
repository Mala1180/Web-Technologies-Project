/**
*	Simple class for JWT to get and set the token.
*/

class MyJWT {

	constructor() {
		this._JWT = "";
	}

	getJWT() {
		return this._JWT;
	}

	setJWT(JWT) {
		this._JWT = JWT;
	}
}

const jwt = new MyJWT();