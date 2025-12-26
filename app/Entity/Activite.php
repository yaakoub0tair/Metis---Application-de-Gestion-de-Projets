<?php

class Activite
{
    private int $id;
    private string $titre;
    private string $description;
    private string $status;
    private DateTime $dateDebut;
    private DateTime $dateFin;
    private int $idProjet;

    public function __construct(
        string $titre,
        string $description,
        string $status,
        DateTime $dateDebut,
        DateTime $dateFin,
        int $idProjet
    ) {
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setStatus($status);
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->idProjet = $idProjet;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }

    public function getDateFin(): DateTime
    {
        return $this->dateFin;
    }

    public function getIdProjet(): int
    {
        return $this->idProjet;
    }
    public function setTitre(string $titre): void
    {
        if (empty($titre)) {
            throw new Exception("Titre invalide");
        }
        $this->titre = $titre;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(string $status): void
    {
        $statusValide = ["en_cours", "termine", "en_attente"];
        if (!in_array($status, $statusValide)) {
            throw new Exception("Status non valide. Valeurs acceptées: en_cours, termine, en_attente");
        }
        $this->status = $status;
    }

    public function setDateDebut(DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin(DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    public function setIdProjet(int $idProjet): void
    {
        $this->idProjet = $idProjet;
    }

    public function hydrate(array $data): void
    {
        $this->id = (int)$data["id"];
        $this->setTitre($data["titre"]);
        $this->setDescription($data["description"]);
        $this->setStatus($data["status"]);
        $this->dateDebut = new DateTime($data["date_debut"]);
        $this->dateFin = new DateTime($data["date_fin"]);
        $this->idProjet = (int)$data["id_projet"];
    }
}