document.addEventListener("DOMContentLoaded", function () {

    // ✅ Cek dulu ada elemen #map atau tidak
    if (document.getElementById('map')) {
        var map = createMap(-6.9175, 107.6191);
        foods.forEach(function (food) {
            if (food.latitude && food.longitude) {
                L.marker([food.latitude, food.longitude])
                    .addTo(map)
                    .bindPopup(food.food_name);
            }
        });
    }

    // Countdown tetap jalan walau map tidak ada
    function updateCountdown() {
        document.querySelectorAll(".countdown").forEach(function (el) {
            const expired = el.dataset.expired;
            if (!expired) { el.innerHTML = "⚠️ Waktu tidak diset"; return; }

            const expiredTime = new Date(expired.replace(" ", "T")).getTime();
            if (isNaN(expiredTime)) { el.innerHTML = "⚠️ Format salah"; return; }

            const distance = expiredTime - Date.now();
            if (distance <= 0) {
                el.innerHTML = "⏰ Sudah Expired";
                el.style.color = "#e74c3c";
                return;
            }

            const hours   = Math.floor(distance / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            el.innerHTML = `⏳ Berakhir dalam ${hours}j ${minutes}m ${seconds}d`;
            el.style.color = hours < 1 ? "#e74c3c" : "#e67e22";
        });
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

});