<?php

function all_coordinates() {
    global $dbh;
    $query = "SELECT DISTINCT latitude, longitude FROM liste_controle WHERE latitude IS NOT NULL";
    $result = $dbh->query($query);

    $coordinates = [];

    while($row = $result->fetch_assoc()) {
        $coordinates[] = [$row['latitude'], $row['longitude']];
    }

    return $coordinates;
}

function display_pins($pins) {
    echo "<script>";
    foreach ($pins as $pin) {
        $pop_up_content = json_encode(find_pop_up_content($pin));
        echo "addOnePinOnMap({$pin[0]}, {$pin[1]}, map, $pop_up_content);";
    }
    echo "</script>";
}

function find_pop_up_content($pin) {
    global $dbh;
    $content = "";
    $query = "SELECT 
                id, 
                annee, 
                type_de_controle, 
                modalite,
                nom, 
                lieu_controle,
                departement,
                pays,
                secteur_activite
            FROM 
                liste_controle
            WHERE 
                latitude BETWEEN $pin[0] - 0.0001 AND $pin[0] + 0.0001
                AND longitude BETWEEN $pin[1] - 0.0001 AND $pin[1] + 0.0001";

    $result = $dbh->query($query);
    $nb_lines = $result->num_rows;

    $nb_lines = $result->num_rows;

    if ($nb_lines <= 3) {
        while ($row = $result->fetch_assoc()) {
            $info1 = joinWithComma([checkValue($row['secteur_activite']), checkValue($row['lieu_controle']), checkValue($row['departement']), checkValue($row['pays'])]);
            $info2 = joinWithComma([checkValue($row['annee']), checkValue($row['type_de_controle']), checkValue($row['modalite'])]);
            
            $content .= "<div style='margin-bottom: 10px;'>
                            <h4>".checkValue($row['nom'])."</h4>
                            <p>{$info1}</p>
                            <p>{$info2}</p>
                        </div>";
        }
    } else {

        $tableContent = "<table id='resultsTable' class='table table-striped table-hover' style='width:100%'><thead><tr><th style='width:10%'>Année</th><th style='width:10%'>Type de Contrôle</th><th style='width:10%'>Modalité</th><th style='width:50%'>Nom</th><th style='width:30%'>Secteur d'Activité</th></tr></thead><tbody>";
        while ($row = $result->fetch_assoc()) {
            $tableContent .= "<tr><td>{$row['annee']}</td><td>{$row['type_de_controle']}</td><td>{$row['modalite']}</td><td>{$row['nom']}</td><td>{$row['secteur_activite']}</td></tr>";
        }
        $tableContent .= '</tbody></table>';
        $escapedTableContent = htmlspecialchars($tableContent, ENT_QUOTES, 'UTF-8');

        $content = "<div style='text-align: center'><p>Trop de résultats pour afficher en détail.</p>
                    <a class='link' onclick='openSwal(`{$escapedTableContent}`)'>Voir plus</a></div>";


    }

        return $content;
}

function checkValue($value) {
    return $value === NULL ? "" : $value;
}

function joinWithComma($array) {
    return implode(', ', array_filter($array, function($value) { return $value !== ""; }));
}