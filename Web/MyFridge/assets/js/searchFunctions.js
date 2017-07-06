
var articleArray = [];

function getSearchResult (searchTerm, startPos, rowCount) {
    $.post("../../includes/ajax/getAllArticles.php", {searchTerm : searchTerm, startPos : startPos, rowCount : rowCount}).done(function (data) {
       for(var i = 0; i < data.length; i++) {
            var article = {
                name : data[i].name,
                groupName : data[i].groupName,
                barcode : data[i].barcode,
                highestPrice : data[i].highestPrice,
                producerName : data[i].producerName,
                size : data[i].size,
                sizeType : data[i].sizeType,
                lastUpdate : data[i].lastUpdate
            };
            articleArray.push(article);
       }
        for(var j = 0; j < articleArray.length; j++) {
            $("#articleList").append(createListItem(articleArray[j]));
        }
    });
}

function createListItem(articleItem) {
    var s = "";

    JsBarcode(".barcode").init();

    s += "<div class='card'>";
    s += "<div class='card-block'>";
    s += "<div class='d-flex flex-wrap justify-content-between'>";

    s += "<div class='p-6'>";
    s += articleItem.name + " (" + articleItem.producerName + ")";

    s += "<div class='d-flex flex-wrap justify-content-between'>";
    s += "<div class='p-6'>";
    s += articleItem.highestPrice;
    s += "</div>";
    s += "<div class='p-6'>";
    s += articleItem.size + articleItem.sizeType;
    s += "</div>";
    s += "</div>";

    s += "</div>";



    s += "<div class='p-6'>";
    s += "<svg class='barcode' jsbarcode-height='20' jsbarcode-format='EAN13' jsbarcode-value='" + articleItem.barcode + "' jsbarcode-textmargin='0' jsbarcode-fontoptions='bold'></svg>";
    s += "</div>";

    s += "</div>";
    s += "</div>";
    s += "</div>";

    JsBarcode(".barcode").init();
    return s;
}