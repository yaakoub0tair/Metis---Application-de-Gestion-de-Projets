<?php

require_once __DIR__ . '/../autoload.php';

echo "=== CRÉER UNE ACTIVITÉ ===\n\n";

try {
    $projetService = new ProjetService();
    $activiteService = new ActiviteService();
    
    
    $projets = $projetService->getAllProjets();
    if (empty($projets)) {
        echo "Aucun projet trouvé. Créez d'abord un projet!\n";
        exit;
    }
    
    echo "Projets disponibles:\n";
    foreach ($projets as $projet) {
        echo $projet->getId() . " - " . $projet->getTitre() . "\n";
    }
    
    echo "\nID du projet: ";
    $idProjet = (int)trim(fgets(STDIN));
    
    echo "Titre: ";
    $titre = trim(fgets(STDIN));
    
    echo "Description: ";
    $description = trim(fgets(STDIN));
    
    echo "Date début (Y-m-d): ";
    $dateDebut = new DateTime(trim(fgets(STDIN)));
    
    echo "Date fin (Y-m-d): ";
    $dateFin = new DateTime(trim(fgets(STDIN)));
    
    echo "Status (en_attente/en_cours/termine): ";
    $status = trim(fgets(STDIN));
    
    $activite = new Activite($titre, $description, $status, $dateDebut, $dateFin, $idProjet);
    
    if ($activiteService->createActivite($activite)) {
        echo "\n Activité créée avec succès!\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}