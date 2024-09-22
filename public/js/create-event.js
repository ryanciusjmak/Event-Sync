function getCoordinates() {
    console.log('getCoordinates function is called');
    var city = document.getElementById('city').value;
    var url = `https://nominatim.openstreetmap.org/search?format=json&q=${city}&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                var latitude = data[0].lat;
                var longitude = data[0].lon;
                if (latitude && longitude) {
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    console.log('Latitude:', latitude, 'Longitude:', longitude);
                } else {
                    console.error('Coordenadas inválidas para a cidade:', city);
                }
            } else {
                console.error('Nenhuma coordenada encontrada para a cidade:', city);
            }
        })
        .catch(error => console.error('Erro ao obter coordenadas:', error));
}
