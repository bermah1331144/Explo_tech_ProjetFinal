--Création de la BD
CREATE DATABASE BDallumeToi;

USE BDallumeToi;

CREATE TABLE Role (
    role_id     SMALLINT(6)         NOT NULL        AUTO_INCREMENT,
    role_name   VARCHAR(50)         NOT NULL,
    PRIMARY KEY (role_id) 
);


-- Création de la table des utilisateur
CREATE TABLE utilisateur(
    utilisateur_id      SMALLINT(6)     NOT NULL     AUTO_INCREMENT,
    nomUtilisateur      VARCHAR(50)     NOT NULL     UNIQUE,
    prenom              VARCHAR(50)     NOT NULL,
    nom                 VARCHAR(50)     NOT NULL,
    motDePasse          VARCHAR(50)     NOT NULL,
    email               VARCHAR(50)     NOT NULL,
    role_id             SMALLINT(6)     NOT NULL,
    PRIMARY KEY (utilisateur_id),
    FOREIGN KEY (role_id) REFERENCES Role(role_id)
);


-- Creation de la table des températrature
CREATE TABLE temperature(
    temperature         DECIMAL(3,1),
    historiqueTemps     TIME,
    tempeFroid          BOOLEAN     NOT NULL,
    tempeChaud          BOOLEAN     NOT NULL,
    tiede               BOOLEAN     NOT NULL
);

--Création de la table du bruit
CREATE TABLE bruit(
    historiqueBruit     INT,
    tempsBruit          TIME,
    bruit               BOOLEAN
);

--Sécurisation des tentative de connection
CREATE TABLE UserAttempt (
    last_attempt    DATETIME        NOT NULL,
    attempts        SMALLINT(6)     NOT NULL,
    blocked         BOOLEAN         NOT NULL,
    user_id         SMALLINT(6)     NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES User(utilisateur_id)
);

--Valeur possible pour les roles
INSERT INTO role (role_id) VALUES
("Admin"),
("Utilisateur"),
("Visiteur");

--Données dans la table utilisateur
INSERT INTO utilisateur (prenom,nom,motDePasse,email,role_id) VALUES
('Mahélie','Bergeron','Rouge1','mahelie.b@cegepjonquiere.ca',1),
('Catherine','Perron-Arpin','Bleu1','catherine.pa@cegepjonquiere.ca',1),
('Nicolas','cote','Vert1','nicolas.c@cegepjonquiere.ca',2);

--Donnée dans la table température
INSERT INTO temperature (tempeFroid,tempeChaud,tiede) VALUES
(false,false,false);

--Données dans ;a table pour le bruit
INSERT INTO bruit(bruit) VALUES
(false);

--Donnee dans la table attempt
INSERT INTO UserAttempt (last_attempt, attempts, blocked, user_id) VALUES
('00:00:00', 0, false, 1),
('00:00:00', 0, false, 1),
('00:00:00', 0, false, 2);