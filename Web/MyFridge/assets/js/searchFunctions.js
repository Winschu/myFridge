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
            data = data.data;
            for (var i = 0; i < data.length; i++) {
                var article = {
                    name: data[i].name,
                    groupName: data[i].groupName,
                    barcode: data[i].barcode,
                    highestPrice: data[i].highestPrice,
                    producerName: data[i].producerName,
                    size: data[i].size,
                    sizeType: data[i].sizeType,
                    lastUpdate: data[i].lastUpdate
                };
                articleArray.push(article);
            }
            for (var j = 0; j < articleArray.length; j++) {
                $("#articleList").append(createListItem(articleArray[j]));
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
            data = data.data;
            for (var i = 0; i < data.length; i++) {
                var article = {
                    name: data[i].name,
                    groupName: data[i].groupName,
                    barcode: data[i].barcode,
                    highestPrice: data[i].highestPrice,
                    size: data[i].size,
                    sizeType: data[i].sizeType,
                    lastUpdate: data[i].lastUpdate
                };
                articleArray.push(article);
            }
            for (var j = 0; j < articleArray.length; j++) {
                $("#articleList").append(createUserListItem(articleArray[j], false));
            }
        }
    });
}

function getAllArticlesByUser(userName) {
    $.post("/ajax.php?action=getAllArticlesByUser", {name: userName}).done(function (data) {
        if(data.success) {
            data = data.data;
            for (var i = 0; i < data.length; i++) {
                var article = {
                    name: data[i].name,
                    producerName: data[i].producerName,
                    groupName: data[i].groupName,
                    barcode: data[i].barcode,
                    size: data[i].size,
                    sizeType: data[i].sizeType,
                    data: data[i].date,
                    count: data[i].count,
                    price: data[i].price
                };
                articleArray.push(article);
            }
            for (var j = 0; j < articleArray.length; j++) {
                $("#articleList").append(createUserListItem(articleArray[j], true));
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
 * Listeneintrag für die Ausgabe der Suche erstellen
 */
function createListItem(articleItem) {
    var s = "";

    s += "<div class='card'>";
    s += "<div class='card-block'>";
    s += "<div class='d-flex flex-wrap justify-content-between'>";

    //Main box
    s += "<div class='p-6'>";
    s += "<a href='productDetail.php?articleName=" + encodeURIComponent(articleItem.name) + "'>" + articleItem.name + "</a>";

    s += " (" + "<a href='producerList.php?producerName=" + encodeURIComponent(articleItem.producerName) + "'>" + articleItem.producerName + "</a>" + ")";

    s += "<div class='d-flex flex-wrap justify-content-between'>";
    s += "<div class='p-6'>";
    s += articleItem.highestPrice;
    s += "</div>";
    s += "<div class='p-6'>";
    s += articleItem.size + articleItem.sizeType;
    s += "</div>";
    s += "</div>";

    s += "</div>";
    //end of Main box

    //Barcode
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
    return s;
}

/*
 * Listeneintrag für die Ausgabe der Suche nach Herstellerprodukten erstellen
 */
function createUserListItem(articleItem, displayProducer) {
    var s = "";

    s += "<div class='card'>";
    s += "<div class='card-block'>";
    s += "<div class='d-flex flex-wrap justify-content-between'>";

    //Main box
    s += "<div class='p-6'>";
    s += "<a href='productDetail.php?articleName=" + encodeURIComponent(articleItem.name) + "'>" + articleItem.name + "</a>";
    if(displayProducer)
        s += " (" + "<a href='producerList.php?producerName=" + encodeURIComponent(articleItem.producerName) + "'>" + articleItem.producerName + "</a>" + ")";

    s += " (x" + articleItem.count + ")";

    s += "<div class='d-flex flex-wrap justify-content-between'>";
    s += "<div class='p-6'>";
    s += articleItem.price;
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