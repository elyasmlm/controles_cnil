<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/f9983d149e.js" crossorigin="anonymous"></script>
<title>CNIL Controls Visualisator</title>
<link rel="stylesheet" href="style/style.css">
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

    
    <!-- Section Carte -->
    <section id="mapSection">
        <!-- Filtres pour la carte -->
        <!-- ... -->
    caca
        <!-- Carte (Juste un espace pour la carte pour l'instant) -->
        <!-- ... -->
    </section>
    
    <!-- Section Statistique -->
    <section id="statsSection" style="display:none;">
        <!-- Carte pour choisir les statistiques -->
        <!-- ... -->
        pipi
        <!-- Carte pour afficher les statistiques -->
        <!-- ... -->
    </section>
</main>

<script src="js/main.js"></script>

</body>
</html>
