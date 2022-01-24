<!DOCTYPE html>
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
            <!-- <section>
                <a href="./userSearch.php?query=&filter=Giradischi">Giradischi</a>
            </section>
            <section>
                <a href="./userSearch.php?query=&filter=Bundle">Bundle</a> 
            </section> -->
        </main>
        <script src="./public/js/page-header.js"></script>
    </body>
</html>
