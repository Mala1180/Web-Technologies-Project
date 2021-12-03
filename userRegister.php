<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Consider removing My from project name :) -->
    <title>My Unibo Vinyl - Register</title>
    <?php require_once("templates/head-section.php") ?>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section>
            <form name="formRegister">
            	<input type="text" name="txtName" id="txtName" placeholder="Nome" value="" required><br/>
            	<input type="text" name="txtSurname" id="txtSurname" placeholder="Cognome" value="" required><br/>
            	<input type="text" name="txtUsername" id="txtUsername" placeholder="Nome utente" value="" required><br/>
            	<input type="email" name="txtEmail" id="txtEmail" placeholder="Email" value="" required><br/>
            	<input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
            	<input type="password" name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Conferma password" value="" required><br/>
            	<input type="button" name="btnNewUser" id="SubmitRegister" name="SubmitRegister" value="Iscriviti">
            </form>
        </section>
    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/register.js"></script>
</body>
</html>