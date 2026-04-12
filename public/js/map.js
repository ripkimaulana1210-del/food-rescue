function createMap(lat, lng, zoom = 12) {

    var map = L.map('map').setView([lat, lng], zoom);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    return map;
}

// ambil parameter URL
const urlParams = new URLSearchParams(window.location.search);
const currentPath = window.location.pathname;

// 🔥 hanya jalan di halaman /foods
if (currentPath === '/foods') {

    if (!urlParams.has('lat') && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;

                window.location.href = `/foods?lat=${lat}&lng=${lng}`;
            },
            function () {
                alert("Aktifkan GPS untuk melihat makanan terdekat");
            }
        );
    }

}