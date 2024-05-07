var map = L.map('map').setView([46.9685413,3.569439,6.48], 5);
L.tileLayer('https://api.mapbox.com/styles/v1/elyasos/clvgdheqy016p01qp805rfss9/tiles/256/{z}/{x}/{y}@2x?access_token=pk.eyJ1IjoiZWx5YXNvcyIsImEiOiJjbGl1ODF1OTQwYmR2M2RsZmt3a2dnazEwIn0.CLLv_JLdn7q2mYNixVSVBg', {
    maxZoom: 19,
    attribution: 'Map data &copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>'
}).addTo(map);

L.marker([48.8566, 2.3522]).addTo(map)
    .bindPopup('Un beau cœur sur Paris!');