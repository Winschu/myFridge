function sendLoginData(obj) {
    $.post("/ajax.php?action=login", {user: obj.name, pass: obj.pass}).done(function (data) {
        console.log("Login Daten gesendet " + data.success);

        if (data.success) {
            alert("Du wurdest erfolgreich eingeloggt!");
            window.location.href = "http://localhost/index.php";
        }
        else {
            alert("Du konntest nicht angemeldet werden!");
        }
    });
}

function sendRegisterData(obj) {
    $.post("/ajax.php?action=register", {user: obj.name, email: obj.email, pass: obj.pass}).done(function (data) {
        console.log("Registrierungsdaten gesendet " + data.success);
        if (data.success) {
            alert("Dein Konto wurde erfolgreich angelegt");
        }
        else {
            alert("Bei deiner Registrierung ist ein Fehler passiert");
        }
    });
}

function getSessionState() {
    $.post("/ajax.php?action=sessionState").done(function (data) {
        if (data.success) {
            $("#loginPage").hide();
            $("#registerPage").hide();
            return true;
        }
        else {
            $("#userSettingsPage").hide();
            return false;
        }
    });
}

function addArticleToInventory(obj) {
    $.post("/ajax.php?action=InsertArticleInventory", {
        user: obj.user,
        date: obj.date,
        price: obj.price,
        count: obj.count,
        barcode: obj.barcode
    }).done(function (data) {
        if (data) {
            alert("Artikel wurde eingetragen");
        }
        else {
            alert("Artikel konnte nicht eingetragen werden");
        }
    });
}

function changeArticleInventory(obj) {
    $.post("/ajax.php?action=changeArticleInventory", {
        user: obj.user,
        count: obj.count,
        barcode: obj.barcode
    }).done(function (data) {
        if (data) {
            alert("Anzahl wurde geändert");
        }
        else {
            alert("Artikel konnte nicht geändert werde");
        }
    });
}

function deleteArticleInventory(obj) {
    $.post("/ajax.php?action=deleteArticleInventory", {
        user: obj.user,
        barcode: obj.barcode
    }).done(function (data) {
        if (data) {
            alert("Artikel wurde entfernt");
        }
        else {
            alert("Artikel konnte nicht entfernt werden");
        }
    });
}

/*
 * Gibt Benutzer mit gegebenem Benutzernamen zurück
 */
function getSpecificUser() {
    $.post("/ajax.php?action=getSpecificUser").done(function (data) {
        if(data.success) {
            data = data.data[0];
            var userData = {
                user: data.user,
                email: data.email,
                size: parseFloat(data.size),
                weight: parseFloat(data.weight),
                age: data.age
            };
            $("#sizeInput").val(userData.size);
            $("#weightInput").val(userData.weight);
            $("#ageInput").val(userData.age);
            $("#emailAdressInput").val(userData.email);
        }
    });
}

function changeUserData(obj) {
    $.post("/ajax.php?action=changeUserData", {user: obj.user, size: obj.size, weigth: obj.weigth, age: obj.age}).done(function (data) {
        if(data) {
            alert("Daten wurden erfolgreich geändert!");
        }
        else
        {
            alert("Daten konnten nicht geändert werden");
        }
    });
}

function changeEmail(obj) {
    $.post("/ajax.php?action=changeUserEmail", {user: obj.user, email: obj.email}).done(function (data) {
        if(data) {
            alert("E-Mail Adresse wurde erfolgreich geändert!");
        }
        else
        {
            alert("E-Mail Adresse konnte nicht geändert werden!");
        }
    });
}
