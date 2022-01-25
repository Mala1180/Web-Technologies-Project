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
        <link rel="stylesheet" href="./public/css/orders.css" />

        <script src="./public/js/clientOrders.js"></script>

        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <main>
            <h1>I miei ordini</h1>
            <ul class="orders-list">
            </ul>
            <p>Nessun ordine</p>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>