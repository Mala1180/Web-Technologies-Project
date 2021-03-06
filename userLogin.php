<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once("templates/head-section.php"); ?>
    <link rel="stylesheet" href="./public/css/login.css" />

    <title>Unibo Vinyl - Login</title>
</head>
<body>
    <main>
        <div></div>
        <section>
            <header>
                <a href="index.php" title="Homepage"><img src="./public/img/logoRosso.png" alt="" /></a>
                <h1>Unibo Vinyl</h1>
            </header>
            <h2>Accedi</h2>
            <p>Username o password non corretti</p>
            <form name="formLogin" method="GET" action="#">
                <fieldset>
                    <legend>Sono un</legend>
                    <input type="radio" id="cliente" name="type" value="cliente" checked="checked" tabindex="0"/> 
                    <label for="cliente">Cliente</label>
                    <input type="radio" id="artista" name="type" value="artista" tabindex="1" />
                    <label for="artista">Artista</label>
                    <input type="radio" id="shipper" name="type" value="shipper" tabindex="1" />
                    <label for="shipper">Shipper</label>
                </fieldset>
                <ul>
                    <li>
                        <label for="txtUsername">Username</label>
                        <img src="./public/img/icons/person_black.png" alt=""><input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required />
                    </li>
                    <li>
                        <label for="txtPassword">Password</label>
                        <img src="./public/img/icons/key_black.png" alt=""><input type="password" name="txtPassword" id="txtPassword" placeholder="Password"required />
                        <a href="./userPasswordRecover.php">Hai dimenticato la password?</a>
                    </li>
                    <li>
                        <input type="submit" name="btnLogin" id="SubmitLogin" value="Entra" />
                    </li>
                </ul>
            </form>
            <p>Non sei ancora registrato? <a href="userRegister.php">Registrati</a></p>
        </section>
    </main>
    <script type="text/javascript" src="./public/js/login.js"></script>
</body>
</html>