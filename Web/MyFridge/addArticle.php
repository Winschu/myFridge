<?php
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            //TODO: Müsste noch eingestellt werden wie die Abfragen auf Eingabe überprüft werden sollen
            getArticleGroupList();
            getProducerNameList();

            $("#submitFormButton").click(function () {
                var formArray = $("#newArticleForm").serializeArray();
                var newArticle = {
                    name: formArray[0].value,
                    articleGroup: formArray[1].value,
                    producer : formArray[2].value,
                    barcode : formArray[3].value,
                    size : formArray[4].value,
                    sizeType : formArray[5].value,
                    price : formArray[6].value
                };
                insertNewArticle(newArticle);
            });

        });
    </script>
    <title>Neuen Artikel anlegen</title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Neuer Artikel
        </h2>
        <div class="card-text">
            <form role="form" id="newArticleForm" name="newArticleForm" method="post" enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        Name
                        <input type="text" class="form-control" name="nameInput" id="nameInput"
                               placeholder="Artikelname eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-6">
                        Artikelgruppe
                        <select class="form-control" name="articleGroupSelect" id="articleGroupSelect"
                                title="articleGroupSelect">
                            <option value="" selected disabled>Bitte auswählen...</option>
                        </select>
                    </div>
                    <div class="p-6">
                        Hersteller
                        <select class="form-control" name="producerNameSelect" id="producerNameSelect"
                                title="producerNameSelect">
                            <option value="" selected disabled>Bitte auswählen...</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-12">
                        Barcode
                        <input type="number" class="form-control" name="barcodeInput" id="barcodeInput"
                               placeholder="Barcode eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-6">
                        Größe
                        <input type="number" class="form-control" name="sizeInput" id="sizeInput"
                               placeholder="Größe eintragen...">
                    </div>
                    <div class="p-6">
                        Einheit
                        <select class="form-control" name="sizeTypeSelect" id="sizeTypeSelect" title="sizeTypeSelect">
                            <option value="g">g</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="l">l</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        Kaufpreis
                        <input type="number" class="form-control" name="priceInput" id="priceInput"
                               placeholder="Kaufpreis eintragen...">
                    </div>
                </div>
                <div class="d-flew flex-wrap justify-content-center">
                    <div class="p-12">
                        <button type="button" class="btn btn-primary" id="submitFormButton"
                                style="padding: 5px; cursor: pointer;">Abschicken
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>