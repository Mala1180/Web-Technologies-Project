<!DOCTYPE html>
<html lang="it">
<head>
    <title>Unibo Vinyl - Register</title>
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
            <h2>Registrati</h2>
            <form name="formRegister">
                <fieldset>
                    <legend>Sono un</legend>
                    <input type="radio" id="cliente" name="type" value="cliente" checked="checked" tabindex="0"/> 
                    <label for="cliente">Cliente</label>
                    <input type="radio" id="artista" name="type" value="artista" tabindex="1" />
                    <label for="artista">Artista</label>
                </fieldset>
                <ul>
                    <li>
                        <label for="txtName">Nome</label>
                        <img src="./public/img/icons/person_black.png" alt=""><input type="text" name="txtName" id="txtName" placeholder="Nome" required />
                    </li>
                    <li>
                        <label for="txtSurname">Cognome</label>
                        <img src="./public/img/icons/person_black.png" alt=""><input type="text" name="txtSurname" id="txtSurname" placeholder="Cognome" required />
                    </li>
                    <li>
                        <label for="txtArtName">Nome d'arte</label>
                        <img src="./public/img/icons/person_black.png" alt=""><input type="text" name="txtArtName" id="txtArtName" placeholder="Nome d'arte" required />
                    </li>
                    <li>
                        <label for="txtUsername">Username</label>
                        <img src="./public/img/icons/username_black.png" alt=""><input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required />
                    </li>
                    <li>
                        <label for="txtEmail">Email</label>
                        <img src="./public/img/icons/email_black.png" alt=""><input type="email" name="txtEmail" id="txtEmail" placeholder="Email" required />
                    </li>
                    <li>
                        <label for="txtPassword">Password</label>
                        <img src="./public/img/icons/password_black.png" alt=""><input type="password" name="txtPassword" id="txtPassword" placeholder="Password"required />
                    </li>
                    <li>
                        <label for="txtPasswordConfirm">Conferma password</label>
                        <img src="./public/img/icons/password_black.png" alt=""><input type="password" name="txtPasswordConfirm" id="txtPasswordConfirm" placeholder="Conferma password"required />
                    </li>
                    <li>
                        <input type="submit" name="SubmitRegister" id="SubmitRegister" value="Iscriviti" />
                    </li>
                </ul>
            </form>
            <p>Sei già registrato? <a href="userLogin.php">Accedi</a></p>
        </section>            
    </main>
    <script type="text/javascript" src="./public/js/register.js"></script>
</body>
</html>