<?php
require_once("config.php");
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            var producerName = "<?php echo $_GET["producerName"]; ?>";
            getAllArticlesByProducer(producerName);
        });
    </script>
    <title>Artikel von bestimmten Hersteller</title>
    <?php require_once("includes/loadNavbar.php"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Alle Artikel dieses Herstellers
        </h2>
        <div class="card-text">
            <div id="articleList"></div>
        </div>
    </div>
</div>
</body>
</html>