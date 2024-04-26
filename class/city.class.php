<?php

class place {
    public $name;
    public $dep;
    public $country;
    public $coordinates;

    public function __construct($name, $dep, $country) {
      $this->name = $name;
      $this->dep = $dep;
      $this->country = $country;
      $this->coordinates = null;
    }
  
    // Cette fonction devrait être appelée par un autre processus qui peut gérer l'asynchronisme, comme un script côté serveur ou un appel AJAX.
    public function findCoordinates() {
      $query = urlencode($this->name . ', ' . $this->dep . ', ' . $this->country);
      $url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}";

      // Utilisation de file_get_contents pour simplifier l'exemple. Considérez utiliser cURL ou Guzzle pour une meilleure gestion des erreurs et des options HTTP.
      $response = file_get_contents($url);
      $data = json_decode($response, true);

      if ($data && count($data) > 0) {
        $this->coordinates = [
          'latitude' => (float) $data[0]['lat'],
          'longitude' => (float) $data[0]['lon']
        ];
        return $this->coordinates;
      } else {
        throw new Exception('Aucun résultat trouvé pour les coordonnées.');
      }
    }
}
?>
