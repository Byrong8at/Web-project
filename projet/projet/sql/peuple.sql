use phpmyadmin;

INSERT INTO Utilisateur (Nom, Prénom, Login, Mot_de_passe, Centre, Statut, CV) VALUES
('Dupont', 'Jean', 'jean.dupont', 'motdepasse1', 'Lille', 1, 'cv_jean_dupont.pdf'),
('Martin', 'Sophie', 'sophie.martin', 'motdepasse2', 'Arras', 1, 'cv_sophie_martin.pdf'),
('Dupont', 'Amir', 'amir.dupont', 'fada_14', 'marseille', 1, 'cv_amir_dupont.pdf'),
('Laurent', 'Adrien', 'adrien.laurent', 'motdepasse2', 'Arras', 1, 'cv_adrien_laurent.pdf'),
('Dupont', 'mark', 'mark.dupont', 'motdepasse1', 'Lille', 1, 'cv_mark_dupont.pdf'),
('Martin', 'Sophie', 'sophie.martin', 'math.cesi', 'Arras', 0, null),
('Lefebvre', 'Hugo', 'Hugo.lefebvre', 'motdepasse3', 'Lille', 0, null);


INSERT INTO Entreprise (Nom, secteur_d_activité, Adresse, Note_avis, Stat_postule, Voir, logo) VALUES
('Microsoft', 'Technologie', '1 Rue de la Techno', 4.5, 18, 1, 'logo_entreprise_a.png'),
('Cesi', 'Finance', '5 Avenue des Finances', 3.8, 1, 0, 'logo_entreprise_b.png'),
('CHU', 'Santé', '10 Boulevard de la Santé', 4.2, 14, 0, 'logo_entreprise_c.png');


INSERT INTO Offre (Nom, compétences, types_de_promotions_concernées, durée_du_stage, Rémunération, date_de_l_offre, nombre_de_places_offertes_aux_étudiants, Teletravail, ID_entreprise) VALUES
('Développeur Web', 'HTML, CSS, JavaScript', 'Informatique', 6, 1500.00, '2024-04-01', 5, 0, 1),
('Analyste financier', 'Analyse financière, Excel',  'Finance', 3, 2000.00, '2024-03-15', 3, 1, 2),
('Assistant médical', 'Secrétariat médical, Communication', 'Santé', 4, 1800.00, '2024-03-10', 2, 0, 3);

INSERT INTO Promotion (Nom_promo) VALUES
('X2_i3'),
('X1_i3'),
('X4_i3'),
('X5_i3'),
('X3_i3');

INSERT INTO Integrer (ID_user, Id_Promo) VALUES
(1, 1),
(2, 2),
(3, 5),
(4, 3),
(6, 3),
(6, 1),
(7, 3),
(7, 2),
(5, 3);

INSERT INTO Admin (Nom, Prenom, Email, login, Mot_de_passe) VALUES
('La chevre', 'Hugues', 'admin@example.com', 'admin', 'Donald_minie');

INSERT INTO Wishlist (ID_offre, ID_user) VALUES
(1, 1),
(2, 2),
(2, 3),
(1, 2),
(3, 2),
(3, 3);


