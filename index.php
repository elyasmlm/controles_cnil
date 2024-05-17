<?php
    include_once('head.php');
    include_once('connexion.php');
    include_once('class/place.class.php');
    include_once('function.php');
    include_once('chart_load.php');

?>

<!-- Contenu principal -->
<main>
    <div class="total-controles-container">
        <p>Nombre total de contrôles : <?php get_total_number_controls();?></p>
    </div>
    <div class='main-container'>
        <!-- Section Carte -->
        <section id="mapSection">
            <div id="map"></div>
            <div class="filters">
                <?php
                    echo display_filter('annee');
                    echo display_filter('type_de_controle');
                    echo display_filter('modalite');
                    echo display_filter('lieu_controle');
                    echo display_filter('secteur_activite');
                ?>
                <button id="resetFilters" onclick="resetFilters()">Réinitialiser les Filtres</button>
            </div>
        </section>
        
        <section id="chartsSection">
            <div id="controlsByYear" style="width: 100%; height: 50%"></div>
            <div id="controlsByType" style="width: 100%; height: 50%"></div>
            
        </section>        
    </div>
    <div class="second-container">
        <div id="controlsByModalite" style="width: 25%; height: 40vh;"></div>
        <div id="controlsByLieu" style="width: 25%; height: 40vh;"></div>
        <div id="controlsByDepartement" style="width: 25%; height: 40vh;"></div>
        <div id="controlsBySecteur" style="width: 25%; height: 40vh;"></div>
    </div>
</main>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="js/main.js"></script>
<script src="js/map.js"></script>
<?php
    $pins = all_coordinates();
    display_pins($pins);
?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const dataByYear = <?php echo $data_by_year_json; ?>;
    const categoriesByYear = <?php echo $data_by_year_categories_json; ?>;
    const dataByType = <?php echo $data_by_type_json; ?>;
    const dataByModalite = <?php echo $data_by_modalite_json; ?>;
    const dataByLieu = <?php echo $data_by_lieu_json; ?>;
    const dataByDepartement = <?php echo $data_by_departement_json; ?>;
    const dataBySecteur = <?php echo $data_by_secteur_json; ?>;

    try {
        Highcharts.chart('controlsByYear', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Nombre de contrôles par année'
            },
            xAxis: {
                categories: categoriesByYear
            },
            yAxis: {
                title: {
                    text: 'Nombre de contrôles'
                }
            },
            series: [{
                name: 'Contrôles',
                data: dataByYear
            }]
        });
    } catch (e) {
        console.error('Error creating controlsByYear chart:', e);
    }

    try {
        Highcharts.chart('controlsByType', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribution des types de contrôles'
            },
            series: [{
                name: 'Nombre de contrôles',
                colorByPoint: true,
                data: dataByType
            }]
        });
    } catch (e) {
        console.error('Error creating controlsByType chart:', e);
    }

    try {
        Highcharts.chart('controlsByModalite', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Distribution des contrôles par modalité'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Nombre de contrôles',
                colorByPoint: true,
                data: <?php echo $data_by_modalite_json; ?>
            }]
        });
    } catch (e) {
        console.error('Error creating controlsByModalite chart:', e);
    }

    try {
        Highcharts.chart('controlsByLieu', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribution des contrôles par lieu'
            },
            series: [{
                name: 'Nombre de contrôles',
                colorByPoint: true,
                data: dataByLieu
            }]
        });
    } catch (e) {
        console.error('Error creating controlsByLieu chart:', e);
    }

    try {
        Highcharts.chart('controlsByDepartement', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribution des contrôles par département'
            },
            series: [{
                name: 'Nombre de contrôles',
                colorByPoint: true,
                data: dataByDepartement
            }]
        });
    } catch (e) {
        console.error('Error creating controlsByDepartement chart:', e);
    }

    try {
        Highcharts.chart('controlsBySecteur', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Distribution des contrôles par secteur d\'activité'
            },
            series: [{
                name: 'Nombre de contrôles',
                colorByPoint: true,
                data: dataBySecteur
            }]
        });
    } catch (e) {
        console.error('Error creating controlsBySecteur chart:', e);
    }
});

</script>
</body>
</html>
