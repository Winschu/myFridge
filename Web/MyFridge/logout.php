<?php
require_once("config.php");
require_once("includes/loadAssets.html");
session_destroy();
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            getSessionState();
        });
    </script>
    <title>Home</title>
    <?php require_once("includes/loadNavbar.php"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Auf Wiedersehen!
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-around" id="allArticlesTextBox">Sie wurden erfolgreich ausgeloggt.</div>
        </div>
    </div>
</div>
</body>
</html>