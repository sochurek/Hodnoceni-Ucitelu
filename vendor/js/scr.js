
// Otevře nový http request
var request = new XMLHttpRequest();
request.open('GET', 'http://ip-api.com/json/', true);

// Když se načte request, získají se ze stránky http://ip-api.com/json všechny potřebná data o učivateli a zobrazí se na mapě + vypíší se na stránku
request.onload = function () {

    var data = JSON.parse(this.response);
    console.log(data);
    var v = document.getElementById("text").innerText = "Query: " + data["query"] + "\nStatus: " + data["status"] + "\nCountry: " + data["country"] + "\nCountry Code: " + data["countryCode"] + "\nRegion: " + data["region"] + "\nRegion Name: " + data["regionName"] + "\nCity: " + data["city"] + "\nZip Code: " + data["zip"] + "\nLat: " + data["lat"] + "\nLon: " + data["lon"];

    var center = SMap.Coords.fromWGS84(data["lon"], data["lat"]);
    var m = new SMap(JAK.gel("m"), center, 13);
    m.addDefaultLayer(SMap.DEF_BASE).enable();
    m.addDefaultControls();

    var layer = new SMap.Layer.Marker();
    m.addLayer(layer);
    layer.enable();

    var options = {};
    var marker = new SMap.Marker(center, "myMarker", options);
    layer.addMarker(marker);

}

// request se pošle
request.send();