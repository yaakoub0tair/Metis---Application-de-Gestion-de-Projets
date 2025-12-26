<?php

require_once __DIR__ . '/../autoload.php';

echo "=== CRÉER UN PROJET ===\n\n";

try {
    $membreService = new MembreService();
    $projetService = new ProjetService();
    
  
    $membres = $membreService->getAllMembres();
    if (empty($membres)) {
        echo "Aucun membre trouvé. Créez d'abord un membre!\n";
        exit;
    }
    
    echo "Membres disponibles:\n";
    foreach ($membres as $membre) {
        echo $membre->getId() . " - " . $membre->getNom() . "\n";
    }
    
    echo "\nID du membre: ";
    $idMembre = (int)trim(fgets(STDIN));
    
    echo "Titre: ";
    $titre = trim(fgets(STDIN));
    
    echo "Description: ";
    $description = trim(fgets(STDIN));
    
    echo "Date début (Y-m-d): ";
    $dateDebut = new DateTime(trim(fgets(STDIN)));
    
    echo "Date fin (Y-m-d): ";
    $dateFin = new DateTime(trim(fgets(STDIN)));
    
    echo "\nType de projet:\n";
    echo "1 - Projet Court\n";
    echo "2 - Projet Long\n";
    echo "Choix: ";
    $type = (int)trim(fgets(STDIN));
    
    if ($type === 1) {
      
        echo "Budget: ";
        $budget = (float)trim(fgets(STDIN));
        
        echo "Priorité (faible/moyen/eleve): ";
        $priorite = trim(fgets(STDIN));
        
        $projet = new ProjetCourt($titre, $description, $dateDebut, $dateFin, $idMembre, $budget, $priorite);
        
    } else {
        
        echo "Phase (planification/developpement/test/deploiement): ";
        $phase = trim(fgets(STDIN));
        
        echo "Responsable: ";
        $responsable = trim(fgets(STDIN));
        
        $projet = new ProjetLong($titre, $description, $dateDebut, $dateFin, $idMembre, $phase, $responsable);
    }
    
    if ($projetService->createProjet($projet)) {
        echo "\n Projet créé avec succès!\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}