<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Unibo Vinyl - Pagamenti</title>
        <?php require_once("templates/head-section.php") ?>

        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/confirm-modal.css" />
        <link rel="stylesheet" href="public/css/payments.css"> 

        <script src="./public/js/payments.js"></script>
    </head>
    <body>
        <?php require("./templates/confirm-modal.php"); ?>
        <?php require("./templates/header.php"); ?>
        <main>
            <h1>I miei pagamenti</h1>
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
                <h2>Le tue carte</h2>
                <ul class="cards-list">
                    <!-- There will be the user cards -->
                </ul>
            </section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>