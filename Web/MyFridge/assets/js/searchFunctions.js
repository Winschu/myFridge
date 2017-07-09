var articleArray = [];
var articleGroupArray = [];
var producerArray = [];

/*
 * Gibt Suchergebnisse die auf den Suchbegriff passen zurück und grenzt die Ausgabe auf die gegebenen Parameter ein
 */
function getSearchResult(searchTerm, startPos, rowCount) {
    $.post("/ajax.php?action=getAllArticles", {
        searchTerm: searchTerm,
        startPos: startPos,
        rowCount: rowCount
    }).done(function (data) {
        if(data.success){
            for (var j = 0; j < data.data.length; j++) {
                $("#articleList").append(createListItem(data.data[j], true));
            }
            JsBarcode(".barcode").init();
    }
    });
}

/*
 * Gibt alle Artikelgruppen in der Datenbank zurück
 */
function getArticleGroupList() {
    $.get("/ajax.php?action=getAllArticleGroup").done(function (data) {
        if(data.success) {
            data = data.data;
            for (var i = 0; i < data.length; i++) {
                var articleGroup = {
                    name: data[i].name
                };
                articleGroupArray.push(articleGroup);
            }
            for (var j = 0; j < articleGroupArray.length; j++) {
                $("#articleGroupSelect").append(createSelectOption(articleGroupArray[j].name));
            }
        }
    });
}

/*
 * Gibt alle Hersteller in der Datenbank zurück
 */
function getProducerNameList() {
    $.get("/ajax.php?action=getAllProducer").done(function (data) {
        if(data.success) {
            data = data.data;
            for (var i = 0; i < data.length; i++) {
                var producer = {
                    name: data[i].name
                };
                producerArray.push(producer);
            }
            for (var j = 0; j < producerArray.length; j++) {
                $("#producerNameSelect").append(createSelectOption(producerArray[j].name));
            }
        }
    });
}

/*
 * Gibt alle Artikel eines Herstellers zurück
 */
function getAllArticlesByProducer(producerName) {
    $.post("/ajax.php?action=getAllArticlesByProducer", {producerName: producerName}).done(function (data) {
        if(data.success) {
            for (var j = 0; j < data.data.length; j++) {
                $("#articleList").append(createListItem(data.data[j], false));
            }
        }
    });
}

function getAllArticlesByUser(userName) {
    $.post("/ajax.php?action=getAllArticlesByUser", {name: userName}).done(function (data) {
        if(data.success) {
            for (var j = 0; j < data.data.length; j++) {
                $("#articleList").append(createListItem(data.data[j], true));
            }
        }
    });
}

/*
 * Abgekürzte Funktion zur Erstellung einer Auswahloption mit gleichem Wert und Anzeigetext
 */
function createSelectOption(d) {
    var s = "";

    s += "<option value='" + d + "'>" + d + "</option>";

    return s;
}

/*
 * Listeneintrag für die Ausgabe der Suche nach Herstellerprodukten erstellen
 */
function createListItem(articleItem, displayProducer) {
    var s = "";

    s += "<div class='card'>";
    s += "<div class='card-block'>";
    s += "<div class='d-flex flex-wrap justify-content-between'>";

    //Main box
    s += "<div class='p-6'>";
    s += "<a href='productDetail.php?articleName=" + encodeURIComponent(articleItem.name) + "'>" + articleItem.name + "</a>";
    if(displayProducer && articleItem.producerName)
        s += " (" + "<a href='producerList.php?producerName=" + encodeURIComponent(articleItem.producerName) + "'>" + articleItem.producerName + "</a>" + ")";

    if(articleItem.count)
        s += " (x " + articleItem.count + ")";

    s += "<div class='d-flex flex-wrap justify-content-between'>";
    s += "<div class='p-6'>";
    if(articleItem.highestPrice)
        s += articleItem.highestPrice;
    s += "</div>";
    s += "<div class='p-6'>";
    s += articleItem.size + articleItem.sizeType;
    s += "</div>";
    s += "</div>";

    s += "</div>";
    //end of Main box

    //Barcode
    if(articleItem.barcode) {
        var barcodeType = null;
        if (articleItem.barcode.length === 13)
            barcodeType = "EAN13";
        else if (articleItem.barcode.length === 8)
            barcodeType = "EAN8";

        if (barcodeType) {
            s += "<div class='p-6'>";
            s += '<svg class="barcode" jsbarcode-height="20" jsbarcode-format="' + barcodeType + '" jsbarcode-value="' + articleItem.barcode + '" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold"></svg>';
            s += '</div>';

            s += "</div>";
            s += "</div>";
            s += "</div>";
        }
    }
    return s;
}