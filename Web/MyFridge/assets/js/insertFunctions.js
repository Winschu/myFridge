function insertNewArticle(obj) {
    $.post("/ajax.php?action=insertNewArticle",
        {
            name : obj.name,
            articleGroup : obj.articleGroup,
            producer : obj.producer,
            barcode : obj.barcode,
            size : obj.size,
            sizeType : obj.sizeType,
            price : obj.price
        }
        ).done(function (data) {
            if(data) {
                alert("Artikel wurder der Datenbank hinzugefügt!");
            }
            else
            {
                alert("Es trat ein Fehler auf!");
            }
    });
}