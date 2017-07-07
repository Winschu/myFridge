function insertNewArticle(obj) {
    $.post("../../includes/ajax/insertNewArticle.php",
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

    });
}