<?php

class MembreRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    
    public function create(Membre $membre)
    {
        $sql = "INSERT INTO membres (nom, email, date_creation)
                VALUES (?,?,?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $membre->getNom(),
            $membre->getEmail(),
            $membre->getDateCreation()->format('Y-m-d H:i:s')
        ]);
    }

    
    public function findAll()
    {
        $sql = "SELECT * FROM membres ORDER BY id DESC";
        $stmt = $this->db->query($sql);

        $membres = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $membres[] = $this->mapToEntity($row);
        }

        return $membres;
    }

    
    public function findById(int $id)
    {
        return $this->findOne("SELECT * FROM membres WHERE id = ? LIMIT 1", [$id]);
    }

    
    public function findByEmail(string $email)
    {
        return $this->findOne("SELECT * FROM membres WHERE email = ? LIMIT 1", [$email]);
    }

    
    public function update(Membre $membre)
    {
        $sql = "UPDATE membres SET nom = ?, email = ? WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $membre->getNom(),
            $membre->getEmail(),
            $membre->getId()
        ]);
    }

    
    public function delete(int $id)
    {
        $sql = "DELETE FROM membres WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }


    private function findOne(string $sql, array $params)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapToEntity($row) : null;
    }

    private function mapToEntity(array $row)
    {
        $membre = new Membre($row['nom'], $row['email']);
        $membre->hydrate($row);
        return $membre;
    }
}
