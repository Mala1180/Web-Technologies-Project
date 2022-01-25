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
        <title>Unibo Vinyl</title>
        <link rel="stylesheet" href="./public/css/vendor_product_list.css">
    </head>
    <body>
        <main>
            <h1>Lista prodotti</h1>
            <form method="GET" action="#">
                <fieldset>
                    <legend>Filtri</legend>
                    <ul>
                        <li><label for="searchName">Nome album</label> <input type="text" name="searchName" id="searchName" placeholder="album"/></li>
                        <li><label for="searchType">Tipologia</label>
                            <select name="searchType" id="searchType">
                                <option value="">Tutti</option>
                                <option value="0">CD</option>
                                <option value="1">Vinili</option>
                            </select>
                        </li>
                        <li><button id="search">cerca</button></li>
                    </ul>
                </fieldset>
            </form>
            <div>
                <table></table>
            </div>
        </main>
        <script src="./public/js/vendor_product_list.js"></script>
    </body>
</html>