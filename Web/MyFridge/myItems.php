<?php
require_once("config.php");
if (!isset($_SESSION["user"])) {
    header('Location: http://localhost/index.php');
}
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            var user = "<?php echo $_SESSION["user"]; ?>";
            getAllArticlesByUser(user);
        });
    </script>
    <title>Inventar von <?php echo $_SESSION["user"]; ?></title>
    <?php require_once("includes/loadNavbar.php"); ?>
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