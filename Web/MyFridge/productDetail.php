<?php
require_once("includes/loadAssets.html");
require_once("includes/dbCredentials.php");
require_once("includes/articleObject.php");
?>
<html>
<head>
    <script>

    </script>
    <title>Home</title>
    <?php require_once("includes/loadNavbar.html"); ?>
    <?php
    $article = null;
    $articleName = $_GET["articleName"];
    $dbCon = new dbCredentials();
    $pgCon = pg_connect($dbCon->getDBString());
    $result = pg_query($pgCon, "
SELECT name, group_name, barcode, highest_price, producer_name, size, size_type, last_update
FROM article
WHERE name = '$articleName'
");
    while ($data = pg_fetch_object($result)) {
        $article = new articleObject($data);
    }
    ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header" id="articleNameText">
            <?php echo $article->getArticleName(); ?>
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-6">
                    Artikelgruppe: <?php echo $article->getArticleGroupName(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>