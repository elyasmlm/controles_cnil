<?php
include '../connexion.php';  // Connexion à la base de données

// Fonction pour convertir des textes en UTF-8
function convertToUTF8($text) {
    $encoding = mb_detect_encoding($text, mb_detect_order(), true);
    if ($encoding === false) {
        $encoding = 'ISO-8859-1'; // Assumer un encodage par défaut si non détecté
    }
    return mb_convert_encoding($text, 'UTF-8', $encoding); // Convertit le texte en UTF-8
}

// Fonction pour importer des données depuis un fichier CSV à la base de données
function importCsvToDataBase($filename, $headers) {
    global $dbh; // Utilise l'instance PDO déclarée globalement
    $nomTable = "liste_controle"; // Nom de la table dans laquelle on insère les données
    $yearExtracted = preg_replace('/[^0-9]/', '', basename($filename));  // Extrait l'année du nom du fichier

    if (($handle = fopen($filename, "r")) !== FALSE) { // Ouvre le fichier en mode lecture
        $firstLine = true; // Indicateur pour ignorer l'en-tête du fichier CSV

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Lit les données ligne par ligne
            $data = array_map('convertToUTF8', $data); // Convertit toutes les entrées en UTF-8
            if ($firstLine) { // Vérifie si c'est la première ligne (l'en-tête)
                $firstLine = false;
                continue;
            }

            if (!in_array($yearExtracted, ['2014', '2015', '2016'])) {
                array_unshift($data, $yearExtracted); // Ajoute l'année au début de chaque ligne de données
                if (!in_array('annee', $headers)) { 
                    array_unshift($headers, 'annee'); // Ajoute 'annee' au début des en-têtes si manquant
                }
            }

            if (count($data) !== count($headers)) {
                echo "Erreur : Nombre de colonnes incorrect dans $filename : attendu " . count($headers) . ", trouvé " . count($data) . "\n";
                continue;
            }

            $sql = "INSERT INTO $nomTable (" . implode(", ", $headers) . ") VALUES (:" . implode(", :", $headers) . ")";
            $stmt = $dbh->prepare($sql);

            $bindArray = array_combine($headers, $data); // Combine les en-têtes et les données pour le binding
            foreach ($bindArray as $key => $value) { 
                $stmt->bindValue(":$key", $value); // Lie chaque valeur avec son placeholder correspondant
            }

            try {
                if (!$stmt->execute()) {
                    echo "Erreur SQL: " . implode(", ", $stmt->errorInfo()) . " dans le fichier $filename\n";
                }
            } catch (Exception $e) {
                echo "Exception: " . $e->getMessage() . " dans le fichier $filename\n";
            }
        }

        fclose($handle);
    }

    echo "Importation réussi pour le fichier $filename.\n"; // Message de succès
}

$entetes_files = [
    '2014.csv' => ['annee', 'type_de_controle', 'nom', 'lieu_controle', 'departement', 'secteur_activite'],
    '2015.csv' => ['annee', 'type_de_controle', 'nom', 'lieu_controle', 'departement', 'secteur_activite'],
    '2016.csv' => ['annee', 'type_de_controle', 'nom', 'lieu_controle', 'departement', 'secteur_activite'],
    '2017.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'secteur_activite'],
    '2018.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'secteur_activite'],
    '2019.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'secteur_activite'],
    '2020.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'secteur_activite'],
    '2021.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'pays', 'secteur_activite'],
    '2022.csv' => ['type_de_controle', 'modalite', 'nom', 'departement', 'lieu_controle', 'pays', 'secteur_activite'],
];

foreach ($entetes_files as $file => $headers) { // Boucle sur chaque fichier pour l'importation
    importCsvToDataBase("../data/$file", $headers);
}
?>
