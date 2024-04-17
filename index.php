<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/f9983d149e.js" crossorigin="anonymous"></script>
<title>CNIL Controls Visualisator</title>
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
</head>
<body>

<!-- Barre de navigation -->
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo"> <img src="data/logo_cnil.png" alt="logo"> <span class="site-name"> CNIL Controls Visualisator</span></a>
        <ul id="nav-mobile" class="right">
            <li><button id="infoBtn"><i class="fa-solid fa-circle-info"></i> En savoir plus</button></li>
        </ul>
    </div>
</nav>

<!-- Contenu principal -->
<main>
<div class="switch-wrapper">
    <div class="switch-button">
        <button id="statBtn" onclick="toggleView('stats')" class="active">Statistique</button>
        <button id="mapBtn" onclick="toggleView('map')">Carte</button>
    </div>
</div>

    <div class='main'>
        <!-- Section Carte -->
        <section id="mapSection">
        <div class="filters">

            <div class="filter">
                <label for="filter1">Filtre 1:</label>
                <select id="filter1">
                    <option value="1">huitre</option>
                </select>
            </div>
            <!-- Ajouter plus de filtres selon vos besoins -->
        </div>
            <!-- Carte (Juste un espace pour la carte pour l'instant) -->
            <div id="map"></div>
        </section>
        
        <!-- Section Statistique -->
        <section id="statsSection" style="display:none;">
            <!-- Carte pour choisir les statistiques -->
            <!-- ... -->
            pipi
            <!-- Carte pour afficher les statistiques -->
            <!-- ... -->
        </section>
    </div>
</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="js/main.js"></script>
<script src="js/map.js"></script>

</body>
</html>
