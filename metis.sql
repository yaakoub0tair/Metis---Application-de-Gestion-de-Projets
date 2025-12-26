CREATE DATABASE IF NOT EXISTS dbmetis;
USE dbmetis;
CREATE TABLE IF NOT EXISTS membres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB ;

CREATE TABLE IF NOT EXISTS projets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT ,
    date_debut DATE DEFAULT CURRENT_TIMESTAMP,
    date_fin DATE DEFAULT NULL,
    type ENUM('court', 'long') NOT NULL,
    budget DECIMAL(10, 2) DEFAULT NULL,
    priorite VARCHAR(255) DEFAULT NULL,
    phase VARCHAR(255) DEFAULT NULL,
    responsable VARCHAR(255) DEFAULT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_membre) REFERENCES membres(id) ON DELETE RESTRICT
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS activites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_debut DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_fin DATE DEFAULT NULL,
    status ENUM('en_attente', 'en_cours', 'termine') NOT NULL,
    id_projet INT NOT NULL,
    FOREIGN KEY (id_projet) REFERENCES projets(id) ON DELETE RESTRICT
)ENGINE=InnoDB;



