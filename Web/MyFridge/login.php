<?php
require_once("config.php");
if(isset($_SESSION["user"])) {
    header('Location: http://localhost/index.php');
}
require_once("includes/loadAssets.html");
?>
<html>
<head>
    <script>
        $(document).ready(function () {
            $("#loginButton").click(function () {
                var formArray = $("#loginForm").serializeArray();
                var user = {
                    name: formArray[0].value,
                    pass: formArray[1].value
                };
                sendLoginData(user);
            });
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
            <form role="form" id="loginForm" name="loginForm" method="post" enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-center">
                    <div class="p-12">
                        Benutzername
                        <input type="text" class="form-control" name="nameInput" id="nameInput" placeholder="Benutzername eintragen...">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around">
                    <div class="p-12">
                        Passwort
                        <input type="password" class="form-control" name="passwordInput" id="passwordInput"
                               placeholder="Passwort eintragen...">
                    </div>
                </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-12">
                    <button type="button" class="btn btn-primary" id="loginButton" name="loginButton" style="cursor: pointer;">Anmelden</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>