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
            <input type="button" id="getGenreBtn" value="get generi"></input>
            <h1>Inserisci nuovo album</h1>
            <label for="txtTitle">Titolo:</label>
            <input type="text" id="txtTile"/><br>
            <label for="txtDescription">Descrizione:</label>
            <input type="text" id="txtDescription"/><br>
            <label for="txtGenre">Genere:</label>
            <select id="selectGenre">
                <option value="Hip-Hop" selected>Hip-Hop</option>
            </select><br>
            <label for="numSongs">Numero brani:</label>
            <input type="number" id="numSongs"/><br>
            <input type="button" id="confirmSongs" value="Conferma"/>
        </section>

        <br>

        <section>
            <label for="txtTitle-1">Titolo</label>
            <input id = "txtTitle-1" type="text"/><br>
            <label for="txtDuration-1">Durata (MM:SS)</label>
            <input id = "txtDuration-1" type="string"><br>

            <label for="txtTitle-2">Titolo</label>
            <input id = "txtTitle-2" type="text"/><br>
            <label for="txtDuration-2">Durata (MM:SS)</label>
            <input id = "txtDuration-2" type="string"><br>

            <label for="txtTitle-3">Titolo</label>
            <input id = "txtTitle-3" type="text"/><br>
            <label for="txtDuration-3">Durata (MM:SS)</label>
            <input id = "txtDuration-3" type="string"><br>
        </section>

        <section>
            <label for="txtType">Tipo prodotto</label>
            <input id = "txtType" type="text"/><br>
            <label for="txtDuration-1">Durata (MM:SS)</label>
            <input id = "txtDuration-1" type="string"><br>
            
            <h1>Tipo prodotto</h1>
            
            <input type="checkbox" id="checkCD" name="checkCD" value="CD">
            <label for="checkCD">CD</label>
            <input type="number" placeholder="Copie CD" id="numCDCopy" display="none"><br>
            <label for="txtCDProductDescription">Descrizione CD</label>
            <input type="text" id="txtCDProductDescription"/><br>
            
            <input type="checkbox" id="checkVinyl" name="checkVinyl" value="Vinile">
            <label for="checkVinyl">Vinile</label>
            <input type="number" placeholder="Copie vinile" id="numVinylCopy" display="none"><br>
            <label for="txtVinylProductDescription">Descrizione vinile</label>
            <input type="text" id="txtVinylProductDescription"/><br><br>

            <input type="button" id="btnConfirm" value="Aggiungi prodotto"/><br>
            
        </section>


        


    </main>
    <script src="./public/libraries/jquery3.6.0.js"></script>
    <script type="text/javascript" src="./public/js/RequestHelper.js"></script>
    <script type="text/javascript" src="./public/js/myjwtclass.js"></script>
    <script type="text/javascript" src="./public/js/profile.js"></script>
    <script type="text/javascript" src="./public/js/vendor.js"></script>
    
    
</body>
</html>


<?php

?>