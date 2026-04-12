if (document.getElementById('map')) {

    let map;
    let marker;

    // ambil lokasi user
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {

            let lat = position.coords.latitude;
            let lng = position.coords.longitude;

            // buat map di lokasi user
            map = createMap(lat, lng, 15);

            // pasang marker di lokasi user
            marker = L.marker([lat, lng]).addTo(map);

            // isi otomatis ke input
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;

            // klik map untuk ubah lokasi
            map.on('click', function (e) {

                let newLat = e.latlng.lat;
                let newLng = e.latlng.lng;

                document.getElementById("lat").value = newLat;
                document.getElementById("lng").value = newLng;

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker([newLat, newLng]).addTo(map);

            });

        }, function() {
            alert("Gagal mengambil lokasi, aktifkan GPS ya!");
        });
    } else {
        alert("Browser tidak mendukung GPS");
    }

}