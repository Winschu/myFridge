<?php
require_once("config.php");
if (!isset($_SESSION["user"])) {
    header('Location: http://localhost/index.php');
}
require_once("includes/loadAssets.html");
require_once("includes/dbCredentials.php");
require_once("includes/articleObject.php");
?>
<html>
<head>
    <title>Artikel</title>
    <?php require_once("includes/loadNavbar.php"); ?>
    <?php
    $article = null;
    $articleName = $_GET["articleName"];
    $articleName = str_replace("%20", " ", $articleName);
    $dbCon = new dbCredentials();
    $pgCon = pg_connect($dbCon->getDBString());
    $result = pg_query($pgCon, "
SELECT name, group_name, barcode, highest_price, producer_name, size, size_type, last_update
FROM article
WHERE name = '$articleName'
");
    if (!$result) {
        echo "Ein Fehler ist aufgetreten.\n";
        exit;
    }
    while ($data = pg_fetch_object($result)) {
        $article = new articleObject($data);
    }
    ?>
    <script>
        $(document).ready(function () {
            var user = "<?php echo $_SESSION["user"]; ?>";

            /*
             * if article in inventory
             * show Change/Delete
             */

            $("#addInventoryButton").click(function () {
                var formArray = $("#articleToInventoryForm").serializeArray();
                var inventoryEntry =
                    {
                        date: formArray[0].value,
                        price: formArray[1].value,
                        count: formArray[2].value,
                        user: user,
                        barcode: "<?php echo $article->getArticleBarcode(); ?>"
                    };

                addArticleToInventory(inventoryEntry);
            });

            $("#changeArticleButton").click(function () {
                var formArray = $("#changeArticleInventoryForm").serializeArray();
                var inventoryEntry = {
                    count: formArray[0].value,
                    user: user,
                    barcode: "<?php echo $article->getArticleBarcode(); ?>"
                };
                changeArticleInventory(inventoryEntry);
            });

            $("#deleteInventoryButton").click(function () {
                var inventoryEntry = {
                    user: user,
                    barcode: "<?php echo $article->getArticleBarcode(); ?>"
                };
                deleteArticleInventory(inventoryEntry);
            });
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header text-center" id="articleNameText">
            <?php echo $article->getArticleName(); ?>
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-12">
                    Artikelgruppe: <?php echo $article->getArticleGroupName(); ?>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-12">
                    Hersteller: <?php echo $article->getArticleProducerName(); ?>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    Inhalt: <?php echo $article->getArticleSize() . $article->getArticleSizeType(); ?>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <svg class="barcode" jsbarcode-format="EAN13"
                         jsbarcode-value="<?php echo $article->getArticleBarcode(); ?>" jsbarcode-textmargin='0'
                         jsbarcode-fontoptions='bold'></svg>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    Höchster
                    Preis: <?php echo $article->getArticleHighestPrice() . " (vom " . $article->getArticleLastUpdate() . ")"; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <h2 class="card-header text-center" id="addArticvleToInventoryHeader">
            Artikel dem eigenen Inventar hinzufügen
        </h2>
        <div class="card-text">
            <form role="form" id="articleToInventoryForm" name="articleToInventoryForm" method="post"
                  enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-4">
                        MHD oder MVD
                        <input type="date" class="form-control" name="dateInput" id="dateInput"
                               placeholder="MHD eintragen...">
                    </div>
                    <div class="p-4">
                        Kaufpreis
                        <input type="number" class="form-control" name="priceInput" id="priceInput"
                               placeholder="Kaufpreis eintragen...">
                    </div>
                    <div class="p-4">
                        Anzahl
                        <input type="number" class="form-control" name="countInput" id="countInput"
                               placeholder="Anzahl eintragen...">
                    </div>
                </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <button type="button" class="btn btn-primary" name="addInventoryButton" id="addInventoryButton"
                            style="padding: 5px; cursor: pointer;">In das Lager packen
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Falls Artikel sich bereits im Inventar des Nutzers befindet -->
    <div class="card" style="display:none;">
        <h2 class="card-header text-center" id="changeArticleInventoryHeader">
            Artikel ändern
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <form role="form" id="changeArticleInventoryForm" name="articleToInventoryForm" method="post"
                          enctype="multipart/form-data">
                        Anzahl
                        <input type="number" class="form-control" name="changeCountInput" id="changeCountInput"
                               placeholder="Anzahl eintragen..." value="">
                    </form>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-6">
                    <button type="button" class="btn btn-primary" name="changeInventoryButton"
                            id="changeInventoryButton"
                            style="padding: 5px; cursor: pointer;">Anzahl des Artikel ändern
                    </button>
                </div>
                <div class="p-6">
                    <button type="button" class="btn btn-primary" name="deleteInventoryButton"
                            id="deleteInventoryButton"
                            style="padding: 5px; cursor: pointer;">Artikel aus dem Inventar entfernen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    JsBarcode(".barcode").init();
</script>
</html>