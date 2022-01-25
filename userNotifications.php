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
        <link rel="stylesheet" href="./public/css/notifications.css" />
        <link rel="stylesheet" href="./public/css/confirm-modal.css" />

        <script src="./public/js/notifications.js"></script>

        <title>Unibo Vinyl - Notifiche</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <?php require_once("./templates/confirm-modal.php"); ?>

        <main>
            <h1>Notifiche</h1>
            <ul class="notifications-list">
               <!-- There will be the notifications -->
            </ul>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>