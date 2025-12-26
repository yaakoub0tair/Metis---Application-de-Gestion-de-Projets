<?php

require_once __DIR__ . '/../autoload.php';

function afficherMenu() {
    echo "\n";
    echo "╔════════════════════════════════════╗\n";
    echo "║      METIS - MENU PRINCIPAL        ║\n";
    echo "╚════════════════════════════════════╝\n";
    echo "\n";
    echo "=== GESTION DES MEMBRES ===\n";
    echo "1.  Créer un membre\n";
    echo "2.  Liste des membres\n";
    echo "3.  Voir détails d'un membre\n";
    echo "4.  Modifier un membre\n";
    echo "5.  Supprimer un membre\n";
    echo "\n";
    echo "=== GESTION DES PROJETS ===\n";
    echo "6.  Créer un projet\n";
    echo "7.  Liste de tous les projets\n";
    echo "8.  Voir détails d'un projet\n";
    echo "9.  Projets d'un membre\n";
    echo "10. Modifier un projet\n";
    echo "11. Supprimer un projet\n";
    echo "\n";
    echo "=== GESTION DES ACTIVITÉS ===\n";
    echo "12. Créer une activité\n";
    echo "13. Liste de toutes les activités\n";
    echo "14. Historique activités d'un projet\n";
    echo "15. Modifier une activité\n";
    echo "16. Supprimer une activité\n";
    echo "\n";
    echo "0.  Quitter\n";
    echo "\n";
    echo "Votre choix: ";
}

while (true) {
    afficherMenu();
    $choix = (int)trim(fgets(STDIN));
    
    switch ($choix) {
        
        case 1:
            require __DIR__ . '/create_membre.php';
            break;
        case 2:
            require __DIR__ . '/list_membres.php';
            break;
        case 3:
            require __DIR__ . '/view_membre.php';
            break;
        case 4:
            require __DIR__ . '/update_membre.php';
            break;
        case 5:
            require __DIR__ . '/delete_membre.php';
            break;
            
        
        case 6:
            require __DIR__ . '/create_projet.php';
            break;
        case 7:
            require __DIR__ . '/list_projets.php';
            break;
        case 8:
            require __DIR__ . '/view_projet.php';
            break;
        case 9:
            require __DIR__ . '/projets_by_membre.php';
            break;
        case 10:
            require __DIR__ . '/update_projet.php';
            break;
        case 11:
            require __DIR__ . '/delete_projet.php';
            break;
            
        
        case 12:
            require __DIR__ . '/create_activite.php';
            break;
        case 13:
            require __DIR__ . '/list_activites.php';
            break;
        case 14:
            require __DIR__ . '/activites_by_projet.php';
            break;
        case 15:
            require __DIR__ . '/update_activite.php';
            break;
        case 16:
            require __DIR__ . '/delete_activite.php';
            break;
            
        case 0:
            echo "\n Au revoir!\n";
            exit;
            
        default:
            echo "\n Choix invalide!\n";
    }
    
    echo "\nAppuyez sur Entrée pour continuer...";
    fgets(STDIN);
}