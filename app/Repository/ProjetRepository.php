<?php

class ProjetRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    
    public function create(Projet $projet): bool
    {
        $type = $projet instanceof ProjetCourt ? 'court' : 'long';

        if ($type === 'court') {
            
            $sql = "INSERT INTO projets (titre, description, date_debut, date_fin, id_membre, type, budget, priorite)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                $projet->getTitre(),
                $projet->getDescription(),
                $projet->getDateDebut()->format('Y-m-d'),
                $projet->getDateFin()->format('Y-m-d'),
                $projet->getIdMembre(),
                $type,
                $projet->getBudget(),
                $projet->getPriorite()
            ]);
        } else {
            $sql = "INSERT INTO projets (titre, description, date_debut, date_fin, id_membre, type, phase, responsable)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                $projet->getTitre(),
                $projet->getDescription(),
                $projet->getDateDebut()->format('Y-m-d'),
                $projet->getDateFin()->format('Y-m-d'),
                $projet->getIdMembre(),
                $type,
                $projet->getPhase(),
                $projet->getResponsable()
            ]);
        }
    }

    
    public function findAll(): array
    {
        $sql = "SELECT * FROM projets ORDER BY id DESC";
        $stmt = $this->db->query($sql);

        $projets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $projets[] = $this->mapToEntity($row);
        }

        return $projets;
    }

    
    public function findById(int $id): ?Projet
    {
        $sql = "SELECT * FROM projets WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapToEntity($row) : null;
    }

    
    public function findByMemberId(int $idMembre): array
    {
        $sql = "SELECT * FROM projets WHERE id_membre = ? ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idMembre]);

        $projets = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $projets[] = $this->mapToEntity($row);
        }

        return $projets;
    }

    
    public function update(Projet $projet): bool
    {
        if ($projet instanceof ProjetCourt) {
            $sql = "UPDATE projets 
                    SET titre = ?, description = ?, date_debut = ?, date_fin = ?, budget = ?, priorite = ? 
                    WHERE id = ?";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                $projet->getTitre(),
                $projet->getDescription(),
                $projet->getDateDebut()->format('Y-m-d'),
                $projet->getDateFin()->format('Y-m-d'),
                $projet->getBudget(),
                $projet->getPriorite(),
                $projet->getId()
            ]);
        } else {
            $sql = "UPDATE projets 
                    SET titre = ?, description = ?, date_debut = ?, date_fin = ?, phase = ?, responsable = ? 
                    WHERE id = ?";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                $projet->getTitre(),
                $projet->getDescription(),
                $projet->getDateDebut()->format('Y-m-d'),
                $projet->getDateFin()->format('Y-m-d'),
                $projet->getPhase(),
                $projet->getResponsable(),
                $projet->getId()
            ]);
        }
    }

    
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM projets WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }


    private function mapToEntity(array $row): ?Projet
    {
        try {
            if ($row['type'] === 'court') {
                $projet = new ProjetCourt(
                    $row['titre'],
                    $row['description'],
                    new DateTime($row['date_debut']),
                    new DateTime($row['date_fin']),
                    (int)$row['id_membre'],
                    (float)$row['budget'],
                    $row['priorite']
                );
            } else {
                $projet = new ProjetLong(
                    $row['titre'],
                    $row['description'],
                    new DateTime($row['date_debut']),
                    new DateTime($row['date_fin']),
                    (int)$row['id_membre'],
                    $row['phase'],
                    $row['responsable']
                );
            }

            $projet->hydrate($row);
            return $projet;

        } catch (Exception $e) {
            return null;
        }
    }
}