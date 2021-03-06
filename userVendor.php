<!DOCTYPE html>
<?php 
    require_once("server/validate.php");
    if (!is_vendor_logged(true)) {
        header("location: userLogin.php");
    }
?>
<html lang="it">
<head>
    <?php require_once("templates/head-section.php") ?>
    <title>Unibo Vinyl - Venditore</title>

    <link rel="stylesheet" href="./public/css/header.css">
    <link rel="stylesheet" href="./public/css/userVendor.css">
</head>
<body>
<?php require_once("./templates/header.php") ?>

    <main>  
        <section>
            <h1>Nuovo prodotto</h1>
            <form>
                <fieldset>
                    <legend>Dati album</legend>
                    <ul>
                        <li>
                            <label for="txtTitle">Titolo</label>
                            <input type="text" id="txtTitle" placeholder="Titolo album" required/>
                        </li>
                        <li>
                            <label for="txtDescription">Descrizione</label>
                            <textarea id="txtDescription" placeholder="descrizione" required></textarea>
                        </li>
                        <li>
                            <label for="txtGenre">Genere</label>
                            <select id="selectGenre" required>
                                <option value="">Genere...</option>
                            </select>
                        </li>
                        <li>
                            <label for="uploadfile">Copertina</label>
                            <input type="file" accept="image/png" id="uploadfile" name="uploadfile"/>
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <legend>Brani</legend>
                    <input type="button" id="addSong" value="Aggiungi brano" />
                    <ul></ul>
                </fieldset>
                <fieldset>
                    <legend>Opzioni di vendita</legend>
                    <ul>
                        <li>
                            <input type="checkbox" id="checkCD" name="checkCD" value="CD">
                            <label class="visible" for="checkCD">CD</label>
                        </li>
                        <li>
                            <label for="numCDCopy">Numero copie CD</label>
                            <input type="number" placeholder="Copie CD" id="numCDCopy">
                            <label for="priceCD">Prezzo CD</label>
                            <input type="number" placeholder="Prezzo CD" id="priceCDCopy">
                            <label for="txtCDProductDescription">Descrizione CD</label>
                            <textarea id="txtCDProductDescription" placeholder="descrizione"></textarea>
                        </li>
                        <li>
                            <input type="checkbox" id="checkVinyl" name="checkVinyl" value="Vinile">
                            <label class="visible" for="checkVinyl">Vinile</label>
                        </li>
                        <li>
                            <label for="numVinylCopy">Numero copie Vinili</label>
                            <input type="number" placeholder="Copie vinile" id="numVinylCopy">
                            <label for="priceVinylCopy">Prezzo vinile</label>
                            <input type="number" placeholder="Prezzo vinile" id="priceVinylCopy">
                            <label for="txtVinylProductDescription">Descrizione vinile</label>
                            <textarea id="txtVinylProductDescription" placeholder="descrizione"></textarea>
                        </li>
                        <li>
                            <input type="button" id="btnConfirm" value="Metti in vendita"/>
                        </li>
                    </ul>
                </fieldset>
            </form>
        </section>
    </main>
    <script src="./public/libraries/jquery3.6.0.js"></script>
    <script type="text/javascript" src="./public/js/vendor.js"></script>
    <script type="text/javascript" src="./public/js/page-header.js"></script>
</body>
</html>