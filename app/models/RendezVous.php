<?php
class RendezVous {
    private $conn;
    private $table = "rendez_vous";
    
    public $id;
    public $date;
    public $heure;
    public $description;
    public $client_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table} (date, heure, description, client_id) VALUES (:date, :heure, :description, :client_id)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':date' => $this->date,
            ':heure' => $this->heure,
            ':description' => $this->description,
            ':client_id' => $this->client_id
        ]);
    }

    public function read() {
        $query = "SELECT r.*, c.nom, c.prenom FROM {$this->table} r 
                 LEFT JOIN clients c ON r.client_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    public function readOne() {
        $query = "SELECT r.*, c.nom, c.prenom FROM {$this->table} r 
                 LEFT JOIN clients c ON r.client_id = c.id 
                 WHERE r.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $this->id]);
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null; // Retourne null si aucun rendez-vous n'est trouvé
    }
    
    
    

    public function update() {
        $query = "UPDATE {$this->table} SET date = :date, heure = :heure, description = :description, client_id = :client_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':date' => $this->date,
            ':heure' => $this->heure,
            ':description' => $this->description,
            ':client_id' => $this->client_id,
            ':id' => $this->id
        ]);
    }

    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $this->id]);
    }
}