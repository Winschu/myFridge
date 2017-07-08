<?php
require_once("includes/loadAssets.html");
require_once("includes/dbCredentials.php");
require_once("includes/articleObject.php");
?>
<html>
<head>

    <title>Artikel</title>
    <?php require_once("includes/loadNavbar.html"); ?>
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
                    Höchster Preis: <?php echo $article->getArticleHighestPrice() . " (vom " . $article->getArticleLastUpdate() . ")"; ?>
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