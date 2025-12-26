<?php

require_once __DIR__ . '/../autoload.php';

echo "=== SUPPRIMER UN MEMBRE ===\n\n";

try {
    $service = new MembreService();
    

    $membres = $service->getAllMembres();
    if (empty($membres)) {
        echo "Aucun membre trouvé.\n";
        exit;
    }
    
    echo "Membres disponibles:\n";
    foreach ($membres as $membre) {
        echo $membre->getId() . " - " . $membre->getNom() . " (" . $membre->getEmail() . ")\n";
    }
    
    echo "\nID du membre à supprimer: ";
    $id = (int)trim(fgets(STDIN));
    
    echo "Êtes-vous sûr? (oui/non): ";
    $confirmation = trim(fgets(STDIN));
    
    if (strtolower($confirmation) === 'oui') {
        if ($service->deleteMembre($id)) {
            echo "\n Membre supprimé avec succès!\n";
        }
    } else {
        echo "\n Suppression annulée.\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}