<html lang="it">
<head>
    <!-- Consider removing My from project name :) -->
    <title>My Unibo Vinyl - Register</title>
    <?php require("templates/head-section.php"); ?>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section>
            <form name="formRegister" action="register.php" method="post">
            	<input type="text" name="txtName" placeholder="Nome" value="" required><br/>
            	<input type="text" name="txtSurname" id="txtSurname" placeholder="Cognome" value="" required><br/>
            	<input type="date" name="birthDate" id="birthDate" placeholder="Data di nascita" value="" required><br/>
            	<input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
            	<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
            	<input type="password" name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Conferma password" value="" required><br/>
            	<input type="submit" name="btnNewUser" id="SubmitRegister" name="SubmitRegister" value="Iscriviti">
            </form>
        </section>
    </main>
</body>
</html>