<?php
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            var searchTerm = "<?php echo $_POST["searchInput"]; ?>";
            getSearchResult(searchTerm, 0, 30);
        });
    </script>
    <title>Home</title>
    <?php require_once("includes/loadNavbar.php"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Suchergebnisse
        </h2>
        <div class="card-text">
            <div id="articleList"></div>
        </div>
    </div>
</div>
</body>
</html>