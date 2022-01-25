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
        <link rel="stylesheet" href="./public/css/index.css" />

        <title>Unibo Vinyl</title>
    </head>
    <body>
        <?php require("./templates/header.php"); ?>
        <main>
            <section>
                <a href="./userSearch.php?query=&filter=1">Vinili</a>
            </section>
            <section>
                <a href="./userSearch.php?query=&filter=0">CD</a>
            </section>
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>
