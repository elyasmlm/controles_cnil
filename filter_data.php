<?php
include_once('connexion.php');  // Assurez-vous d'inclure votre script de connexion à la DB
include_once('function.php');

// Récupération des paramètres de filtrage
$annee = isset($_GET['annee']) ? $_GET['annee'] : '';
$type_de_controle = isset($_GET['type_de_controle']) ? $_GET['type_de_controle'] : '';
$modalite = isset($_GET['modalite']) ? $_GET['modalite'] : '';
$lieu_controle = isset($_GET['lieu_controle']) ? $_GET['lieu_controle'] : '';
$secteur_activite = isset($_GET['secteur_activite']) ? $_GET['secteur_activite'] : '';
// Construction de la requête avec les filtres
$query = "SELECT DISTINCT latitude, longitude FROM liste_controle WHERE latitude IS NOT NULL";

if ($annee !== '') $query .= " AND annee = '$annee'";
if ($type_de_controle !== '') $query .= " AND type_de_controle = '$type_de_controle'";
if ($modalite !== '') $query .= " AND modalite = '$modalite'";
if ($lieu_controle !== '') $query .= " AND lieu_controle = '$lieu_controle'";
if ($secteur_activite !== '') $query .= " AND secteur_activite = '$secteur_activite'";

$result = $dbh->query($query);
$coordinates = [];

while($row = $result->fetch_assoc()) {
    $pop_up_content = find_pop_up_content([$row['latitude'], $row['longitude']]);
    $type = get_type($row['latitude'], $row['longitude']);
    $coordinates[] = [$row['latitude'], $row['longitude'], $type, $pop_up_content];
}

header('Content-Type: application/json');
echo json_encode($coordinates);
?>
