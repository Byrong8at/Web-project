CREATE TABLE Utilisateur(
   ID_user INT,
   Nom VARCHAR(50),
   Prénom VARCHAR(50),
   Login VARCHAR(50),
   Mot_de_passe VARCHAR(50),
   Centre VARCHAR(50),
   Statut INT,
   CV VARCHAR(50),
   PRIMARY KEY(ID_user)
);

CREATE TABLE Entreprise(
   ID_entreprise INT,
   Nom VARCHAR(50) NOT NULL,
   secteur_d_activité VARCHAR(50) NOT NULL,
   Adresse VARCHAR(50) NOT NULL,
   Adresse_2 VARCHAR(50),
   Adresse_3 VARCHAR(50),
   Note_avis DECIMAL(15,2),
   Stat_postule INT,
   Invisible LOGICAL NOT NULL,
   logo VARCHAR(50),
   PRIMARY KEY(ID_entreprise)
);

CREATE TABLE Offre(
   ID_offre INT,
   Nom VARCHAR(50),
   compétences VARCHAR(50),
   entreprise VARCHAR(50),
   types_de_promotions_concernées VARCHAR(50),
   durée_du_stage INT,
   Rémunération DECIMAL(15,2),
   date_de_l_offre DATE,
   nombre_de_places_offertes_aux_étudiants INT,
   Teletravail LOGICAL NOT NULL,
   ID_entreprise INT NOT NULL,
   PRIMARY KEY(ID_offre),
   FOREIGN KEY(ID_entreprise) REFERENCES Entreprise(ID_entreprise)
);

CREATE TABLE Wishlist(
   ID_wish INT,
   ID_offre INT,
   ID_user INT,
   PRIMARY KEY(ID_wish),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user)
);

CREATE TABLE Candidature(
   ID_Candi INT,
   Etat_Postule LOGICAL NOT NULL,
   PRIMARY KEY(ID_Candi)
);

CREATE TABLE Promotion(
   Id_Promo INT,
   Nom_promo VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Promo),
   UNIQUE(Nom_promo)
);

CREATE TABLE Admin(
   Id_Admin INT,
   Nom VARCHAR(50) NOT NULL,
   Prenom VARCHAR(50) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   Mot_de_passe VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_Admin)
);

CREATE TABLE Intéragir(
   ID_user INT,
   ID_offre INT,
   ID_entreprise INT,
   PRIMARY KEY(ID_user, ID_offre, ID_entreprise),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_entreprise) REFERENCES Entreprise(ID_entreprise)
);

CREATE TABLE effectuer(
   ID_user INT,
   ID_Candi INT,
   PRIMARY KEY(ID_user, ID_Candi),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(ID_Candi) REFERENCES Candidature(ID_Candi)
);

CREATE TABLE recevoir(
   ID_offre INT,
   ID_Candi INT,
   PRIMARY KEY(ID_offre, ID_Candi),
   FOREIGN KEY(ID_offre) REFERENCES Offre(ID_offre),
   FOREIGN KEY(ID_Candi) REFERENCES Candidature(ID_Candi)
);

CREATE TABLE Integrer(
   ID_user INT,
   Id_Promo INT,
   PRIMARY KEY(ID_user, Id_Promo),
   FOREIGN KEY(ID_user) REFERENCES Utilisateur(ID_user),
   FOREIGN KEY(Id_Promo) REFERENCES Promotion(Id_Promo)
);
