<?php

class ActiviteService
{
    private ActiviteRepository $activiteRepo;
    private ProjetRepository $projetRepo;

    public function __construct()
    {
        $this->activiteRepo = new ActiviteRepository();
        $this->projetRepo = new ProjetRepository();
    }


    public function createActivite(Activite $activite): bool
    {
        
        $projet = $this->projetRepo->findById($activite->getIdProjet());
        if (!$projet) {
            throw new Exception("Projet introuvable!");
        }

        return $this->activiteRepo->create($activite);
    }

    
    public function getActivite(int $id): ?Activite
    {
        return $this->activiteRepo->findById($id);
    }

    public function getAllActivites(): array
    {
        return $this->activiteRepo->findAll();
    }

    public function getActivitesByProjet(int $idProjet): array
    {
        return $this->activiteRepo->findByProjetId($idProjet);
    }

    
    public function updateActivite(Activite $activite): bool
    {
        $existingActivite = $this->activiteRepo->findById($activite->getId());
        if (!$existingActivite) {
            throw new Exception("Activité introuvable!");
        }

        return $this->activiteRepo->update($activite);
    }

    
    public function deleteActivite(int $id): bool
    {
        $activite = $this->activiteRepo->findById($id);
        if (!$activite) {
            throw new Exception("Activité introuvable!");
        }

        return $this->activiteRepo->delete($id);
    }
}