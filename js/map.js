var map = L.map('map').setView([46.9685413,3.569439,6.48], 5);
L.tileLayer('https://api.mapbox.com/styles/v1/elyasos/clvgdheqy016p01qp805rfss9/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZWx5YXNvcyIsImEiOiJjbGl1ODF1OTQwYmR2M2RsZmt3a2dnazEwIn0.CLLv_JLdn7q2mYNixVSVBg', {
    maxZoom: 19,
    attribution: 'Map data &copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>'
}).addTo(map);

var markersLayer = new L.LayerGroup().addTo(map);

function getPin(type) {
    switch (type) {
        case 'Loi 1978' : 
            iconLink = 'data/pins_map/pin_loi78.png';
            break;
        case 'loi 78' : 
            iconLink = 'data/pins_map/pin_loi78.png';
            break;
        case 'Vidéo' : 
            iconLink = 'data/pins_map/pin_video.png';
            break;
        case 'VIDEOPROTECTION' : 
            iconLink = 'data/pins_map/pin_video.png';
            break;
        case 'Contrôles en ligne' : 
            iconLink = 'data/pins_map/pin_online.png';
            break;
        case 'contrôle en ligne' : 
            iconLink = 'data/pins_map/pin_online.png';
            break;
        case 'RGPD' : 
            iconLink = 'data/pins_map/pin_rgpd.png';
            break;
        case 'DIRECTIVE' : 
            iconLink = 'data/pins_map/pin_directive.png';
            break;
        case 'RGPD/ DIRECTIVE police justice' : 
            iconLink = 'data/pins_map/pin_justice.png';
            break;
        case 'plus' : 
            iconLink = 'data/pins_map/pin_multiple.png';
            break;
        default :
            iconLink = 'data/pins_map/pin_multiple.png'
    }

    var customIcon = L.icon({
        iconUrl: iconLink,
        iconSize: [35, 50], // Ajustez la taille selon vos besoins
        iconAnchor: [22, 94],
        popupAnchor: [-3, -76]
    });

    return customIcon;
}

function addOnePinOnMap(lat, lon, type, popUpContent) {
    var pin = getPin(type);
    var marker = L.marker([lat, lon], {icon:pin}).bindPopup(popUpContent);
    markersLayer.addLayer(marker);
}