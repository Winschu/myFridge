<?php require_once("includes/dbConfig.php"); ?>
<?php require_once("includes/loadAssets.html"); ?>
<html>
<head>
    <script>
        $(document).ready(function () {
            loadAllArticles();
            var a = getAllArticles();
            fillAllArticlesList(a);
        });
    </script>
    <title>Home</title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Willkommen!
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-around" id="allArticlesTextBox">

            </div>
        </div>
    </div>
</div>
</body>
</html>