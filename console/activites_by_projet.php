<?php

require_once __DIR__ . '/../autoload.php';

echo "=== ACTIVITÉS D'UN PROJET (HISTORIQUE) ===\n\n";

try {
    $projetService = new ProjetService();
    $activiteService = new ActiviteService();
    
    
    $projets = $projetService->getAllProjets();
    if (empty($projets)) {
        echo "Aucun projet trouvé.\n";
        exit;
    }
    
    echo "Projets disponibles:\n";
    foreach ($projets as $projet) {
        echo $projet->getId() . " - " . $projet->getTitre() . "\n";
    }
    
    echo "\nID du projet: ";
    $idProjet = (int)trim(fgets(STDIN));
    
    $projet = $projetService->getProjet($idProjet);
    if (!$projet) {
        echo "Projet introuvable!\n";
        exit;
    }
    
    echo "\n=== HISTORIQUE DES ACTIVITÉS: " . strtoupper($projet->getTitre()) . " ===\n\n";
    
    $activites = $activiteService->getActivitesByProjet($idProjet);
    
    if (empty($activites)) {
        echo "Aucune activité trouvée pour ce projet.\n";
    } else {
        foreach ($activites as $activite) {
            echo "ID: " . $activite->getId() . "\n";
            echo "Titre: " . $activite->getTitre() . "\n";
            echo "Description: " . $activite->getDescription() . "\n";
            echo "Status: " . $activite->getStatus() . "\n";
            echo "Date début: " . $activite->getDateDebut()->format('Y-m-d') . "\n";
            echo "Date fin: " . $activite->getDateFin()->format('Y-m-d') . "\n";
            echo "-------------------\n";
        }
        
        echo "\nTotal: " . count($activites) . " activité(s)\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}