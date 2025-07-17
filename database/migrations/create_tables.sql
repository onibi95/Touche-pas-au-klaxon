-- Création de la base
CREATE DATABASE IF NOT EXISTS covoiturage CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE covoiturage;

-- Table des agences (villes)
CREATE TABLE agences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    role ENUM('utilisateur', 'admin') DEFAULT 'utilisateur'
);

-- Table des trajets
CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agence_depart_id INT NOT NULL,
    agence_arrivee_id INT NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    date_arrivee DATE NOT NULL,
    heure_arrivee TIME NOT NULL,
    places_total INT NOT NULL CHECK (places_total > 0),
    places_disponibles INT NOT NULL CHECK (places_disponibles >= 0),
    utilisateur_id INT NOT NULL,
    FOREIGN KEY (agence_depart_id) REFERENCES agences(id) ON DELETE RESTRICT,
    FOREIGN KEY (agence_arrivee_id) REFERENCES agences(id) ON DELETE RESTRICT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);
