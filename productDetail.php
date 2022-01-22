<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/product-detail.css" />

        <script src="./public/js/productDetail.js"></script>

        <title>Unibo Vinyl - Dettagli Articolo</title>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <section>
                <img class="album-img" src="./public/img/vinile1.jpg" alt="">
                <div>
                    <h1 class="name">Nome prodotto</h1>
                    <p class="product-description"></p>
                </div> 
                <div>
                    <em>Tipologia:</em>
                    <span class="type"></span>
                </div>
                <div>
                    <em>Disponibilità:</em>
                    <span class="quantity"></span>
                </div> 
            </section>
            <section>
                <div>
                    <em>Autore:</em>
                    <span class="author"></span>
                </div>
                <div>
                    <em>Generi:</em>
                    <span class="genres"></span>
                </div>
                <div>
                    <em>Prezzo:</em>
                    <span class="price"></span>
                </div>
                <div>
                    <em>Durata:</em>
                    <span class="album-duration"></span>
                </div>
            </section>
            <section>
                <p class="album-description">Descrizione Album</p>
                <h2>Tracce:</h2>
                <ol class="track-list">
                    <!-- There will be the alubm songs -->
                </ol>
            </section>
            
            <input type="button" value="Aggiungi al carrello" />
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>

