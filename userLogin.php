<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once("templates/head-section.php"); ?>
    <link rel="stylesheet" href="./public/css/login.css" />
    <!-- Consider removing My from project name :) -->
    <title>My Unibo Vinyl - Login</title>
</head>
<body>
    <main>
        <div></div><section>
            <header>
                <a href="index.php" title="Homepage"><img src="./public/img/logoRosso.png" alt="" /></a>
                <h1>Unibo Vinyl</h1>
            </header>
            <h2>Accedi</h2>
            <form name="formLogin">
                <ul>
                    <li>
                        <label for="txtUsername">Username</label>
                        <img src="./public/img/icons/person_black.png" alt=""><input type="text" name="txtUsername" id="txtUsername" placeholder="Username" required />
                    </li>
                    <li>
                        <label for="txtPassword">Password</label>
                        <img src="./public/img/icons/key_black.png" alt=""><input type="password" name="txtPassword" id="txtPassword" placeholder="Password"required />
                        <a href="#">Hai dimenticato la password?</a>
                    </li>
                    <li>
                        <input type="submit" name="btnLogin" id="SubmitLogin" value="Entra" />
                    </li>
                </ul>
            </form>
            <p>Non sei ancora regitrato? <a href="userRegister.php">Registrati</a></p>
        </section>
        
<!-- 
        <section>
            <input type="button" name="SubmitLogout" id="SubmitLogout" value="Logout">
            <input id="btnMyProfile" type="button" value="Il mio profilo">
        </section>

        <section><br><br>
            <form name="formCreditCard">
                <h1>Aggiungi carta di credito</h1>
                <input type="text" name="txtCardNumber" id="txtCardNumber" placeholder="Numero Carta" value="" required><br/>
                <input type="text" name="txtCircuit" id="txtCircuit" placeholder="Circuito (ES. Visa, Mastercard, ...)" value="" required><br/>
                <input type="date" name="expiryDateCreditCard" id="expiryDateCreditCard" placeholder="Data di scadenza" value="" required><br/>

                <label for="cmbDefault">Vuoi impostare la carta come predefinita?</label>
                <input type="checkbox" id="cmbDefault" name="cmbDefault" value="Default">
                <br>
                <input type="button" name="btnAddCard" id="btnAddCard" value="Aggiungi">
            </form>
        </section>
-->
    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/login.js"></script>
    <script type="text/javascript" src="./public/js/logout.js"></script>
    <script type="text/javascript" src="./public/js/profile.js"></script>
    <script type="text/javascript" src="./public/js/creditCard.js"></script>

</body>
</html>