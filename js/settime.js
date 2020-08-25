var einddatum = prompt("Wat is de einddatum JJJJ-MM-DD?");
var deadline = new Date(einddatum);
var nu = Date.now();
var eendag = 86400000;
var resterende = (nu - deadline) / eendag;
document.write("<br>Er zijn nog:" + resterende.toFixed(0) + " dagen te gaan");

function alertTime {
    var d = new Date();
    alert(d.toString());
}