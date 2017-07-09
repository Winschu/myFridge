<?php
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            getAllArticlesByUser();
        });
    </script>
    <title>Inventar von <?php echo $_SESSION["user"]; ?></title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Alle Artikel in deinem Inventar
        </h2>
        <div class="card-text">
            <div id="articleList"></div>
        </div>
    </div>
</div>
</body>
</html>