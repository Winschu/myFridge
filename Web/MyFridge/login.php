<?php
require_once("includes/loadAssets.html");
//TODO: Abfrage ob Nutzer schon registriert oder bereits angemeldet ist
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
            Anmelden
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    Benutzername
                    <input type="text" class="form-control" id="nameInput" placeholder="Benutzername eintragen...">
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-around">
                <div class="p-12">
                    Passwort
                    <input type="password" class="form-control" id="passwordInput" placeholder="Passwort eintragen...">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>