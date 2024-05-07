<?php

function create_data_to_display() {
    global $dbh;
    $query = "SELECT * FROM liste_controle";
    $result = $dbh->query($query);

    $grouped_data = [];

    while($row = $result->fetch_assoc()) {
        $key = $row['latitude'] . '-' . $row['longitude'];

        if (!isset($grouped_data[$key])) {
            $grouped_data[$key] = [
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude'],
                'controls' => []
            ];
        }

        $grouped_data[$key]['controls'][] = $row;
    }

    return $grouped_data;

}

function display_pins($data) {
    
}