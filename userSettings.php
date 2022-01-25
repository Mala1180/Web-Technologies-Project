<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_client_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
    <head>
        <title>Unibo Vinyl - Pagamenti</title>
        <?php require_once("templates/head-section.php") ?>

        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/settings.css" />

        <script src="./public/js/settings.js"></script>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <h1>Impostazioni</h1>
            <form>
                <ul>
                    <li>
                        <label for="name">Nome: </label>
                        <input id="name" name="name" type="text"  disabled />
                    </li>
                    <li>
                        <label for="surname">Cognome: </label>
                        <input id="surname" name="surname" type="text"  disabled />
                    </li>
                    <li>
                        <label for="username">Username: </label>
                        <input id="username" name="username" type="text" disabled />
                    </li>
                    <li>
                        <label for="email">E-Mail: </label>
                        <input id="email" name="email" type="email"  disabled />
                    </li>
                </ul>
                <input type="button" value="Modifica dati" />
            </form>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>