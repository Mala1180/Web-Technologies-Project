//selectGenre

$(document).ready(function () {
    // $("#getGenreBtn").click((e) => {

    //     e.preventDefault();
    //     getAllGenre();
    //     console.log("ciao");

    // });

    $("#confirmSongs").click((e) => {  
        //displaySongField(parseInt(numSongs.value));
        getAllGenre();
    });

    $("#btnConfirm").click((e) => {  
        alert("ok");
        
    });

    
    
    
    //richiedo i generi disponibili
    //riempio select generi
    

    


});

//non provata
function addAlbum(name, description, duration) {
    reqHelper.post("vendor", "addAlbum", {
        jwt: jwt.getJWT(),
        name: name,
        description: description,
        duration: duration
    },
    function (data) {
        console.log(data);
       if (data.success) {
           console.log(data)
       }
   });
}

//non provata 0 == CD, 1 == Vinile.
//$name, $quantity, $price, $description, $type, $idAuthor, $idAlbum
function addProduct(name, quantity, price, description, type, idAuthor, idAlbum) {
    reqHelper.post("vendor", "addProduct", {
        jwt: jwt.getJWT(),
        name: name,
        quantity: quantity,
        price: price,
        description: description,
        type:type,
        idAuthor: idAuthor,
        idAlbum: idAlbum
    },
    function (data) {
        console.log(data);
       if (data.success) {
           console.log(data)
       }
   });
}

function addSongAlbum(idAlbum, name, duration) {
    reqHelper.post("vendor", "addSongToAlbum", {
        jwt: jwt.getJWT(),
        idAlbum: idAlbum,
        name:name, 
        duration: duration
    },
    function (data) {
        console.log(data);
       if (data.success) {
           console.log(data)
       }
   });
}


//non funziona
function getAllGenre() {
    reqHelper.post("vendor", "getAllGenre", {},
    function (data) {
        console.log(data);
       if (data.success) {
           console.log(data)
       }
   });
}



function displaySongField(n) {
    if(isNumber(n)) {
        //creo n slot brani, non so in che modo sia meglio farlo
        console.log(n)
    }
}

//input in formato MM:SS
function convertToSec(time) {

    let min = time.split(":")[0]
    let sec = time.split(":")[1]

    if(isNumber(min) && isNumber(sec)){
        return min * 60 + sec
    }
}

function isNumber(value) {
    return typeof value === 'number' && isFinite(value);
}

$(".checkbox").change(function() {
    switch (this.value) {
        case "CD":
            if(this.checked) {
                numCDCopy.display = block;
            } else {
                numCDCopy.visibility = hidden;
            }
            break;
        case "Vinile":
            if(this.checked) {
                numVinylCopy.visibility = visible;
            } else {
                numVinylCopy.visibility = hidden;
            }
            break;
    }
});


