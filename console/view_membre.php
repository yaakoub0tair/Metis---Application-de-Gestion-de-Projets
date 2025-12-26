<?php

require_once __DIR__ . '/../autoload.php';

echo "=== DÉTAILS D'UN MEMBRE ===\n\n";

try {
    $membreService = new MembreService();
    $projetService = new ProjetService();
    $membres = $membreService->getAllMembres();
    if (empty($membres)) {
        echo "Aucun membre trouvé.\n";
        exit;
    }
    
    echo "Membres disponibles:\n";
    foreach ($membres as $membre) {
        echo $membre->getId() . " - " . $membre->getNom() . "\n";
    }
    
    echo "\nID du membre: ";
    $id = (int)trim(fgets(STDIN));
    
    $membre = $membreService->getMembre($id);
    if (!$membre) {
        echo "Membre introuvable!\n";
        exit;
    }
    
    echo "\n--- INFORMATIONS DU MEMBRE ---\n";
    echo "ID: " . $membre->getId() . "\n";
    echo "Nom: " . $membre->getNom() . "\n";
    echo "Email: " . $membre->getEmail() . "\n";
    echo "Date création: " . $membre->getDateCreation()->format('Y-m-d H:i:s') . "\n";
    
   
    $projets = $projetService->getProjetsByMembre($id);
    echo "\n--- SES PROJETS (" . count($projets) . ") ---\n";
    
    if (empty($projets)) {
        echo "Aucun projet.\n";
    } else {
        foreach ($projets as $projet) {
            $type = $projet instanceof ProjetCourt ? 'Court' : 'Long';
            echo "- " . $projet->getTitre() . " (Type: $type)\n";
        }
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}