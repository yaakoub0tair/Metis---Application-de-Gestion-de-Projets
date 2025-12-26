<?php

require_once __DIR__ . '/../autoload.php';

echo "=== SUPPRIMER UNE ACTIVITÉ ===\n\n";

try {
    $service = new ActiviteService();
    
   
    $activites = $service->getAllActivites();
    if (empty($activites)) {
        echo "Aucune activité trouvée.\n";
        exit;
    }
    
    echo "Activités disponibles:\n";
    foreach ($activites as $activite) {
        echo $activite->getId() . " - " . $activite->getTitre() . " (Status: " . $activite->getStatus() . ")\n";
    }
    
    echo "\nID de l'activité à supprimer: ";
    $id = (int)trim(fgets(STDIN));
    
    echo "Êtes-vous sûr? (oui/non): ";
    $confirmation = trim(fgets(STDIN));
    
    if (strtolower($confirmation) === 'oui') {
        if ($service->deleteActivite($id)) {
            echo "\n Activité supprimée avec succès!\n";
        }
    } else {
        echo "\n Suppression annulée.\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}