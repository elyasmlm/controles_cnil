<?php
    include_once('head.php');
    include_once('connexion.php');
    include_once('class/place.class.php');
    include_once('function.php');

?>

<!-- Contenu principal -->
<main>
    <div class='main'>
        <!-- Section Carte -->
        <section id="mapSection">
        <div class="filters">

            <?php
                echo display_filter('annee');
                echo display_filter('type_de_controle');
                echo display_filter('modalite');
                echo display_filter('lieu_controle');
                echo display_filter('secteur_activite');
            ?>
            <button id="resetFilters" onclick="resetFilters()">Réinitialiser les Filtres</button>
            <!-- Ajouter plus de filtres selon vos besoins -->
        </div>
            <!-- Carte (Juste un espace pour la carte pour l'instant) -->
            <div id="map"></div>
        </section>
        
        <!-- Section Statistique -->
        <section id="statsSection" style="display:none;">
            <!-- Carte pour choisir les statistiques -->
            <!-- ... -->
            Les stats seront la
            <!-- Carte pour afficher les statistiques -->
            <!-- ... -->
        </section>
    </div>
</main>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="js/main.js"></script>
<script src="js/map.js"></script>
<?php
    $pins = all_coordinates();
    display_pins($pins)
?>
</body>
</html>
