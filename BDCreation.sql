DROP DATABASE IF EXISTS BDallumeToi;
CREATE DATABASE BDallumeToi;
USE BDallumeToi;

CREATE TABLE Role (
    role_id     SMALLINT(6)         NOT NULL        AUTO_INCREMENT,
    role_name   VARCHAR(50)         NOT NULL,
    PRIMARY KEY (role_id) 
);

CREATE TABLE User(
    user_id             SMALLINT(6)     NOT NULL     AUTO_INCREMENT,
    username            VARCHAR(50)     NOT NULL     UNIQUE,
    prenom              VARCHAR(50)     NOT NULL,
    nom                 VARCHAR(50)     NOT NULL,
    motDePasse          VARCHAR(50)     NOT NULL,
    email               VARCHAR(50)     NOT NULL,
    role_id             SMALLINT(6)     NOT NULL,
    PRIMARY KEY (user_id ),
    FOREIGN KEY (role_id) REFERENCES Role(role_id)
);

CREATE TABLE temperature(
    temp_id             INT             NOT NULL    AUTO_INCREMENT,
    temperature         DECIMAL(3,1)    NOT NULL,
    time_tempe          TIME            NOT NULL,
    tempeFroid          BOOLEAN         NOT NULL,
    tempeChaud          BOOLEAN         NOT NULL,
    tiede               BOOLEAN         NOT NULL,
    PRIMARY KEY (temp_id)
);

CREATE TABLE bruit(
    bruit_id            INT         NOT NULL    AUTO_INCREMENT,
    time_bruit          TIME,
    decibels            INT,
    PRIMARY KEY (bruit_id)
);

CREATE TABLE UserAttempt (
    attemps_id      INT             NOT NULL    AUTO_INCREMENT,
    last_attempt    DATETIME        NOT NULL,
    attempts        SMALLINT(6)     NOT NULL,
    blocked         BOOLEAN         NOT NULL,
    user_id         SMALLINT(6)     NOT NULL,
    PRIMARY KEY (attemps_id),
    FOREIGN KEY (user_id) REFERENCES User(user_id)
);

INSERT INTO Role (role_name) VALUES
("Admin"),
("Utilisateur"),
("Visiteur");

INSERT INTO User(username,prenom,nom,motDePasse,email,role_id) VALUES
('maheb','Mahélie','Bergeron','Rouge1','mahelie.b@cegepjonquiere.ca',1),
('tinkywinky','Catherine','Perron-Arpin','Bleu1','catherine.pa@cegepjonquiere.ca',1),
('beernadette','Nicolas','cote','Vert1','nicolas.c@cegepjonquiere.ca',2);

INSERT INTO temperature (temperature, time_tempe, tempeFroid, tempeChaud, tiede) VALUES
(22.5, '12:00:00', false, false, true);

INSERT INTO bruit(decibels, time_bruit) VALUES
(50, '12:00:00');

INSERT INTO UserAttempt (last_attempt, attempts, blocked, user_id) VALUES
('2024-01-01 00:00:00', 0, false, 1),
('2024-01-01 00:00:00', 0, false, 1),
('2024-01-01 00:00:00', 0, false, 2);