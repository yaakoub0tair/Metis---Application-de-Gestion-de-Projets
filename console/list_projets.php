<?php

require_once __DIR__ . '/../autoload.php';

echo "=== LISTE DES PROJETS ===\n\n";

try {
    $service = new ProjetService();
    $projets = $service->getAllProjets();

    if (empty($projets)) {
        echo "Aucun projet trouvé.\n";
    } else {
        foreach ($projets as $projet) {
            echo "ID: " . $projet->getId() . "\n";
            echo "Titre: " . $projet->getTitre() . "\n";
            echo "Description: " . $projet->getDescription() . "\n";
            echo "Date début: " . $projet->getDateDebut()->format('Y-m-d') . "\n";
            echo "Date fin: " . $projet->getDateFin()->format('Y-m-d') . "\n";
            echo "Membre ID: " . $projet->getIdMembre() . "\n";
            
            if ($projet instanceof ProjetCourt) {
                echo "Type: Projet Court\n";
                echo "Budget: " . $projet->getBudget() . "\n";
                echo "Priorité: " . $projet->getPriorite() . "\n";
            } else {
                echo "Type: Projet Long\n";
                echo "Phase: " . $projet->getPhase() . "\n";
                echo "Responsable: " . $projet->getResponsable() . "\n";
            }
            
            echo "-------------------\n";
        }
        
        echo "\nTotal: " . count($projets) . " projet(s)\n";
    }

} catch (Exception $e) {
    echo " Erreur: " . $e->getMessage() . "\n";
}