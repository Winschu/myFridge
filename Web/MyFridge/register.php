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
                <input type="text" class="form-control" id="nameInput" placeholder="Benutzername eintragen...">
            </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    E-Mail Adresse
                    <input type="email" class="form-control" id="emailInput" placeholder="E-Mail Adresse eintragen...">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-6">
                    Passwort
                    <input type="password" class="form-control" id="passwordInput" placeholder="Passwort eintragen...">
                </div>
                <div class="p-6">
                    Passwort wiederholen
                    <input type="password" class="form-control" id="passwordAgainInput" placeholder="Passwort erneut eintragen...">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>