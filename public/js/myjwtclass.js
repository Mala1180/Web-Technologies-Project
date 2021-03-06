/**
*	Simple class for JWT to get and set the token.
*/
class MyJWT {

	constructor() { }

	getJWT() {
		return localStorage.getItem("AuthToken");
	}

	setJWT(JWT) {
		localStorage.setItem("AuthToken", JWT);
	}

	unsetJWT() {
		localStorage.removeItem("AuthToken");
	}
}

const jwt = new MyJWT();