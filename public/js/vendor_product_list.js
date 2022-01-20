function stringaToID(stringa) {
    return stringa.toLowerCase().replace(/[^a-zA-Z]/g, "");
}

class Table {
    constructor(data, headers) {
        this.data = data;
        this.headers = headers;
        this.ths = Object.keys(headers);
        console.log(this.data);
    }

    #buildHeadRow() {
        var row = "";
        for (let i = 0; i < this.ths.length; i++) {
            row += `<th>${this.ths[i]}</th>`
        }
        return "<tr>" + row + "</tr>";
    }

    #buildRow(row) {
        let r = "";
        for (let i = 0; i < this.ths.length; i++) {
            r += `<td>${row[this.headers[this.ths[i]]]}</th>`
        }
        return "<tr>" + r + "</tr>";
    }

    build() {
        this.table = this.#buildHeadRow();
        datiTabella.forEach(r => {
            this.table += this.#buildRow(r);
        })
        return this.table;
    }
}

$(document).ready(function () {
    reqHelper.get("products", "getallproducts", {}, function (response) {
        datiTabella = response.data;
        const ths = Object.keys(datiTabella[0]);
        var headers = {
            nome: "name",
            prezzo: "price",
            "quantità": "quantity"
        }
        $("table").html(new Table(response.data, headers).build());
        console.log(response);
    });
})