<?php
// Connexion à la base de données
include_once('connexion.php');
$temp_data = [];

// Récupération des données des contrôles par année
$query = "SELECT annee, COUNT(*) as count FROM liste_controle GROUP BY annee";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_year = [];
while ($row = $result->fetch_assoc()) {
    $data_by_year[$row['annee']] = (int)$row['count'];  // Conversion en entier
}
$stmt->close();

// Récupération des données des contrôles par type
$query = "SELECT type_de_controle, COUNT(*) as count FROM liste_controle GROUP BY type_de_controle";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_type = [];
while ($row = $result->fetch_assoc()) {
    $type_de_controle = $row['type_de_controle'];
    switch ($type_de_controle) {
        case 'loi 78':
            $type_de_controle = 'Loi 1978';
            break;
        case 'VIDEOPROTECTION':
            $type_de_controle = 'Vidéo';
            break;
        case 'contrôle en ligne':
            $type_de_controle = 'Contrôles en ligne';
            break;
    }
    
    if (isset($temp_data[$type_de_controle])) {
        $temp_data[$type_de_controle] += (int)$row['count'];
    } else {
        $temp_data[$type_de_controle] = (int)$row['count'];
    }
}
$stmt->close();

foreach ($temp_data as $type => $count) {
    $data_by_type[] = ['name' => $type, 'y' => $count];
}

// Récupération des données des contrôles par modalité
$query = "SELECT modalite, COUNT(*) as count FROM liste_controle WHERE modalite IS NOT NULL GROUP BY modalite";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_modalite = [];
while ($row = $result->fetch_assoc()) {
    $data_by_modalite[] = ['name' => $row['modalite'], 'y' => (int)$row['count']];  // Conversion en entier
}
$stmt->close();

// Récupération des données des contrôles par lieu
$query = "SELECT lieu_controle, COUNT(*) as count FROM liste_controle GROUP BY lieu_controle";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_lieu = [];
while ($row = $result->fetch_assoc()) {
    $data_by_lieu[] = ['name' => $row['lieu_controle'], 'y' => (int)$row['count']];  // Conversion en entier
}
$stmt->close();

// Récupération des données des contrôles par département
$query = "SELECT departement, COUNT(*) as count FROM liste_controle GROUP BY departement";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_departement = [];
while ($row = $result->fetch_assoc()) {
    $data_by_departement[] = ['name' => $row['departement'], 'y' => (int)$row['count']];  // Conversion en entier
}
$stmt->close();

// Récupération des données des contrôles par secteur
$query = "SELECT secteur_activite, COUNT(*) as count FROM liste_controle GROUP BY secteur_activite";
$stmt = $dbh->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data_by_secteur = [];
while ($row = $result->fetch_assoc()) {
    $data_by_secteur[] = ['name' => $row['secteur_activite'], 'y' => (int)$row['count']];  // Conversion en entier
}
$stmt->close();

// Convertir les données en JSON pour les utiliser dans JavaScript
$data_by_year_json = json_encode(array_values($data_by_year));
$data_by_year_categories_json = json_encode(array_keys($data_by_year));
$data_by_type_json = json_encode($data_by_type);
$data_by_modalite_json = json_encode($data_by_modalite);
$data_by_lieu_json = json_encode($data_by_lieu);
$data_by_departement_json = json_encode($data_by_departement);
$data_by_secteur_json = json_encode($data_by_secteur);
?>
