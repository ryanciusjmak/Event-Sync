document.addEventListener("DOMContentLoaded", function() {
    // Cria o mapa
    var map = L.map('map').setView([0, 0], 2);

    // Adiciona a camada do mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Obtém os dados dos eventos
    var eventsData = document.getElementById('events-data').textContent;
    var events = JSON.parse(eventsData);

    function updateMap() {
        // Limpa marcadores existentes
        map.eachLayer(function(layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });

        // Adiciona novos marcadores
        events.forEach(function(event) {
            if (event.latitude && event.longitude) {
                L.marker([event.latitude, event.longitude])
                    .addTo(map)
                    .bindPopup(`<b>${event.title}</b><br>${event.city}`);
            }
        });
    }

    updateMap();
});
