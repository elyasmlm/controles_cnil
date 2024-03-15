<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'connexion.php';

    function importCsvToDataBase($filename) {
        global $dbh; // Utilisez l'instance de PDO créée dans 'connexion.php'

        if ($filename == "data/OpenCNIL_Liste_controles_2014_VD_20150604.csv" || $filename == "data/OpenCNIL_liste_controles_2015.csv" || $filename == "data/OpenCNIL_liste_controles_2016.csv") {
        
            $entetes = ["annee", "type_de_controle", "nom", "lieu_controle", "departement", "secteur_activite"];
            $nomTable = "liste_controle";
            $firstLine = true; // Flag pour ignorer la première ligne

            // Ouverture du fichier en lecture seule
            if (($handle = fopen($filename, "r")) !== FALSE) {
                // Boucle à travers les données du fichier CSV
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Ignorer la première ligne (en-tête)
                    if ($firstLine) {
                        $firstLine = false; // Change le flag après la première ligne
                        continue; // Passe à l'itération suivante de la boucle
                    }
                    
                    // Préparation de la requête SQL d'insertion
                    $sql = "INSERT INTO $nomTable (annee, type_de_controle, nom, lieu_controle, departement, secteur_activite) VALUES (:" . implode(", :", $entetes) . ")";
                    $stmt = $dbh->prepare($sql);

                    $bindArray = array_combine($entetes, $data); // Associe les en-têtes aux données
                    foreach ($bindArray as $key => $value) {
                        $stmt->bindValue(':'.$key, $value);
                    }

                    // Exécution de la requête SQL
                    if (!$stmt->execute()) {
                        var_dump($stmt->errorInfo());
                        die();
                    }
                }

                // Fermeture du fichier
                fclose($handle);
            }

        } else if () {

        }

        // Pas besoin de fermer la connexion explicitement, PHP le fait automatiquement à la fin du script
        echo "Importation terminée.";
    }

//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