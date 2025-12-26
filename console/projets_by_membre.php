<?php

require_once __DIR__ . '/../autoload.php';

echo "=== PROJETS D'UN MEMBRE ===\n\n";

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
    $idMembre = (int)trim(fgets(STDIN));
    
    $membre = $membreService->getMembre($idMembre);
    if (!$membre) {
        echo "Membre introuvable!\n";
        exit;
    }
    
    echo "\n=== PROJETS DE " . strtoupper($membre->getNom()) . " ===\n\n";
    
    $projets = $projetService->getProjetsByMembre($idMembre);
    
    if (empty($projets)) {
        echo "Aucun projet trouvé pour ce membre.\n";
    } else {
        foreach ($projets as $projet) {
            echo "ID: " . $projet->getId() . "\n";
            echo "Titre: " . $projet->getTitre() . "\n";
            echo "Description: " . $projet->getDescription() . "\n";
            
            if ($projet instanceof ProjetCourt) {
                echo "Type: Court\n";
                echo "Budget: " . $projet->getBudget() . " DH\n";
                echo "Priorité: " . $projet->getPriorite() . "\n";
            } else {
                echo "Type: Long\n";
                echo "Phase: " . $projet->getPhase() . "\n";
                echo "Responsable: " . $projet->getResponsable() . "\n";
            }
            
            echo "-------------------\n";
        }
        
        echo "\nTotal: " . count($projets) . " projet(s)\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}