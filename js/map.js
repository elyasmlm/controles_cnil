var map = L.map('map').setView([46.9685413,3.569439,6.48], 5);
L.tileLayer('https://api.mapbox.com/styles/v1/elyasos/clvgdheqy016p01qp805rfss9/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZWx5YXNvcyIsImEiOiJjbGl1ODF1OTQwYmR2M2RsZmt3a2dnazEwIn0.CLLv_JLdn7q2mYNixVSVBg', {
    maxZoom: 19,
    attribution: 'Map data &copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>'
}).addTo(map);

var customMarker = L.divIcon({
    className: 'my-custom-marker',  // Référence à la classe CSS définie plus haut
    html: '<i class="fa fa-heart"></i>',  // Utilise une icône Font Awesome
    iconSize: [30, 42],  // Taille du divIcon, ajuste selon tes besoins
    iconAnchor: [15, 42]  // Ajuste le point d'ancrage au centre bas du marqueur
});

L.marker([48.8566, 2.3522], {icon: customMarker}).addTo(map)
    .bindPopup('Un beau cœur sur Paris!');