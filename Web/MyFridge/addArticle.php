<?php
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {

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
            <form>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        Name
                        <input type="text" class="form-control" id="nameInput" placeholder="Artikelname eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-6">
                        Artikelgruppe
                        <select class="form-control" id="articleGroupSelect" title="articleGroupSelect">
                            <option>EMPTY</option>
                        </select>
                    </div>
                    <div class="p-6">
                        Hersteller
                        <select class="form-control" id="producerNameSelect" title="producerNameSelect">
                            <option>EMPTY</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-12">
                        Barcode
                        <input type="number" class="form-control" id="barcodeInput" placeholder="Barcode eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-6">
                        Größe
                        <input type="number" class="form-control" id="sizeInput" placeholder="Größe eintragen...">
                    </div>
                    <div class="p-6">
                        Einheit
                        <select class="form-control" id="sizeTypeSelect" title="sizeTypeSelect">
                            <option value="g">g</option>
                            <option value="kg">kg</option>
                            <option value="ml">ml</option>
                            <option value="l">l</option>
                        </select>
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