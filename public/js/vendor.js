//selectGenre
$(document).ready(function () {
    $("#btnConfirm").click((e) => {
        createAlbum();
    });

    $("#checkCD").change(function () {
        if ($(this).is(":checked")) {
            $("fieldset:nth-child(3) li:nth-child(2)").show();
        } else {
            $("fieldset:nth-child(3) li:nth-child(2)").hide();
        }
    });

    $("#checkVinyl").change(function () {
        if ($(this).is(":checked")) {
            $("fieldset:nth-child(3) li:nth-child(4)").show();
        } else {
            $("fieldset:nth-child(3) li:nth-child(4)").hide();
        }
    });

    $("#addSong").click(function () {
        console.log(readSongs());
        const list = $("fieldset:nth-child(2) > ul");
        let count = $(list).children().length + 1;
        const songTemplate = `
        <li>
            <label for="songTitle_${count}">Titolo</label>
            <input id="songTitle_${count}" type="text" placeholder="titolo"/>
            <label for="songDuration_${count}">Durata</label>
            <input id="songDuration_${count}" type="text" placeholder="mm:ss"/>
        </li>`;
        $(list).append(songTemplate);
    });

    getAllGenre();
});

//quando clicco su metti in vendita, da finire durata sommatta dalle canzoni.
function createAlbum() {
    if (txtTitle.value != "" && selectGenre.value != "") {
        let songs = readSongs();
        let products = readProducts();
        addAlbum(txtTitle.value, txtDescription.value, songs[1], selectGenre.value, songs[0], products);
    }
}

function readSongs() {
    let newSongs = {};
    let inputs = $("fieldset:nth-child(2) ul input");
    let totDuration = 0;
    newSongs = [];

    for (let i = 0; i < inputs.length; i += 2) {
        let tmpTitle = inputs[i].value;
        let tmpDuration = convertToSec(inputs[i + 1].value);
        totDuration += tmpDuration;
        newSongs.push({ "title": tmpTitle, "duration": tmpDuration });
    }
    return [newSongs, totDuration];
}

function readProducts() {
    let cdProducts = [], vinylProducts = [];
    let priceCD, priceVinyl;
    if (checkCD.checked && numCDCopy.value != "" && priceCDCopy.value != "") {
        priceCD = Math.round(priceCDCopy.value * 100) / 100;
        cdProducts.push({ "copy": numCDCopy.value, "price": priceCD, "type": 0, "description": txtCDProductDescription.value })
    }
    if (checkVinyl.checked && numVinylCopy.value != "" && priceVinylCopy.value != "") {
        priceVinyl = Math.round(priceVinylCopy.value * 100) / 100;
        vinylProducts.push({ "copy": numVinylCopy.value, "price": priceVinyl, "type": 1, "description": txtVinylProductDescription.value })
    }
    return [cdProducts, vinylProducts];
}

function addAlbum(name, description, duration, genre, songs, products) {
    reqHelper.post("vendor", "addAlbum", {
        name: name,
        description: description,
        duration: duration,
        genre: genre,
        songs: songs,
        products: products
    }, function (data) {
        console.log(data);
        if (data.success) {
            //alert("Album creato con successo :D");
            console.log("Album creato con successo");
        }
    });
}

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
                for (let i = 0; i < data.data.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = data.data[i].name;
                    opt.innerHTML = data.data[i].name;
                    selectGenre.appendChild(opt);
                }
            }
        });
}

//input in formato MM:SS
function convertToSec(time) {
    let min = time.split(":")[0];
    let sec = time.split(":")[1];
    return parseInt(min) * 60 + parseInt(sec)
}

function isNumber(value) {
    return typeof value === 'number' && isFinite(value);
}

