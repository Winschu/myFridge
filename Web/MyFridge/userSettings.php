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
            getSpecificUser(user);

            $("#changeUserDataButton").click(function () {
                var formArray = $("#changeUserDataForm").serializeArray();
                var userData = {
                    user : user,
                    size: formArray[0].value,
                    weigth: formArray[1].value,
                    age: formArray[2].value
                };
                changeUserData(userData);
            });

            $("#changeEmailButton").click(function () {
                var formArray = $("#changeEmailForm").serializeArray();
                var emailObj = {
                    user : user,
                    email : formArray[0].value
                };
                changeEmail(emailObj);
            });
        });

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
                    <span id="userNameText"><?php echo $_SESSION["user"]; ?></span>
                </div>
            </div>
            <form role="form" id="changeUserDataForm" name="changeUserDataForm" method="post"
                  enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-center form-group">
                    <div class="p-12">
                        <span>Persönliche Maße ändern</span>
                        <div class="p-6">
                            <span id="userSizeText">SIZE</span>
                            <input type="number" class="form-control" name="sizeInput" id="sizeInput"
                                   placeholder="Größe eintragen..." value="">
                        </div>
                        <div class="p-6">
                            <span id="userWeightText">WEIGHT</span>
                            <input type="number" class="form-control" name="weightInput" id="weightInput"
                                   placeholder="Gewicht eintragen" value="">
                        </div>
                        <div class="p-6">
                            <span id="userAgeText">AGE</span>
                            <input type="number" class="form-control" name="ageInput" id="ageInput"
                                   placeholder="Alter eintragen..." value="">
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center">
                <button type="button" name="changeUserDataButton" id="changeUserDataButton" class="btn btn-primary">
                    Daten ändern
                </button>
            </div>
            <form role="form" id="changeEmailForm" name="changeEmailForm" method="post" enctype="multipart/form-data">
                <div class="d-flex flex-wrap justify-content-center form-group">
                    <div class="p-12">
                        <span>E-Mail Adresse ändern</span>
                        <div class="p-6">
                            <span id="emailAddressText">EMAIL</span>
                            <input type="email" class="form-control" name="emailAdressInput" id="emailAddressInput"
                                   placeholder="E-Mail Adresse eintragen..." value="">
                        </div>
                    </div>
                </div>
            </form>
            <div class="d-flex flex-wrap justify-content-center">
                <button type="button" name="chageEmailButton" id="changeEmailButton" class="btn btn-primary">
                    E-Mail Adresse ändern
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>