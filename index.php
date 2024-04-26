<?php
    include_once('head.php');
    include_once('connexion.bkp.php');
    include_once('class/contoleCNIL.class.php');

?>

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
