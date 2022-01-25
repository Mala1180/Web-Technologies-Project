<!DOCTYPE html>  
<?php 
    require_once("server/validate.php");
    if (!is_vendor_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
    <head>
        <?php require("./templates/head-section.php"); ?>
        <link rel="stylesheet" href="./public/css/header.css" />
        <link rel="stylesheet" href="./public/css/vendorDashboard.css" />
        <title>Unibo Vinyl - Profilo</title>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <section><a href="userVendor.php">Nuovo prodotto</a></section>
            <section><a href="vendorProductList.php">Gestione prodotti</a></section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>
