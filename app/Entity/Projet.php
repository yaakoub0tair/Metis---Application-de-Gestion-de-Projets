<?php

abstract class Projet {

    protected int $id;
    protected string $titre;
    protected string $description;
    protected DateTime $dateDebut;
    protected DateTime $dateFin;
    protected int $idMembre;

    public function __construct(
        string $titre,
        string $description,
        DateTime $dateDebut,
        DateTime $dateFin,
        int $idMembre
    ) {
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->idMembre = $idMembre;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDateDebut(): DateTime {
        return $this->dateDebut;
    }

    public function getDateFin(): DateTime {
        return $this->dateFin;
    }

    public function getIdMembre(): int {
        return $this->idMembre;
    }

    public function setTitre(string $titre): void {
        if (empty($titre)) {
            throw new Exception("Titre invalide");
        }
        $this->titre = $titre;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function hydrate(array $data): void {
        $this->id = (int)$data["id"];
        $this->setTitre($data["titre"]);
        $this->setDescription($data["description"]);
        $this->dateDebut = new DateTime($data["date_debut"]);
        $this->dateFin = new DateTime($data["date_fin"]);
        $this->idMembre = (int)$data["id_membre"];
    }
}
