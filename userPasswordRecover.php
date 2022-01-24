<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unibo Vinyl - Recupera password</title>
        <?php require_once("templates/head-section.php") ?>
        <!--<link rel="stylesheet" href="./public/css/register.css" />-->
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="public/css/checkout.css"> 
    </head>
    <body>
        <?php //require("./templates/header.php"); ?>
        <main>
            <h1>Recupera password</h1>
            <section>
                <form>
                    <ul>
                        <li><label for="txtMail">Inserisci mail</label><input type="mail" id="txtMail" name="txtMail" value=""/></li>
                    </ul>
                    <input type="button" id="btnRequestChange" value="Conferma">
                </form>
            </section>
            <section>
                <form>
                    <ul>
                        <li><label for="txtNewPassword">Inserisci nuova password</label><input type="password" id="txtNewPassword" name="txtNewPassword"/></li>
                        <li><label for="txtConfirmNewPassword">Conferma nuova password</label><input type="password" id="txtConfirmNewPassword" name="txtConfirmNewPassword"/></li>
                    </ul>
                    <input type="button" id="btnChangePassword" value="Conferma">
                </form>
            </section>
            <footer>
                
            </footer>
        </main>
        <script src="./public/js/password_recovery.js"></script>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>
