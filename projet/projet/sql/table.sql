USE phpmyadmin;

CREATE TABLE IF NOT EXISTS Utilisateur(
   ID_user INT AUTO_INCREMENT,
   Nom VARCHAR(50),
   Prénom VARCHAR(50),
   Login VARCHAR(50),
   Mot_de_passe VARCHAR(50),
   Centre VARCHAR(50),
   Statut INT,
   CV VARCHAR(50),
   logo VARCHAR(50),
   PRIMARY KEY(ID_user)
);

CREATE TABLE IF NOT EXISTS Entreprise(
   ID_entreprise INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   secteur_d_activité VARCHAR(50) NOT NULL,
   Adresse VARCHAR(50) NOT NULL,
   Adresse_2 VARCHAR(50),
   Adresse_3 VARCHAR(50),
   Note_avis DECIMAL(15,2),
   Stat_postule INT,
   Voir boolean NOT NULL,
   logo VARCHAR(50),
   PRIMARY KEY(ID_entreprise)
);

CREATE TABLE IF NOT EXISTS Offre(
   ID_offre INT AUTO_INCREMENT,
   Nom VARCHAR(50),
   compétences VARCHAR(50),
   detail VARCHAR(1024),
   promo VARCHAR(50),
   durée_du_stage INT,
   Rémunération DECIMAL(15,2),
   date_de_l_offre DATE,
   place INT,
   Voir boolean NOT NULL,
   Teletravail boolean NOT NULL,
   ID_entreprise INT NOT NULL,
   PRIMARY KEY(ID_offre),
   FOREIGN KEY(ID_entreprise) REFERENCES Entreprise(ID_entreprise)
);

CREATE TABLE IF NOT EXISTS Wishlist(
   ID_wish INT AUTO_INCREMENT,
   ID_offre INT,
   ID_user INT,
   PRIMARY KEY(ID_wish),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user)
);

CREATE TABLE Candidature(
   ID_Candi INT AUTO_INCREMENT,
   ID_offre INT NOT NULL,
   ID_user INT,
   PRIMARY KEY(ID_Candi),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user)
);


CREATE TABLE IF NOT EXISTS Promotion(
   Id_Promo INT AUTO_INCREMENT,
   Nom_promo VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Promo),
   UNIQUE(Nom_promo)
);

CREATE TABLE IF NOT EXISTS admin(
   Id_Admin INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(50) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   login VARCHAR(50),
   Mot_de_passe VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Admin)
);


CREATE TABLE IF NOT EXISTS Integrer(
   ID_user INT,
   Id_Promo INT,
   PRIMARY KEY(ID_user, Id_Promo),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(Id_Promo) REFERENCES Promotion(Id_Promo)
);

CREATE TABLE Stage(
   ID_Stage INT AUTO_INCREMENT,
   ID_Candi INT  NOT NULL,
   ID_user INT NOT NULL,
   PRIMARY KEY(ID_Stage) ,
   FOREIGN KEY(ID_Candi) REFERENCES Candidature(ID_Candi),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user)
);



CREATE TABLE Avis(
   Id_avis INT AUTO_INCREMENT,
   Note DECIMAL(15,2) NOT NULL,
   description VARCHAR(1024),
   Jour DATE,
   ID_user INT NOT NULL,
   ID_offre INT NOT NULL,
   PRIMARY KEY(Id_avis),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre)
);
