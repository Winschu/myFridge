var articleArray = [];
var articleGroupArray = [];
var producerArray = [];

/*
 * Gibt Suchergebnisse die auf den Suchbegriff passen zurück und grenzt die Ausgabe auf die gegebenen Parameter ein
 */
function getSearchResult(searchTerm, startPos, rowCount) {
    $.post("../../includes/ajax/getAllArticles.php", {
        searchTerm: searchTerm,
        startPos: startPos,
        rowCount: rowCount
    }).done(function (data) {
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
    });
}

/*
 * Gibt alle Artikelgruppen in der Datenbank zurück
 */
function getArticleGroupList() {
    $.get("../../includes/ajax/getAllArticleGroup.php").done(function (data) {
        for (var i = 0; i < data.length; i++) {
            var articleGroup = {
                name: data[i].name
            };
            articleGroupArray.push(articleGroup);
        }
        for (var j = 0; j < articleGroupArray.length; j++) {
            $("#articleGroupSelect").append(createSelectOption(articleGroupArray[j].name));
        }
    });
}

/*
 * Gibt alle Hersteller in der Datenbank zurück
 */
function getProducerNameList() {
    $.get("../../includes/ajax/getAllProducer.php").done(function (data) {
        for (var i = 0; i < data.length; i++) {
            var producer = {
                name: data[i].name
            };
            producerArray.push(producer);
        }
        for (var j = 0; j < producerArray.length; j++) {
            $("#producerNameSelect").append(createSelectOption(producerArray[j].name));
        }
    });
}

/*
 * Gibt Benutzer mit gegebenem Benutzernamen zurück
 */
function getSpecificUser(userName) {
    $.post("includes/ajax/getSpecificUser.php", {userName: userName}).done(function (data) {
        //TODO: Irgendwas übergeben lassen
    });
}

/*
 * Gibt alle Artikel eines Herstellers zurück
 */
function getAllArticlesByProducer(producerName) {
    $.post("../../includes/ajax/getAllArticlesByProducer.php", {producerName: producerName}).done(function (data) {
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
            $("#articleList").append(createProducerListItem(articleArray[j]));
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
    s += "<div class='p-6'>";
    s += "<svg class='barcode' jsbarcode-height='20' jsbarcode-format='EAN13' jsbarcode-value='" + articleItem.barcode + "' jsbarcode-textmargin='0' jsbarcode-fontoptions='bold'></svg>";
    s += "</div>";

    s += "</div>";
    s += "</div>";
    s += "</div>";

    JsBarcode(".barcode").init();
    return s;
}

/*
 * Listeneintrag für die Ausgabe der Suche nach Herstellerprodukten erstellen
 */
function createProducerListItem(articleItem) {
    var s = "";

    s += "<div class='card'>";
    s += "<div class='card-block'>";
    s += "<div class='d-flex flex-wrap justify-content-between'>";

    //Main box
    s += "<div class='p-6'>";
    s += "<a href='productDetail.php?articleName=" + escapeHtml(articleItem.name) + "'>" + articleItem.name + "</a>";

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
    s += "<div class='p-6'>";
    s += "<svg class='barcode' jsbarcode-height='20' jsbarcode-format='EAN13' jsbarcode-value='" + articleItem.barcode + "' jsbarcode-textmargin='0' jsbarcode-fontoptions='bold'></svg>";
    s += "</div>";

    s += "</div>";
    s += "</div>";
    s += "</div>";

    JsBarcode(".barcode").init();
    return s;
}


/*
 * Author: Kip @ StackOverflow
 */
function escapeHtml(text) {

    var s = text;

    s.replace("&", "||");

    return s;
}

/*
 * Link encoden
 */
function linkEncoder(link) {
    $.post("../../includes/ajax/linkEncoder.php", {link: link}).then(function (data) {
        console.log(data);
        return data;
    });
}