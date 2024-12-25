-- Création de la base de données
CREATE DATABASE IF NOT EXISTS gestion_rdv;
USE gestion_rdv;

-- Table des clients
CREATE TABLE IF NOT EXISTS clients (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des rendez-vous
CREATE TABLE IF NOT EXISTS rendez_vous (
    id INT PRIMARY KEY AUTO_INCREMENT,
    date DATE NOT NULL,
    heure TIME NOT NULL,
    description TEXT NOT NULL,
    client_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
    INDEX idx_date (date),
    INDEX idx_client (client_id)
);