<?php

require_once __DIR__ . '/../autoload.php';

echo "=== SUPPRIMER UN PROJET ===\n\n";

try {
    $service = new ProjetService();
    
   
    $projets = $service->getAllProjets();
    if (empty($projets)) {
        echo "Aucun projet trouvé.\n";
        exit;
    }
    
    echo "Projets disponibles:\n";
    foreach ($projets as $projet) {
        $type = $projet instanceof ProjetCourt ? 'Court' : 'Long';
        echo $projet->getId() . " - " . $projet->getTitre() . " (Type: $type)\n";
    }
    
    echo "\nID du projet à supprimer: ";
    $id = (int)trim(fgets(STDIN));
    
    echo "Êtes-vous sûr? (oui/non): ";
    $confirmation = trim(fgets(STDIN));
    
    if (strtolower($confirmation) === 'oui') {
        if ($service->deleteProjet($id)) {
            echo "\n Projet supprimé avec succès!\n";
        }
    } else {
        echo "\n Suppression annulée.\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}