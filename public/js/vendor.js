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
    //addAlbum(txtTitle.value, txtDescription.value, songs[1], selectGenre.value, songs[0], products);
    if(txtTitle.value != "" && selectGenre.value != "") {
        let songs = readSongs();
        let products = readProducts();
        addAlbum(txtTitle.value, txtDescription.value, songs[1], selectGenre.value, songs[0], products);    
    } 
}

function readSongs() {
    let newSongs = {};
    let songsTitle = document.getElementsByClassName('songTitle');
    let songsDuration = document.getElementsByClassName('songDuration');
    let totDuration = 0;
    newSongs = [];

    for (let i = 0; i < songsTitle.length; i++){
        let tmpTitle = songsTitle[i].value;
        let tmpDuration = convertToSec(songsDuration[i].value);
        totDuration += tmpDuration;
        newSongs.push({"title": tmpTitle, "duration" : tmpDuration});
    }
    return [newSongs, totDuration];
}

function readProducts() {
    let cdProducts = [], vinylProducts = [];
    let priceCD, priceVinyl;
    if(checkCD.checked && numCDCopy.value != "" && priceCDCopy.value != "") {
        priceCD = Math.round(priceCDCopy.value * 100) / 100;
        cdProducts.push({"copy": numCDCopy.value, "price": priceCD, "type": 0, "description": txtCDProductDescription.value})
    }
    if(checkVinyl.checked && numVinylCopy.value != "" && priceVinylCopy.value != "") { 
        priceVinyl = Math.round(priceVinylCopy.value * 100) / 100;
        vinylProducts.push({"copy": numVinylCopy.value, "price": priceVinyl, "type" : 1, "description": txtVinylProductDescription.value})
    }   
    return [cdProducts, vinylProducts];
}

async function addAlbum(name, description, duration, genre, songs, products) {
    reqHelper.post("vendor", "addAlbum", {
        name: name,
        description: description,
        duration: duration,
        genre: genre,
        songs: songs,
        products: products,
        image: await toBase64(uploadfile.files[0])
    }, function (data) {
        console.log(data);
        if (data.success) {
            //alert("Album creato con successo :D");
            console.log("Album creato con successo");
        }
   });
}

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});


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

function setAlbumGenre(albumTitle, genre) {
    reqHelper.post("vendor", "setAlbumGenre", {
        albumTitle: albumTitle,
        genre: genre
    });
}

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

