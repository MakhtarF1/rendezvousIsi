<?php
class Client {
    private $conn;
    private $table = "clients";
    
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $telephone;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO {$this->table} (nom, prenom, email, telephone) VALUES (:nom, :prenom, :email, :telephone)";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':telephone' => $this->telephone
        ]);
    }

    public function read() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function readOne() {
        if (!is_numeric($this->id)) {
            return null;
        }
        
        $query = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE {$this->table} SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':telephone' => $this->telephone,
            ':id' => $this->id
        ]);
    }

    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $this->id]);
    }
}