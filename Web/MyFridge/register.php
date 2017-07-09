<?php
require_once("config.php");
if (isset($_SESSION["user"])) {
    header('Location: http://localhost/index.php');
}
require_once("includes/loadAssets.html");
require_once("includes/articleObject.php");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            $("#registerButton").click(function () {
                var formArray = $("#registerForm").serializeArray();
                if(formArray[2].value === formArray[3].value) {
                    var user = {
                        name: formArray[0].value,
                        email : formArray[1].value,
                        pass: formArray[2].value
                    };
                    sendRegisterData(user);
                }
                else
                {
                    alert("Passwörter stimmen nicht überein!");
                }
            });
        });
    </script>
    <title>Registrierung</title>
    <?php require_once("includes/loadNavbar.html"); ?>
</head>
<body>
<div class="container-fluid">
    <div class="card">
        <h2 class="card-header">
            Registrierung
        </h2>
        <div class="card-text">
            <form role="form" id="registerForm" name="registerForm" method="post" enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        Benutzername
                        <input type="text" class="form-control" name="nameInput" id="nameInput" placeholder="Benutzername eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        E-Mail Adresse
                        <input type="email" class="form-control" name="emailInput" id="emailInput"
                               placeholder="E-Mail Adresse eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-6">
                        Passwort
                        <input type="password" class="form-control" name="passwordInput" id="passwordInput"
                               placeholder="Passwort eintragen...">
                    </div>
                    <div class="p-6">
                        Passwort wiederholen
                        <input type="password" class="form-control" name="passwordAgainInput" id="passwordAgainInput"
                               placeholder="Passwort erneut eintragen...">
                    </div>
                </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <button type="button" class="btn btn-primary" name="registerButton" id="registerButton" style="cursor: pointer;">Registrieren</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>