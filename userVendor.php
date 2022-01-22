<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <title>Unibo Vinyl - Venditore</title>
</head>
<body>
    <header>
    <!-- wait for mala -->
    </header>
    <main>  
        <section>
            <h1>Inserisci nuovo album</h1>
            <label for="txtTitle">Titolo:</label>
            <input type="text" id="txtTitle" required/><br>
            <label for="txtDescription">Descrizione:</label>
            <input type="text" id="txtDescription" required/><br>
            <label for="txtGenre">Genere:</label>
            <select id="selectGenre" required>
            </select><br>
            <label for="numSongs">Numero brani:</label>
            <input type="number" id="numSongs" required/><br>
            <input type="button" id="confirmSongs" value="Conferma"/>
        </section>

        <br>

        <section id="sectionSongs">
        </section>

        <section>
            <h1>Tipo prodotto</h1>
            
            <input type="checkbox" id="checkCD" name="checkCD" value="CD">
            <label for="checkCD">CD</label>
            <input type="number" placeholder="Copie CD" id="numCDCopy"><br>
            <label for="txtCDProductDescription">Descrizione CD</label>
            <input type="text" id="txtCDProductDescription"/><br>
            <label for="priceCD">Prezzo CD</label>
            <input type="number" placeholder="Prezzo CD" id="priceCDCopy"><br><br>
            
            <input type="checkbox" id="checkVinyl" name="checkVinyl" value="Vinile">
            <label for="checkVinyl">Vinile</label>
            <input type="number" placeholder="Copie vinile" id="numVinylCopy"><br>
            <label for="txtVinylProductDescription">Descrizione vinile</label>
            <input type="text" id="txtVinylProductDescription"/><br>
            <label for="priceVinyl">Prezzo vinile</label>
            <input type="number" placeholder="Prezzo vinile" id="priceVinylCopy"><br>

            <input type="file" id="uploadfile" name="uploadfile" value="Scegli copertina" />
            <input type="button" id="btnConfirm" value="Metti in vendita"/><br>
            
        </section>


        


    </main>
    <script src="./public/libraries/jquery3.6.0.js"></script>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/profile.js"></script>
    <script type="text/javascript" src="./public/js/vendor.js"></script>
    
    
</body>
</html>