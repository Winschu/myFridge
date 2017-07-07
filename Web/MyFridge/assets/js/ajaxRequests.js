
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