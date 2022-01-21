//selectGenre

$(document).ready(function () {

    $("#confirmSongs").click((e) => {  
        displaySongField(parseInt(numSongs.value));
    });

    $("#btnConfirm").click((e) => {  
        createAlbum();
    });

    getAllGenre();

});

//quando clicco su metti in vendita, da finire durata sommatta dalle canzoni.
function createAlbum(){
    if(txtTitle.value != "" && selectGenre.value != "") {
        addAlbum(txtTitle.value, txtDescription.value, 0);
    } 
    // addProduct()
}



function addSongs(){
    let songsTitle = document.getElementsByClassName('songTitle');
    let songsDuration = document.getElementsByClassName('songDuration');

    for (let i = 0; i < songsTitle.length; i++){
        let tmpTitle = songsTitle[i].value;
        let tmpDuration = convertToSec(songsDuration[i].value);
        addSongToAlbum(txtTitle.value, tmpTitle, tmpDuration);
    }
}

//non provata
function addAlbum(name, description, duration) {
    reqHelper.post("vendor", "addAlbum", {
        name: name,
        description: description,
        duration: duration
    }, function (data) {
        console.log(data);
        if (data.success) {
            setAlbumGenre(txtTitle.value, selectGenre.value);
            addSongs();
            checkProducts();
        }
   });
}


function checkProducts() {
    let numCDs, numVinyls, priceCD, priceVinyl;
    if(checkCD.checked && numCDCopy.value != "" && priceCDCopy.value != "") {
        numCDs = numCDCopy.value;
        priceCD = Math.round(priceCDCopy.value * 100) / 100;
        addProduct(numCDs, priceCD, txtCDProductDescription.value, 0)
    }
    if(checkVinyl.checked && numVinylCopy.value != "" && priceVinylCopy.value != "") { 
        numVinyls = numVinylCopy.value;
        priceVinyl = Math.round(priceVinylCopy.value * 100) / 100;
        addProduct(numVinyls, priceVinyl, txtVinylProductDescription.value, 1)
    }    
}

//non provata 0 == CD, 1 == Vinile.
//$name, $quantity, $price, $description, $type, $idAuthor, $idAlbum
function addProduct(quantity, price, description, type) {
    reqHelper.post("vendor", "addProduct", {
        albumTitle: txtTitle.value,
        quantity: quantity,
        price: price,
        description: description,
        type: type
    },
    function (data) {
        console.log(data);
       if (data.success) {
           console.log(data)
       }
   });
}

function addSongToAlbum(albumTitle, name, duration) {
    reqHelper.post("vendor", "addSongToAlbum", {
        albumTitle: albumTitle,
        name: name, 
        duration: duration
    });
}


function setAlbumGenre(albumTitle, genre) {
    reqHelper.post("vendor", "setAlbumGenre", {
        albumTitle: albumTitle,
        genre: genre
    });
}


//non funziona
function getAllGenre() {
    reqHelper.post("vendor", "getAllGenre", {},
    function (data) {
       if (data.success) {
        for (let i = 0; i < data.data.length; i++){
            var opt = document.createElement('option');
            opt.value = data.data[i].name;
            opt.innerHTML = data.data[i].name;
            selectGenre.appendChild(opt);
        }
       }
   });
}



function displaySongField(n) {
    if(isNumber(n)) {
        sectionSongs.innerHTML = "";
        for (var i = 0; i < n; i++){
            let tmpSongId = "song-" + i;
            let tmpDurId = "duration-" + i;

            let lblTitle = document.createElement('label');
            lblTitle.setAttribute("for", tmpSongId);
            lblTitle.innerHTML = "Titolo canzone " + i;

            let inpTitle = document.createElement('input');
            inpTitle.type = "text"
            inpTitle.classList.add("songTitle");
            inpTitle.setAttribute("id", tmpSongId);

            let lblDurata = document.createElement('label');
            lblDurata.setAttribute("for", tmpDurId);
            lblDurata.innerHTML = "Durata (MM:SS)";

            let inpDurata = document.createElement('input');
            inpDurata.type = "text"
            inpDurata.classList.add("songDuration");
            inpDurata.setAttribute("id", tmpDurId);


            sectionSongs.appendChild(lblTitle);
            sectionSongs.appendChild(inpTitle);
            sectionSongs.appendChild(document.createElement('br'));
            sectionSongs.appendChild(lblDurata);
            sectionSongs.appendChild(inpDurata);
            sectionSongs.appendChild(document.createElement('br'));
        }
        sectionSongs.appendChild(document.createElement('br'));
    }
}

//input in formato MM:SS
function convertToSec(time) {

    let min = time.split(":")[0];
    let sec = time.split(":")[1];

    return parseInt(min) * 60 + parseInt(sec)
}

function isNumber(value) {
    return typeof value === 'number' && isFinite(value);
}

// $(".checkbox").change(function() {
//     switch (this.value) {
//         case "CD":
//             if(this.checked) {
//                 numCDCopy.display = block;
//             } else {
//                 numCDCopy.visibility = hidden;
//             }
//             break;
//         case "Vinile":
//             if(this.checked) {
//                 numVinylCopy.visibility = visible;
//             } else {
//                 numVinylCopy.visibility = hidden;
//             }
//             break;
//     }
// });


