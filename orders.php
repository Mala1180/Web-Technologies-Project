<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/orders.css" />

        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <main>
            <h1>I miei Ordini</h1>
            <ul class="orders-list">
                <li>
                    <section class="order-header">
                        <div>
                            <h2 class="date">Ordine del 20/02/2020</h2>
                            <span class="total">Totale: € 30</span>
                        </div>
                        <button>Leggi</button>
                    </section>
                    <section class="order-storyline">
                        <span class="dot"></span>
                        <span class="line"></span>
                        <span class="dot"></span>
                        <span class="line"></span>
                        <span class="dot"></span>
                    </section>
                    <section class="order-steps">
                        <span>Ordine effettuato</span>
                        <span>In transito</span>
                        <span>Consegnato</span>
                    </section>
                    <section class="order-details">
                        <ul>
                            <li>
                                <img src="./public/img/products/TheEminemShow.png" alt="immagine dell'album">
                                <div>
                                    <h3>The Eminem Show</h3>
                                    <span>Prezzo: € 30</span>
                                    <span>Quantità: 2</span>
                                    <span>Totale: € 60</span>
                                </div>
                            </li>
                        </ul>
                    </section>
                </li>
            </ul>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>