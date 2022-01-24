<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Unibo Vinyl - Carrello</title>
        <?php require_once("templates/head-section.php") ?>

        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="public/css/cart.css" /> 
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <h1>Il tuo carrello</h1>
            <ul>
                
            </ul>
            <p>Nessun articolo aggiunto al carrello</p>
            <footer>
                <a href="checkout.php">Procedi all'ordine</a>
            </footer>
        </main>
        <script src="./public/js/cart.js"></script>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>