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
   types_de_promotions_concernées VARCHAR(50),
   durée_du_stage INT,
   Rémunération DECIMAL(15,2),
   date_de_l_offre DATE,
   nombre_de_places_offertes_aux_étudiants INT,
   Teletravail boolean NOT NULL,
   ID_entreprise INT NOT NULL,
   PRIMARY KEY(ID_offre),
   FOREIGN KEY(ID_entreprise) REFERENCES Entreprise(ID_entreprise)
);

CREATE TABLE IF NOT EXISTS Wishlist(
   ID_wish INT,
   ID_offre INT,
   ID_user INT,
   PRIMARY KEY(ID_wish),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user)
);

CREATE TABLE IF NOT EXISTS Candidature(
   ID_Candi INT AUTO_INCREMENT,
   Etat_Postule boolean NOT NULL,
   ID_offre INT NOT NULL,
   PRIMARY KEY(ID_Candi),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre)
);

CREATE TABLE IF NOT EXISTS Promotion(
   Id_Promo INT AUTO_INCREMENT,
   Nom_promo VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Promo),
   UNIQUE(Nom_promo)
);

CREATE TABLE IF NOT EXISTS Admin(
   Id_Admin INT AUTO_INCREMENT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(50) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   login VARCHAR(50),
   Mot_de_passe VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Admin)
);

CREATE TABLE IF NOT EXISTS Intéragir(
   ID_user INT,
   ID_offre INT,
   ID_entreprise INT,
   PRIMARY KEY(ID_user, ID_offre, ID_entreprise),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_entreprise) REFERENCES Entreprise(ID_entreprise)
);

CREATE TABLE IF NOT EXISTS effectuer(
   ID_user INT,
   ID_Candi INT,
   PRIMARY KEY(ID_user, ID_Candi),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(ID_Candi) REFERENCES Candidature(ID_Candi)
);

CREATE TABLE IF NOT EXISTS Integrer(
   ID_user INT,
   Id_Promo INT,
   PRIMARY KEY(ID_user, Id_Promo),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(Id_Promo) REFERENCES Promotion(Id_Promo)
);
