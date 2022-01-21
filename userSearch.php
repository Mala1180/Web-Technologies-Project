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
            <?php
            require("./templates/article.php"); 
            // require("server/db/dbSearchManager.php");
            //     if (isset($_GET)) {
            //         $products = $dbSearchMgr->searchProducts($_GET["query"], $_GET["filter"]);
            //         foreach ($products as $product) {
            //             echo `<section>
            //             <img src="public/img/vinile1.jpg" alt="article image" />
            //             <aside>
            //                 <div>
            //                     <h2></h2>
            //                     <p style="display: none;">Lorem ipsum dolor sit amet  jd ffu eufgfugefugf ue gudw dwu gu expedita.</p>
            //                     <span>Tipologia: Vinile</span>
            //                 </div>
            //                 <div>
            //                     <span>€ 25</span>
            //                     <input type="button" value="Aggiungi al carrello" />
            //                 </div>
            //             </aside>
            //         </section>`;
            //         }
            //     }

            ?>
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