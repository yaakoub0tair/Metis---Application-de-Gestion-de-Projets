<?php

require_once __DIR__ . '/../autoload.php';

echo "=== MODIFIER UN MEMBRE ===\n\n";

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
    
    echo "\nID du membre à modifier: ";
    $id = (int)trim(fgets(STDIN));
    
    echo "Nouveau nom: ";
    $nom = trim(fgets(STDIN));
    
    echo "Nouveau email: ";
    $email = trim(fgets(STDIN));

    if ($service->updateMembre($id, $nom, $email)) {
        echo "\n Membre modifié avec succès!\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}