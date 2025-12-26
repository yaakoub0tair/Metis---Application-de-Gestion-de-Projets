<?php

require_once __DIR__ . '/../autoload.php';

echo "=== MODIFIER UNE ACTIVITÉ ===\n\n";

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
    
    echo "\nID de l'activité à modifier: ";
    $id = (int)trim(fgets(STDIN));
    
    $activite = $service->getActivite($id);
    if (!$activite) {
        echo "Activité introuvable!\n";
        exit;
    }
    
    echo "Nouveau titre [" . $activite->getTitre() . "]: ";
    $titre = trim(fgets(STDIN));
    if (!empty($titre)) {
        $activite->setTitre($titre);
    }
    
    echo "Nouvelle description [" . $activite->getDescription() . "]: ";
    $description = trim(fgets(STDIN));
    if (!empty($description)) {
        $activite->setDescription($description);
    }
    
    echo "Nouveau status (en_attente/en_cours/termine) [" . $activite->getStatus() . "]: ";
    $status = trim(fgets(STDIN));
    if (!empty($status)) {
        $activite->setStatus($status);
    }
    
    if ($service->updateActivite($activite)) {
        echo "\n Activité modifiée avec succès!\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}