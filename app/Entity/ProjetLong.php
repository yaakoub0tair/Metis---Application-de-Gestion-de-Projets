<?php
class Projetlong extends Projet {
    private string $phase;
    private string $responsable;
    public function __construct(string $titre, string $description, DateTime $dateDebut, DateTime $dateFin, int $idMembre, string $phase, string $responsable) {
        parent::__construct($titre, $description, $dateDebut, $dateFin, $idMembre);
        $this->phase = $phase;
        $this->responsable = $responsable;
    }
    public function getPhase(): string {
        return $this->phase;
    }
    public function getResponsable(): string {
        return $this->responsable;
    }
    public function setPhase(string $phase): void {
        $phaseValide=["planification", "developpement", "test", "deploiement"];
        if(!in_array($phase, $phaseValide)) {

            throw new Exception("phase non valide il faut : planification,developpement,test,Deploiement");

        }
        $this->phase = $phase;
    }
    public function setResponsable(string $responsable): void {
        if(empty($responsable)) {
            throw new Exception("Responsable invalide");
        }
        $this->responsable = $responsable;
    }
    public function hydrate(array $data): void {
        parent::hydrate($data);
        $this->setPhase($data["phase"]);
        $this->setResponsable($data["responsable"]);
    }

}

