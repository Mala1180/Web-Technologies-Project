function stringaToID(stringa) {
    return stringa.toLowerCase().replace(/[^a-zA-Z]/g, "");
}

class Table {
    constructor(data, headers) {
        this.data = data;
        this.headers = headers;
        this.ths = Object.keys(headers);
    }

    #buildHeadRow() {
        var row = "";
        for (let i = 0; i < this.ths.length; i++) {
            row += `<th id="${stringaToID(this.ths[i])}">${this.ths[i]}</th>`
        }
        return "<tr>" + row + "<th id=\"azioni\">Azioni</th></tr>";
    }

    #buildRow(row) {
        let r = "";
        r += `<td id="${stringaToID(row[this.headers[this.ths[0]]])}" headers="${stringaToID(this.ths[0])}">${row[this.headers[this.ths[0]]]}</td>`
        for (let i = 1; i < this.ths.length; i++) {
            r += `<td headers="${stringaToID(row[this.headers[this.ths[0]]])} ${stringaToID(this.ths[i])} ">${row[this.headers[this.ths[i]]]}</td>`;
        }
        return "<tr>" + r + "<td headers=\"azioni " + stringaToID(row[this.headers[this.ths[0]]]) + "\" ><button id=edit_" + row.idProduct + ">Modifica</button> "
            + "<button id=remove_" + row.idProduct + ">Rimuovi</button></td></tr>";
    }

    build() {
        this.table = this.#buildHeadRow();
        datiTabella.forEach(r => {
            this.table += this.#buildRow(r);
        })
        return this.table;
    }
}

function getProducts() {
    reqHelper.get("products", "getvendorproducts", {
        name: $("#searchName").val(),
        type: $("#searchType").val()
    }, function (response) {
        datiTabella = response.data;
        var headers = {
            nome: "name",
            artista: "artName",
            tipo: "type",
            prezzo: "price",
            "quantità": "quantity"
        }
        $("table").html(new Table(response.data, headers).build());
        datiTabella.forEach(r => {
            $("#edit_" + r.idProduct).click(async function () {
                const { value: formValues } = await Swal.fire({
                    title: 'Modifica prodotto',
                    html:
                        '<label for="txtPrezzo">Prezzo</label><input id="txtPrezzo" name="txtPrezzo" type="text" />' +
                        '<label for="txtQuantita">Quantità</label><input id="txtQuantita" name="txtQuantita" type="number"/>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: "Conferma",
                    cancelButtonText: "Annulla",
                    preConfirm: () => {
                        return [
                            document.getElementById('txtPrezzo').value,
                            document.getElementById('txtQuantita').value
                        ]
                    },
                    didOpen: () => {
                        $("#txtPrezzo").val(r.price);
                        $("#txtQuantita").val(r.quantity);
                    }
                })

                if (formValues) {
                    reqHelper.post("products", "editProduct", {
                        idProduct: r.idProduct,
                        price: formValues[0],
                        quantity: formValues[1]
                    }, function (data) {
                        if (data.success) {
                            getProducts();
                            Swal.fire("", "prodotto modificato correttamente", "success");
                        } else {
                            Swal.fire("", "si e verificato un errore", "error");
                        }
                    });
                }
            });
            $("#remove_" + r.idProduct).click(function () {
                Swal.fire({
                    title: 'Vuoi davvero eliminare questo prodotto?',
                    showCancelButton: true,
                    confirmButtonText: 'Elimina',
                    cancelButtonText: "Annulla"
                }).then((result) => {
                    if (result.isConfirmed) {
                        reqHelper.post("products", "removeProduct", {
                            idProduct: r.idProduct
                        }, function (data) {
                            if (data.success) {
                                getProducts();
                                Swal.fire("", "prodotto eliminato correttamente", "success");
                            } else {
                                Swal.fire("", "si e verificato un errore", "error");
                            }
                        });
                    }
                });
            });
        });
    });
}

$(document).ready(function () {
    getProducts();
    $("#search").click(function (e) {
        e.preventDefault();
        getProducts();
    });
})