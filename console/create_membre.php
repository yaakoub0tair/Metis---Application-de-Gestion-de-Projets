
<?php

require_once __DIR__ . '/../autoload.php';

echo "=== CRÉER UN MEMBRE ===\n\n";

try {
   
    echo "Nom: ";
    $nom = trim(fgets(STDIN));
    
    echo "Email: ";
    $email = trim(fgets(STDIN));

    $membre = new Membre($nom, $email);
    
    $service = new MembreService();
    if ($service->createMembre($membre)) {
        echo "\n Membre créé avec succès!\n";
    }

} catch (Exception $e) {
    echo "\n Erreur: " . $e->getMessage() . "\n";
}