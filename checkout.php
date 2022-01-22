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
                <form>
                    <ul>
                        <li><label></label><input type="text" name="cardHolder"/></li>
                        <li><label></label><input type="text" name="cardNumber"/></li>
                        <li><label></label><input type="text" name="cardExpirationMonth"/></li>
                        <li><label></label><input type="text" name="cardExpirationYear"/></li>
                        <li><label></label><input type="text" name="cardCvv"/></li>
                    </ul>
                </form>
            </section>
            <footer>
                <button>Procedi all'ordine</button>
            </footer>
        </main>
        <script src="./public/js/checkout.js"></script>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>