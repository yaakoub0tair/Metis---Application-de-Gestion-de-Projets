<?php

require_once __DIR__ . '/../autoload.php';

echo "=== DÉTAILS D'UN PROJET ===\n\n";

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
        $type = $projet instanceof ProjetCourt ? 'Court' : 'Long';
        echo $projet->getId() . " - " . $projet->getTitre() . " ($type)\n";
    }
    
    echo "\nID du projet: ";
    $id = (int)trim(fgets(STDIN));
    
    $projet = $projetService->getProjet($id);
    if (!$projet) {
        echo "Projet introuvable!\n";
        exit;
    }
    
    echo "\n--- INFORMATIONS DU PROJET ---\n";
    echo "ID: " . $projet->getId() . "\n";
    echo "Titre: " . $projet->getTitre() . "\n";
    echo "Description: " . $projet->getDescription() . "\n";
    echo "Date début: " . $projet->getDateDebut()->format('Y-m-d') . "\n";
    echo "Date fin: " . $projet->getDateFin()->format('Y-m-d') . "\n";
    echo "Membre ID: " . $projet->getIdMembre() . "\n";
    
    if ($projet instanceof ProjetCourt) {
        echo "Type: Projet Court\n";
        echo "Budget: " . $projet->getBudget() . " DH\n";
        echo "Priorité: " . $projet->getPriorite() . "\n";
    } else {
        echo "Type: Projet Long\n";
        echo "Phase: " . $projet->getPhase() . "\n";
        echo "Responsable: " . $projet->getResponsable() . "\n";
    }
    
   
    $activites = $activiteService->getActivitesByProjet($id);
    echo "\n--- SES ACTIVITÉS (" . count($activites) . ") ---\n";
    
    if (empty($activites)) {
        echo "Aucune activité.\n";
    } else {
        foreach ($activites as $activite) {
            echo "- " . $activite->getTitre() . " [" . $activite->getStatus() . "]\n";
        }
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}