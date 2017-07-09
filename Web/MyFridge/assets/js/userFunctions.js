function sendLoginData(obj) {
    $.post("/ajax.php?action=login", {user : obj.name, pass : obj.pass}).done(function (data) {
        console.log("Login Daten gesendet " + data.success);

        if(data.success) {
            alert("Du wurdest erfolgreich eingeloggt!");
            window.location.href = "http://localhost/index.php";
        }
        else
        {
            alert("Du konntest nicht angemeldet werden!");
        }
    });
}

function sendRegisterData(obj) {
    $.post("/ajax.php?action=register", {user : obj.name, email : obj.email, pass : obj.pass}).done(function (data) {
        console.log("Registrierungsdaten gesendet " + data.success);
        if(data.success) {
            alert("Dein Konto wurde erfolgreich angelegt");
        }
        else
        {
            alert("Bei deiner Registrierung ist ein Fehler passiert");
        }
    });
}

function getSessionState() {
    $.post("ajax.php?action=sessionState").done(function (data) {
        if(data.success) {
            $("#loginPage").hide();
            $("#registerPage").hide();
            return true;
        }
        else
        {
            return false;
        }
    });
}

function addArticleToInventory() {

}
