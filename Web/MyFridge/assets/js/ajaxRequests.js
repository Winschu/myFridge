function loadAllArticles() {
    $.post("includes/ajax/getAllArticles.php", {startPos : 0, rowCount : 5}).done(function (data) {
        sessionStorage.setItem("allArticles", JSON.stringify(data));
    });
}

function getAllArticles() {
    var obj = sessionStorage.getItem("allArticles");
    return JSON.parse(obj);
}

function getSpecificUser(userName) {
    $.post("includes/ajax/getSpecificUser.php", {userName : userName}).done(function (data) {
        //TODO: Irgendwas übergeben lassen
    });
}

function getAllArticlesByProducer(producerName)
{
    $.post("includes/ajax/getAllArticlesByProducer.php", {producerName : producerName}).done(function (data) {
       //TODO: Irgendwas übergeben lassen
    });
}

function createBlock(a) {
    var s = "";
    s += "<div>";
    s += a;
    s += "</div>";

    return s;
}

function fillAllArticlesList(a) {
    var s = "";
    for (var i = 0; i < a.length; i++) {
        s += "<div class='card text-center'>";
        s += createBlock(a[i].name);
        s += createBlock(a[i].groupName);
        s += "</div>";
    }

    return s;
}