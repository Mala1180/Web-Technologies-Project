<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_client_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
    <head>
        <title>Unibo Vinyl - Checkout</title>
        <?php require_once("templates/head-section.php") ?>

        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="public/css/payments.css" />
        <link rel="stylesheet" href="public/css/checkout.css" /> 
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <h1>Chekckout</h1>
            
            <section>
                <h2>Nuova carta</h2>
                <form>
                    <ul>
                        <li>
                            <label for="cardHolder">Titolare</label>
                            <input type="text" id="cardHolder" name="cardHolder"/>
                        </li>
                        <li>
                            <label for="cardNumber">Numero carta</label>
                            <input type="text" id="cardNumber" name="cardNumber"/>
                        </li>
                        <li>
                            <label for="cardCircuit">Circuito</label>
                            <input type="text" id="cardCircuit" name="cardCircuit"/>
                        </li>
                        <li>
                            <label for="cardExpiration">Data scadenza</label>
                            <input type="month" id="cardExpiration" name="cardExpiration"/>
                        </li>
                        <li>
                            <label for="cardCvv">CVV</label>
                            <input type="number" id="cardCvv" name="cardCvv"/>
                        </li>
                        <li>
                            <label for="isDefault">Vuoi impostarla come predefinita?</label>
                            <input type="checkbox" id="isDefault" name="isDefault"/>
                        </li>
                    </ul>
                    <input type="button" id="btnAddCard" value="Aggiungi carta">    
                </form>
            </section>
            <section>
                <h2>Carta esistente</h2>
                <form>
                    <ul>
                        <li><label for="selectCard">Seleziona una carta</label><select id="selectCard" name="selectCard"></select></li>
                    </ul>
                </form>
            </section>
            <footer>
                <input type="button" id="btnProceed" value="Procedi all'ordine">
            </footer>
        </main>
        <script src="./public/js/checkout.js"></script>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>