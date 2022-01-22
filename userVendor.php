<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php require_once("templates/head-section.php") ?>
    <title>Unibo Vinyl - Venditore</title>
    <link rel="stylesheet" href="./public/css/userVendor.css">
</head>
<body>
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
                    </ul>
                </fieldset>
                <fieldset>
                    <legend>Brani</legend>
                    <ul></ul>
                    <input type="button" id="addSong" value="Aggiungi brano" />
                </fieldset>
                <fieldset>
                    <legend>Copertina</legend>
                    <ul></ul>
                    <input type="file" id="uploadfile" name="uploadfile"/>
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
</body>
</html>