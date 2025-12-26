<?php

class ActiviteRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    
    public function create(Activite $activite): bool
    {
        $sql = "INSERT INTO activites (titre, description, date_debut, date_fin, status, id_projet)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $activite->getTitre(),
            $activite->getDescription(),
            $activite->getDateDebut()->format('Y-m-d'),
            $activite->getDateFin()->format('Y-m-d'),
            $activite->getStatus(),
            $activite->getIdProjet()
        ]);
    }

    
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM activites ORDER BY id DESC");
        $activites = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $activite = $this->mapToEntity($row);
            if ($activite) {
                $activites[] = $activite;
            }
        }

        return $activites;
    }

    
    public function findById(int $id): ?Activite
    {
        $sql = "SELECT * FROM activites WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapToEntity($row) : null;
    }

    
    public function findByProjetId(int $idProjet): array
    {
        $sql = "SELECT * FROM activites WHERE id_projet = ? ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$idProjet]);

        $activites = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $activite = $this->mapToEntity($row);
            if ($activite) {
                $activites[] = $activite;
            }
        }

        return $activites;
    }

    
    public function update(Activite $activite): bool
    {
        $sql = "UPDATE activites 
                SET titre = ?, description = ?, date_debut = ?, date_fin = ?, status = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $activite->getTitre(),
            $activite->getDescription(),
            $activite->getDateDebut()->format('Y-m-d'),
            $activite->getDateFin()->format('Y-m-d'),
            $activite->getStatus(),
            $activite->getId()
        ]);
    }

    
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM activites WHERE id = ?");
        return $stmt->execute([$id]);
    }

    
    private function mapToEntity(array $row): ?Activite
    {
        try {
            $activite = new Activite(
                $row['titre'],
                $row['description'],
                $row['status'],
                new DateTime($row['date_debut']),
                new DateTime($row['date_fin']),
                $row['id_projet']
            );
            $activite->hydrate($row);
            return $activite;

        } catch (Exception $e) {
            return null;
        }
    }
}
