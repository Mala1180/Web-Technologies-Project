<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_shipper_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/shipper.css" />
        <title>Unibo Vinyl - Ordini</title>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <h1>Ordini</h1>
            <ul class="orders-list">
            </ul>
            <p>Non ci sono ordini</p>
        </main>
        <script src="./public/js/page-header.js"></script>
        <script src="./public/js/shipperOrders.js"></script>
    </body>
</html>