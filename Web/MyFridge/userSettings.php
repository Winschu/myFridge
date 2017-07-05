<?php require_once("includes/loadAssets.html"); ?>
<html>
<head>
    <script>
        getSpecificUser("bFichtelmann");
    </script>
    <title>Einstellungen</title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card text-center">
        <h2 class="card-header">
            Einstellungen
        </h2>
        <div class="card-text">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <span id="userNameText">USERNAME</span>
                </div>
            </div>
            <form>
                <div class="d-flex flex-wrap justify-content-center form-group">
                    <div class="p-12">
                        <span>Persönliche Maße ändern</span>
                        <div class="p-6">
                            <span id="userSizeText">SIZE</span>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Größe eintragen...">
                        </div>
                        <div class="p-6">
                            <span id="userWeightText">WEIGHT</span>
                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Gewicht eintragen">
                        </div>
                    </div>
                </div>
            </form>
            <form>
                <div class="d-flex flex-wrap justify-content-center form-group">
                    <div class="p-12">
                        <span>E-Mail Adresse ändern</span>
                        <div class="p-6">
                            <span id="emailAddressText">EMAIL</span>
                            <input type="email" class="form-control" id="emailAddressInput" placeholder="E-Mail Adresse eintragen...">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>