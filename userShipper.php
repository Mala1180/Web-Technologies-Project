
<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/orders.css" />

        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <main>
            <h1>Ordini</h1>
            <ul class="orders-list">
                <li>
                    <section class="order-header">
                        <div>
                            <h2 class="date">Ordine del 20/02/2020</h2>
                            <span class="total">Totale: € 30</span>
                        </div>
                    </section>
                    <section>
                        <button id="btnChangeState"></button>
                        <button id="btnChangeDate"></button>
                    </section>
                    <section class="order-details">
                        <h2>Linee d'ordine</h2>
                        <ul>
                            <li>
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
        <script src="./public/js/orders.js"></script>
    </body>
</html>