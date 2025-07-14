-- Création de la base de données
CREATE DATABASE IF NOT EXISTS emprunt_objets 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE emprunt_objets;

-- CRÉATION DES TABLES

-- Table membre
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre VARCHAR(10) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    ville VARCHAR(100) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255) DEFAULT NULL
);

-- Table categorie_objet
CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL UNIQUE
);

-- Table objet
CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(200) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

-- Table images_objet
CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE
);

-- Table emprunt
CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE DEFAULT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet) ON DELETE CASCADE,
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre) ON DELETE CASCADE
);

-- INSERTION DES DONNÉES DE TEST

-- Insertion des 4 membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp) VALUES
('Marie Dubois', '1985-03-15', 'F', 'marie.dubois@email.com', 'Paris', '1234'),
('Jean Martin', '1990-07-22', 'M', 'jean.martin@email.com', 'Lyon', '1234'),
('Sophie Leroy', '1988-11-08', 'F', 'sophie.leroy@email.com', 'Marseille', '1234'),
('Pierre Moreau', '1992-05-30', 'M', 'pierre.moreau@email.com', 'Toulouse', '1234');

-- Insertion des 4 catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Insertion des objets 
-- Objets de Marie Dubois (id_membre = 1)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux professionnel', 1, 1),
('Fer à lisser', 1, 1),
('Perceuse visseuse', 2, 1),
('Niveau à bulle', 2, 1),
('Clé à molette 300mm', 3, 1),
('Compresseur d\'air', 3, 1),
('Robot pâtissier', 4, 1),
('Blender haute performance', 4, 1),
('Trousse de maquillage complète', 1, 1),
('Scie sauteuse', 2, 1);

-- Objets de Jean Martin (id_membre = 2)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Tondeuse à barbe', 1, 2),
('Marteau-piqueur', 2, 2),
('Boîte à outils complète', 3, 2),
('Machine à café expresso', 4, 2),
('Épilateur électrique', 1, 2),
('Ponceuse orbitale', 2, 2),
('Cric hydraulique', 3, 2),
('Friteuse sans huile', 4, 2),
('Débroussailleuse', 2, 2),
('Manomètre pression pneus', 3, 2);

-- Objets de Sophie Leroy (id_membre = 3)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Miroir lumineux de maquillage', 1, 3),
('Meuleuse d\'angle', 2, 3),
('Chandelier hydraulique', 3, 3),
('Multicuiseur électrique', 4, 3),
('Brosse nettoyante visage', 1, 3),
('Perceuse à colonne', 2, 3),
('Clés plates jeu complet', 3, 3),
('Yaourtière', 4, 3),
('Masseur facial', 1, 3),
('Scie circulaire', 2, 3);

-- Objets de Pierre Moreau (id_membre = 4)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
('Rasoir électrique', 1, 4),
('Défonceuse', 2, 4),
('Extracteur de roulement', 3, 4),
('Extracteur de jus', 4, 4),
('Appareil anti-rides', 1, 4),
('Cloueuse pneumatique', 2, 4),
('Testeur de batterie', 3, 4),
('Déshydrateur alimentaire', 4, 4),
('Brosse chauffante', 1, 4),
('Tronçonneuse', 2, 4);

-- Insertion des images d'objets (exemples)
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'seche_cheveux_1.jpg'),
(1, 'seche_cheveux_2.jpg'),
(2, 'fer_lisser_1.jpg'),
(3, 'perceuse_1.jpg'),
(4, 'niveau_bulle_1.jpg'),
(5, 'cle_molette_1.jpg'),
(6, 'compresseur_1.jpg'),
(7, 'robot_patissier_1.jpg'),
(8, 'blender_1.jpg'),
(9, 'maquillage_1.jpg'),
(10, 'scie_sauteuse_1.jpg');

-- Insertion des 10 emprunts
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
-- Emprunts terminés (avec date de retour)
(1, 2, '2024-01-15', '2024-01-20'),
(3, 4, '2024-02-01', '2024-02-05'),
(7, 3, '2024-02-10', '2024-02-15'),
(12, 1, '2024-03-01', '2024-03-06'),
(18, 2, '2024-03-15', '2024-03-20'),

-- Emprunts en cours (sans date de retour)
(5, 3, '2024-06-01', NULL),
(14, 1, '2024-06-15', NULL),
(25, 4, '2024-07-01', NULL),
(30, 2, '2024-07-10', NULL),
(22, 3, '2024-05-01', NULL);

-- VUES 

-- Vue pour afficher les objets avec leur catégorie et propriétaire
CREATE VIEW vue_objets_complets AS
SELECT 
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    m.nom AS proprietaire,
    CASE 
        WHEN e.date_retour IS NULL THEN 'Emprunté'
        ELSE 'Disponible'
    END AS statut_emprunt,
    e.date_emprunt,
    e.id_membre AS id_emprunteur,
    emp.nom AS emprunteur
FROM objet o
JOIN categorie_objet c ON o.id_categorie = c.id_categorie
JOIN membre m ON o.id_membre = m.id_membre
LEFT JOIN emprunt e ON o.id_objet = e.id_objet AND e.date_retour IS NULL
LEFT JOIN membre emp ON e.id_membre = emp.id_membre;

-- Vue pour les emprunts en cours
CREATE VIEW vue_emprunts_en_cours AS
SELECT 
    e.id_emprunt,
    o.nom_objet,
    m.nom AS emprunteur,
    prop.nom AS proprietaire,
    e.date_emprunt,
    e.date_retour,
    DATEDIFF(CURDATE(), e.date_emprunt) AS jours_emprunt
FROM emprunt e
JOIN objet o ON e.id_objet = o.id_objet
JOIN membre m ON e.id_membre = m.id_membre
JOIN membre prop ON o.id_membre = prop.id_membre
WHERE e.date_retour IS NULL;
