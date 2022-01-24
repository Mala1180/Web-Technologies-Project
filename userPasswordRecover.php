<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Unibo Vinyl - Recupera password</title>
    <?php require_once("templates/head-section.php") ?>
    <link rel="stylesheet" href="./public/css/register.css" />
</head>
<body>
    <main>
        <div></div><section>
            <header>
                <a href="index.php" title="Homepage"><img src="./public/img/logoRosso.png" alt="" /></a>
                <h1>Unibo Vinyl</h1>
            </header>
            <h2>Recupera password</h2>
            <form name="formRequestRecover" id="formRequestRecover">
                <fieldset>
                    <legend>Sono un</legend>
                    <input type="radio" id="cliente" name="type" value="cliente" checked="checked" tabindex="0"/> 
                    <label for="cliente">Cliente</label>
                    <input type="radio" id="artista" name="type" value="artista" tabindex="1" />
                    <label for="artista">Artista</label>
                </fieldset>
                <ul>
                    <li>
                        <label for="txtMail">Email</label>
                        <img src="./public/img/icons/email_black.png" alt=""><input type="email" name="txtMail" id="txtMail" placeholder="E-Mail" required />
                    </li>
                    <li>
                        <input type="submit" name="btnRequestChange" id="btnRequestChange" value="Invia E-Mail"/>
                    </li>
                </ul>
            </form>
            <form name="formRecover" id="formRecover">
                <ul>
                    <li>
                        <label for="txtNewPassword">Nuova password</label>
                        <img src="./public/img/icons/password_black.png" alt=""><input type="password" name="txtNewPassword" id="txtNewPassword" placeholder="Nuova password" required />
                    </li>
                    <li>
                        <label for="txtConfirmNewPassword">Conferma nuova password</label>
                        <img src="./public/img/icons/password_black.png" alt=""><input type="password" name="txtConfirmNewPassword" id="txtConfirmNewPassword" placeholder="Conferma nuova password" required />
                    </li>
                    <li>
                        <input type="submit" name="btnChangePassword" id="btnChangePassword" value="Conferma"/>
                    </li>
                </ul>
            </form>
            <p><a href="userLogin.php">Torna al login</a></p>
        </section>            
    </main>
    <script type="text/javascript" src="./public/js/password_recovery.js"></script>
</body>
</html>
