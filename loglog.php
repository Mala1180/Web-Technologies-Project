<!DOCTYPE html>
<html lang="it">
<head>
	<meta charset="utf-8"/>
	<title></title>
</head>
<body>
		<div>
			<form name="formRegister" action="register.php" method="post">
				<input type="text" name="txtName" placeholder="Nome" value="" required><br/>
				<input type="text" name="txtSurname" id="txtSurname" placeholder="Cognome" value="" required><br/>
				<input type="date" name="birthDate" id="birthDate" placeholder="Data di nascita" value="" required><br/>
				<input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
				<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
				<input type="password" name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Conferma password" value="" required><br/>

				<input type="submit" name="btnNewUser" id="SubmitRegister" name="SubmitRegister" value="Iscriviti">
			</form>
		</div>
		<div>
			<form name="formLogin" action="login.php" method="post">
				<input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
				<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
				<input type="submit" name="btnLogin" id="SubmitLogin" name="SubmitLogin" value="Entra">
			</form>
		</div>

</body>
</html>