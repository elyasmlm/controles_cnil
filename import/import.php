<?php
require_once '../class/place.class.php';  // Inclure la classe Place

$place = new Place('Paris', 75, 'France');
    try {
        $coordinates = $place->findCoordinates();
        echo $coordinates['latitude'];
        echo $coordinates['longitude'];
    } catch (Exception $e) {
        echo "Erreur pour ID {$id}: " . $e->getMessage() . "\n";
    }