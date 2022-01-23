<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/orders.css" />

        <script src="./public/js/clientOrders.js"></script>

        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <main>
            <h1>I miei Ordini</h1>
            <ul class="orders-list">
            </ul>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>