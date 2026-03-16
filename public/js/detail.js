var map = createMap(food.latitude, food.longitude, 14);

L.marker([food.latitude, food.longitude])
    .addTo(map)
    .bindPopup(food.food_name)
    .openPopup();