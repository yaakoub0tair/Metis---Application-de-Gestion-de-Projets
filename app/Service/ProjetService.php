<?php

class ProjetService
{
    private ProjetRepository $projetRepo;
    private MembreRepository $membreRepo;
    private ActiviteRepository $activiteRepo;

    public function __construct()
    {
        $this->projetRepo = new ProjetRepository();
        $this->membreRepo = new MembreRepository();
        $this->activiteRepo = new ActiviteRepository();
    }

  
    public function createProjet(Projet $projet): bool
    {
      
        $membre = $this->membreRepo->findById($projet->getIdMembre());
        if (!$membre) {
            throw new Exception("Membre introuvable!");
        }

        return $this->projetRepo->create($projet);
    }


    public function getProjet(int $id): ?Projet
    {
        return $this->projetRepo->findById($id);
    }

    public function getAllProjets(): array
    {
        return $this->projetRepo->findAll();
    }

    public function getProjetsByMembre(int $idMembre): array
    {
        return $this->projetRepo->findByMemberId($idMembre);
    }


    public function updateProjet(Projet $projet): bool
    {
        $existingProjet = $this->projetRepo->findById($projet->getId());
        if (!$existingProjet) {
            throw new Exception("Projet introuvable!");
        }

        return $this->projetRepo->update($projet);
    }

   
    public function deleteProjet(int $id): bool
    {
        $projet = $this->projetRepo->findById($id);
        if (!$projet) {
            throw new Exception("Projet introuvable!");
        }

        $activites = $this->activiteRepo->findByProjetId($id);
        foreach ($activites as $activite) {
            if ($activite->getStatus() === 'en_cours') {
                throw new Exception("Impossible de supprimer: le projet a des activités en cours!");
            }
        }

        return $this->projetRepo->delete($id);
    }
}