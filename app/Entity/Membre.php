<?php

class Membre {
    private int $id;
    private string $nom;
    private string $email;
    private DateTime $dateCreation;

    public function __construct(string $nom, string $email) {
        $this->setNom($nom);
        $this->setEmail($email);
        $this->dateCreation = new DateTime();
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getDateCreation(): DateTime {
        return $this->dateCreation;
    }

    public function setNom(string $nom): void {
        if (empty($nom)) {
            throw new Exception("Nom invalide");
        }
        $this->nom = $nom;
    }

    public function setEmail(string $email): void {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email invalide");
        }
        $this->email = $email;
    }

    public function hydrate(array $data): void {
        $this->id = (int)$data["id"];
        $this->setNom($data["nom"]);
        $this->setEmail($data["email"]);
        $this->dateCreation = new DateTime($data["date_creation"]);
    }
}
