<!DOCTYPE html>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/notifications.css" />

        <script src="./public/js/orders.js"></script>

        <title>Unibo Vinyl - Corriere</title>
    </head>
    <body>
        <?php require_once("./templates/confirm-modal.php"); ?>

        <main>
            <h1>Ordini</h1>
            <ul class="orders-list">
               <!-- There will be the notifications -->
            </ul>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>