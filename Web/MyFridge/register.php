<?php
require_once("includes/loadAssets.html");
require_once("includes/articleObject.php");
//TODO: Abfrage ob Nutzer schon angxemeldet ist
?>
<html>
<head>
    <script>
        $(document).ready(function () {

        });
    </script>
    <title>Home</title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Registrierung
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-center">
            <div class="p-12">
                Benutzername
            </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    E-Mail Adresse
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-6">
                    Passwort
                </div>
                <div class="p-6">
                    Passwort wiederholen
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>