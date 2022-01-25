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
        <link rel="stylesheet" href="./public/css/profile.css" />
        <title>Unibo Vinyl - Profilo</title>
    </head>
    <body>
        <?php require_once("./templates/header.php"); ?>
        <main>
            <h1>Il mio profilo</h1>
            <section><a href="orders.php">I miei ordini</a></section>
            <section><a href="userNotifications.php">Notifiche</a></section>
            <section><a href="userPayments.php">Pagamenti</a></section>
            <section><a href="userSettings.php">Impostazioni</a></section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>