var map = createMap(-6.9175, 107.6191);

var marker;

map.on('click', function (e) {

    var lat = e.latlng.lat;
    var lng = e.latlng.lng;

    document.getElementById("lat").value = lat;
    document.getElementById("lng").value = lng;

    if (marker) {
        map.removeLayer(marker);
    }

    marker = L.marker([lat, lng]).addTo(map);

});