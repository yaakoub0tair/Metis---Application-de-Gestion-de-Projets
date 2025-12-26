<?php

require_once __DIR__ . '/../autoload.php';

echo "=== LISTE DES ACTIVITÉS ===\n\n";

try {
    $service = new ActiviteService();
    $activites = $service->getAllActivites();

    if (empty($activites)) {
        echo "Aucune activité trouvée.\n";
    } else {
        foreach ($activites as $activite) {
            echo "ID: " . $activite->getId() . "\n";
            echo "Titre: " . $activite->getTitre() . "\n";
            echo "Description: " . $activite->getDescription() . "\n";
            echo "Status: " . $activite->getStatus() . "\n";
            echo "Date début: " . $activite->getDateDebut()->format('Y-m-d') . "\n";
            echo "Date fin: " . $activite->getDateFin()->format('Y-m-d') . "\n";
            echo "Projet ID: " . $activite->getIdProjet() . "\n";
            echo "-------------------\n";
        }
        
        echo "\nTotal: " . count($activites) . " activité(s)\n";
    }

} catch (Exception $e) {
    echo " Erreur: " . $e->getMessage() . "\n";
}