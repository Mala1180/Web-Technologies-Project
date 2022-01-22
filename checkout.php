<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unibo Vinyl - checkout</title>
        <?php require_once("templates/head-section.php") ?>
        <!--<link rel="stylesheet" href="./public/css/register.css" />-->
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="public/css/checkout.css"> 
    </head>
    <body>
        <?php //require("./templates/header.php"); ?>
        <main>
            <h1>Pagamento</h1>
            <section>
                <h1>Carta esistente</h1>
                <form>
                    <ul>
                        <li><label for="selectCard">Seleziona una carta</label><select id="selectCard" name="selectCard"></select></li>
                    </ul>
                    <input type="button" id="btnSelectCard" value="Procedi all'ordine">
                </form>
                <form>
                <h1>Nuova carta</h1>
                    <ul>
                        <li><label for="cardHolder">Titolare</label><input type="text" id="cardHolder" name="cardHolder"/></li>
                        <li><label for="cardNumber">Numero carta</label><input type="text" id="cardNumber" name="cardNumber"/></li>
                        <li><label for="cardCircuit">Circuito</label><input type="text" id="cardCircuit" name="cardCircuit"/></li>
                        <li><label for="cardExpiration">Data scadenza</label><input type="month" id="cardExpiration" name="cardExpiration"/></li>
                        <li><label for="cardCvv"></label>CVV<input type="number" id="cardCvv" name="cardCvv"/></li>
                        <li><label for="isDefault"></label>Vuoi impostarla come predefinita?<input type="checkbox" id="isDefault" name="isDefault"/></li>
                    </ul>
                    <input type="button" id="btnAddCard" value="Aggiungi carta">
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