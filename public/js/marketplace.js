var map = createMap(-6.9175, 107.6191);

foods.forEach(function (food) {

    if (food.latitude && food.longitude) {

        L.marker([food.latitude, food.longitude])
            .addTo(map)
            .bindPopup(food.food_name);

    }

});

function updateCountdown() {

    document.querySelectorAll(".countdown").forEach(function (el) {

        const expired = el.dataset.expired;

        if (!expired) return;

        const expiredTime = new Date(expired).getTime();

        const now = new Date().getTime();

        const distance = expiredTime - now;

        if (distance <= 0) {

            el.innerHTML = "Expired";

            return;

        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        el.innerHTML = "Expired in " + hours + "h " + minutes + "m " + seconds + "s";

    });

}

setInterval(updateCountdown, 1000);
updateCountdown();