<?php
class ProjetCourt extends Projet {
    private float $budget;
    private string $priorite;

    public function __construct(string $titre, string $description, DateTime $dateDebut, DateTime $dateFin, int $idMembre, float $budget, string $priorite) {
        parent::__construct($titre, $description, $dateDebut, $dateFin, $idMembre);
        $this->setbudget($budget);
        $this->setPriorite($priorite);
    }
   public function getBudget(): float {
    return $this->budget;
   }
   public function getPriorite(): string {
    return $this->priorite;
   }
   public function setBudget(float $budget): void {
    if ($budget < 0) {
        throw new Exception(" budjet must be positive");
    }
    $this->budget = $budget;
   }
   public function setPriorite(string $priorite): void {
    $prioriteValide=["faible", "moyen", "eleve"];
    if (!in_array($priorite, $prioriteValide)) {
        throw new Exception("priorite non valide il faut : faible,moyen,eleve");
    }

       $this->priorite = $priorite;

   }
   public function hydrate(array $data): void {
       parent::hydrate($data);
       $this->setBudget((float)$data["budget"]);
       $this->setPriorite($data["priorite"]);
   }
        
    }
