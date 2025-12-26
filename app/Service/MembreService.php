<?php

class MembreService
{
    private MembreRepository $membreRepo;
    private ProjetRepository $projetRepo;

    public function __construct()
    {
        $this->membreRepo = new MembreRepository();
        $this->projetRepo = new ProjetRepository();
    }

    
    public function createMembre(Membre $membre): bool
    {
        if ($this->membreRepo->findByEmail($membre->getEmail()) !== null) {
            throw new Exception("Cet email existe déjà!");
        }

        return $this->membreRepo->create($membre);
    }


    public function getMembre(int $id): ?Membre
    {
        return $this->membreRepo->findById($id);
    }

    public function getAllMembres(): array
    {
        return $this->membreRepo->findAll();
    }

    
    public function updateMembre(int $id, string $nom, string $email): bool
    {
        $membre = $this->membreRepo->findById($id);
        if (!$membre) {
            throw new Exception("Membre introuvable!");
        }

        
        $existingMembre = $this->membreRepo->findByEmail($email);
        if ($existingMembre && $existingMembre->getId() !== $id) {
            throw new Exception("Cet email est déjà utilisé!");
        }

        $membre->setNom($nom);
        $membre->setEmail($email);

        return $this->membreRepo->update($membre);
    }

    
    public function deleteMembre(int $id): bool
    {
        $membre = $this->membreRepo->findById($id);
        if (!$membre) {
            throw new Exception("Membre introuvable!");
        }

        
        $projets = $this->projetRepo->findByMemberId($id);
        if (count($projets) > 0) {
            throw new Exception("Impossible de supprimer: ce membre a des projets associés!");
        }

        return $this->membreRepo->delete($id);
    }
}