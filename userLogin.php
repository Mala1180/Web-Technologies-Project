<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Consider removing My from project name :) -->
    <title>My Unibo Vinyl - Login</title>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>
        <section>
            <form name="formLogin">
                <input type="text" name="txtUsername" id="txtUsername" placeholder="Username" value="" required><br/>
                <input type="password" name="txtPassword" id="txtPassword" placeholder="Password" value="" required><br/>
                <input type="button" name="btnLogin" id="SubmitLogin" value="Entra">
            </form>
            <input type="button" name="btnGetResource" id="GetResource" value="test get resource">
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



    </main>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/login.js"></script>
    <script type="text/javascript" src="./public/js/request.js"></script>
    <script type="text/javascript" src="./public/js/logout.js"></script>
    <script type="text/javascript" src="./public/js/profile.js"></script>
    <script type="text/javascript" src="./public/js/creditCard.js"></script>

</body>
</html>