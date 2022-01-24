<!DOCTYPE html>
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
        </main>
        <aside>
            <header>
                <h2>Il tuo carrello</h2>
                <button tabindex="0"><img src="public/img/icons/cancel.png" alt="chiudi anteprima carrello" /></button>
            </header>
            <ul>
            </ul>
            <footer>
                <a href="cart.php">Visualizza tutto <span class="material-icons-outlined">east</span></a>
            </footer>
        </aside>
        <script src="./public/js/page-header.js"></script>
        <script src=".public/js/libraries/sweetalert2.min.js"></script>
    </body>
</html>