<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_client_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/search.css" />

        <script src="./public/js/search.js"></script>
        <title>Unibo Vinyl - Cerca</title>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <!-- There will be the searched products -->
            <p>Nessun prodotto corrispondente alla tua ricerca</p>
        </main>
        <aside>
            <header>
                <h2>Il tuo carrello</h2>
                <button><img src="public/img/icons/cancel.png" alt="chiudi/apri anteprima carrello" /></button>
            </header>
            <ul>
            </ul>
            <footer>
                <a href="cart.php">Visualizza tutto <span class="material-icons-outlined">east</span></a>
            </footer>
        </aside>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>