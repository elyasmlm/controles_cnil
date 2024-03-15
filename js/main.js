// Fonction pour basculer entre les vues
function toggleView(view) {
    var mapSection = document.getElementById('mapSection');
    var statsSection = document.getElementById('statsSection');
    var statBtn = document.getElementById('statBtn');
    var mapBtn = document.getElementById('mapBtn');

    if (view === 'map') {
        mapSection.style.display = 'block';
        statsSection.style.display = 'none';
        mapBtn.classList.add('active');
        statBtn.classList.remove('active');
    } else {
        mapSection.style.display = 'none';
        statsSection.style.display = 'block';
        mapBtn.classList.remove('active');
        statBtn.classList.add('active');
    }
}

