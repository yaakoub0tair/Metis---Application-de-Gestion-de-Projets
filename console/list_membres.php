<?php

require_once __DIR__ . '/../autoload.php';

echo "=== LISTE DES MEMBRES ===\n\n";

try {
    $service = new MembreService();
    $membres = $service->getAllMembres();

    if (empty($membres)) {
        echo "Aucun membre trouvé.\n";
    } else {
        foreach ($membres as $membre) {
            echo "ID: " . $membre->getId() . "\n";
            echo "Nom: " . $membre->getNom() . "\n";
            echo "Email: " . $membre->getEmail() . "\n";
            echo "Date création: " . $membre->getDateCreation()->format('Y-m-d H:i:s') . "\n";
            echo "-------------------\n";
        }
        
        echo "\nTotal: " . count($membres) . " membre(s)\n";
    }

} catch (Exception $e) {
    echo " Erreur: " . $e->getMessage() . "\n";
}