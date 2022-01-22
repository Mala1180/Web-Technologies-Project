<!DOCTYPE html>
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
            <section><a href="notifications.php">Notifiche</a></section>
            <section><a href="settings.php">Impostazioni</a></section>
            <section><a href="payments.php">Pagamenti</a></section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>