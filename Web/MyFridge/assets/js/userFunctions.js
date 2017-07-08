function sendLoginData(obj) {
    $.post("/ajax.php?action=login", {user : obj.name, pass : obj.name}).done(function (data) {
        //TODO: Irgendwas mit Meldung
        console.log("Login Daten gesendet " + data);
    });
}

function sendRegisterData(obj) {
    $.post("/ajax.php?action=register", {user : obj.name, email : obj.email, pass : obj.pass}).done(function (data) {
        console.log("Registrierungsdaten gesendet " + data);
    });
}
