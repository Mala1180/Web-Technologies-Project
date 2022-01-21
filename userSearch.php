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
                <img src="public/img/icons/cancel.png" alt="close cart preview image" />
            </header>
            <div>
                <?php require("./templates/preview-cart-article.php") ?>
                <?php require("./templates/preview-cart-article.php") ?>

            </div>
            <footer>
                <span>Visualizza tutto</span>
                <span class="material-icons-outlined">east</span>
            </footer>
        </aside>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>