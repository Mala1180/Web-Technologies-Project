<?php 
	/**
	 * The secret key witch jwt library use for encode user data and token 
	 */
	define("SECRET_KEY", "hellomyfriendsimthelongsecret:D");

	/**
 	 * The server name
	 */
	define("SERVER_NAME", "192.168.64.2");

	/**
	 * Algorithm used to sign the token.
	 * other usable algorithms -> https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
	 */
	define("JWT_CRYPTO_ALGORITHM", "HS512");
 ?>