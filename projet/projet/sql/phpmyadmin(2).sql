-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 31 mars 2024 à 20:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `Id_Admin` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `login` varchar(50) DEFAULT NULL,
  `Mot_de_passe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`Id_Admin`, `Nom`, `Prenom`, `Email`, `login`, `Mot_de_passe`) VALUES
(1, 'La chevre', 'Hugues', 'admin@example.com', 'admin', 'Donald_minie');

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `ID_Candi` int(11) NOT NULL,
  `Etat_Postule` tinyint(1) NOT NULL,
  `ID_offre` int(11) NOT NULL,
  `ID_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`ID_Candi`, `Etat_Postule`, `ID_offre`, `ID_user`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2),
(3, 1, 1, 3),
(4, 1, 2, 2),
(5, 1, 2, 3),
(7, 1, 3, 3),
(9, 1, 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `ID_entreprise` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `secteur_d_activité` varchar(50) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `Adresse_2` varchar(50) DEFAULT NULL,
  `Adresse_3` varchar(50) DEFAULT NULL,
  `Voir` tinyint(1) NOT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID_entreprise`, `Nom`, `secteur_d_activité`, `Adresse`, `Adresse_2`, `Adresse_3`, `Voir`, `logo`) VALUES
(1, 'Microsoft', 'Technologie', '1 Rue de la Techno', '', '', 1, 'src/logo/Microsoft.png'),
(2, 'Cesi', 'Finance', '5 Avenue des Finances', '', '', 0, 'src/logo/Cesi.png'),
(3, 'CHU', 'Santé', '10 Boulevard de la Santé', '', '', 1, 'src/logo/CHU.jpg'),
(4, 'Capgemini', 'Informatique', 'Lille, rue massena', 'Paris la defense', '', 1, 'src/logo/Capgemini.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `integrer`
--

CREATE TABLE `integrer` (
  `ID_user` int(11) NOT NULL,
  `Id_Promo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `integrer`
--

INSERT INTO `integrer` (`ID_user`, `Id_Promo`) VALUES
(1, 2),
(2, 2),
(3, 5),
(5, 3),
(6, 1),
(7, 3),
(8, 1),
(9, 2),
(12, 5),
(13, 3),
(14, 2);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `ID_offre` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `competences` varchar(50) DEFAULT NULL,
  `detail` varchar(1024) DEFAULT NULL,
  `promo` varchar(50) DEFAULT NULL,
  `durée_du_stage` int(11) DEFAULT NULL,
  `Rémunération` decimal(15,2) DEFAULT NULL,
  `date_de_l_offre` date DEFAULT NULL,
  `place` int(11) DEFAULT NULL,
  `Voir` tinyint(1) NOT NULL,
  `Teletravail` tinyint(1) NOT NULL,
  `ID_entreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`ID_offre`, `Nom`, `competences`, `detail`, `promo`, `durée_du_stage`, `Rémunération`, `date_de_l_offre`, `place`, `Voir`, `Teletravail`, `ID_entreprise`) VALUES
(1, 'Développeur Web', 'HTML, CSS, JavaScript', 'Propulsez votre présence en ligne avec notre expertise en développement web. Sites sur mesure, UX/UI optimisée, SEO intégré. Transformez votre vision en réalité digitale dès aujourd\'hui.', '1', 6, 1500.00, '2024-04-01', 5, 1, 0, 1),
(2, 'Analyste financier', 'Analyse financière, Excel', 'Découvrez notre analyse financière exhaustive : données précises, tendances claires, recommandations stratégiques. Prenez des décisions éclairées pour votre entreprise dès maintenant.', '1', 3, 200.00, '2024-03-15', 3, 1, 1, 1),
(3, 'Assistant médical', 'Secrétariat médical, Communication', '', '4', 4, 1800.00, '2024-03-10', 2, 0, 0, 3),
(4, 'Devellopeur front', 'Informatique', 'Sujet variée, entreprise cool rejoignez nous\r\n                        ', '3', 8, 2024.00, '0000-00-00', 1, 1, 0, 4),
(5, 'Back end', 'SQL/PHP', 'Cherche jeune entrepreneur à 50km\r\n                        ', '4', 4, 31.00, '0000-00-00', 9, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Structure de la table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Structure de la table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Structure de la table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Déchargement des données de la table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'Sql', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"admin\",\"candidature\",\"entreprise\",\"integrer\",\"offre\",\"pma__bookmark\",\"pma__central_columns\",\"pma__column_info\",\"pma__designer_settings\",\"pma__export_templates\",\"pma__favorite\",\"pma__history\",\"pma__navigationhiding\",\"pma__pdf_pages\",\"pma__recent\",\"pma__relation\",\"pma__savedsearches\",\"pma__table_coords\",\"pma__table_info\",\"pma__table_uiprefs\",\"pma__tracking\",\"pma__userconfig\",\"pma__usergroups\",\"pma__users\",\"promotion\",\"utilisateur\",\"wishlist\"],\"table_structure[]\":[\"admin\",\"candidature\",\"entreprise\",\"integrer\",\"offre\",\"pma__bookmark\",\"pma__central_columns\",\"pma__column_info\",\"pma__designer_settings\",\"pma__export_templates\",\"pma__favorite\",\"pma__history\",\"pma__navigationhiding\",\"pma__pdf_pages\",\"pma__recent\",\"pma__relation\",\"pma__savedsearches\",\"pma__table_coords\",\"pma__table_info\",\"pma__table_uiprefs\",\"pma__tracking\",\"pma__userconfig\",\"pma__usergroups\",\"pma__users\",\"promotion\",\"utilisateur\",\"wishlist\"],\"table_data[]\":[\"admin\",\"candidature\",\"entreprise\",\"integrer\",\"offre\",\"pma__bookmark\",\"pma__central_columns\",\"pma__column_info\",\"pma__designer_settings\",\"pma__export_templates\",\"pma__favorite\",\"pma__history\",\"pma__navigationhiding\",\"pma__pdf_pages\",\"pma__recent\",\"pma__relation\",\"pma__savedsearches\",\"pma__table_coords\",\"pma__table_info\",\"pma__table_uiprefs\",\"pma__tracking\",\"pma__userconfig\",\"pma__usergroups\",\"pma__users\",\"promotion\",\"utilisateur\",\"wishlist\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure de la table @TABLE@\",\"latex_structure_continued_caption\":\"Structure de la table @TABLE@ (suite)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Contenu de la table @TABLE@\",\"latex_data_continued_caption\":\"Contenu de la table @TABLE@ (suite)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Structure de la table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Structure de la table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Déchargement des données de la table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"phpmyadmin\",\"table\":\"entreprise\"},{\"db\":\"phpmyadmin\",\"table\":\"offre\"},{\"db\":\"phpmyadmin\",\"table\":\"utilisateur\"},{\"db\":\"phpmyadmin\",\"table\":\"integrer\"},{\"db\":\"phpmyadmin\",\"table\":\"candidature\"},{\"db\":\"phpmyadmin\",\"table\":\"wishlist\"},{\"db\":\"phpmyadmin\",\"table\":\"promotion\"},{\"db\":\"phpmyadmin\",\"table\":\"admin\"},{\"db\":\"phpmyadmin\",\"table\":\"effectuer\"},{\"db\":\"phpmyadmin\",\"table\":\"utilisateurs\"}]');

-- --------------------------------------------------------

--
-- Structure de la table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Structure de la table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Déchargement des données de la table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'phpmyadmin', 'offre', '{\"CREATE_TIME\":\"2024-03-29 10:20:23\"}', '2024-03-29 12:13:16');

-- --------------------------------------------------------

--
-- Structure de la table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Structure de la table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Déchargement des données de la table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-03-31 14:10:43', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"fr\"}');

-- --------------------------------------------------------

--
-- Structure de la table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Structure de la table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `Id_Promo` int(11) NOT NULL,
  `Nom_promo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`Id_Promo`, `Nom_promo`) VALUES
(2, 'X1_i3'),
(1, 'X2_i3'),
(5, 'X3_i3'),
(3, 'X4_i3'),
(4, 'X5_i3');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID_user` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prénom` varchar(50) DEFAULT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Mot_de_passe` varchar(50) DEFAULT NULL,
  `Centre` varchar(50) DEFAULT NULL,
  `Statut` int(11) DEFAULT NULL,
  `CV` varchar(50) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_user`, `Nom`, `Prénom`, `Login`, `Mot_de_passe`, `Centre`, `Statut`, `CV`, `logo`) VALUES
(1, 'Adjeroud', 'Adam', 'adj.adam', 'motdepasse1', 'Lille', 1, 'cv_jean_dupont.pdf', 'src/profil/adj.adam.jpg'),
(2, 'Martin', 'Sophie', 'sophie.martin', 'motdepasse2', 'Arras', 1, 'cv_sophie_martin.pdf', NULL),
(3, 'Dupont', 'Amir', 'amir.dupont', 'fada_14', 'marseille', 1, 'cv_amir_dupont.pdf', NULL),
(5, 'Dupont', 'mark', 'mark.dupont', 'motdepasse1', 'Lille', 1, 'cv_mark_dupont.pdf', NULL),
(6, 'Martin', 'Sophie', 'sophie.martin', 'math.cesi', 'Arras', 0, NULL, NULL),
(7, 'Lefebvre', 'Hugo', 'Hugo.lefebvre', 'admin', 'Lille', 0, NULL, 'src/profil/Hugo.lefebvre.jpg'),
(8, '', '', '', '', '', 1, NULL, 'src/profil/'),
(9, 'Pasdure', 'Clement', 'clem.dure', 'revient', 'Lyon', 0, NULL, 'src/profil/clem.dure.png'),
(11, 'Hertz', 'Erwan', 'Erwan.hertz', 'Pudat7896', 'Lille', 1, NULL, ''),
(12, 'Chakira', 'Maksum', 'Maksum.chakira', 'Webtoon', 'Lille', 1, NULL, 'src/profil/Maksum.chakira.png'),
(13, 'Guibert', 'Nathan', 'Nath.lens', 'allezlille', 'Lens', 1, NULL, 'src/profil/Nath.lens.jpg'),
(14, 'Martel', 'Theo', 'Martel.doors', 'ratio', 'Avignon', 0, NULL, 'src/profil/Martel.doors.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID_wish` int(11) NOT NULL,
  `ID_offre` int(11) DEFAULT NULL,
  `ID_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `wishlist`
--

INSERT INTO `wishlist` (`ID_wish`, `ID_offre`, `ID_user`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 1, 2),
(5, 3, 2),
(6, 3, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_Admin`);

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`ID_Candi`),
  ADD KEY `ID_offre` (`ID_offre`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`ID_entreprise`);

--
-- Index pour la table `integrer`
--
ALTER TABLE `integrer`
  ADD PRIMARY KEY (`ID_user`,`Id_Promo`),
  ADD KEY `Id_Promo` (`Id_Promo`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`ID_offre`),
  ADD KEY `ID_entreprise` (`ID_entreprise`);

--
-- Index pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Index pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Index pour la table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Index pour la table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Index pour la table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Index pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Index pour la table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Index pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Index pour la table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Index pour la table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Index pour la table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Index pour la table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Index pour la table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Index pour la table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Index pour la table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`Id_Promo`),
  ADD UNIQUE KEY `Nom_promo` (`Nom_promo`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID_user`);

--
-- Index pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID_wish`),
  ADD KEY `ID_offre` (`ID_offre`),
  ADD KEY `ID_user` (`ID_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `ID_Candi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `ID_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `ID_offre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `Id_Promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID_wish` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `candidature_ibfk_1` FOREIGN KEY (`ID_offre`) REFERENCES `offre` (`ID_offre`),
  ADD CONSTRAINT `candidature_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`ID_user`);

--
-- Contraintes pour la table `integrer`
--
ALTER TABLE `integrer`
  ADD CONSTRAINT `integrer_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`ID_user`),
  ADD CONSTRAINT `integrer_ibfk_2` FOREIGN KEY (`Id_Promo`) REFERENCES `promotion` (`Id_Promo`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`ID_entreprise`) REFERENCES `entreprise` (`ID_entreprise`);

--
-- Contraintes pour la table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`ID_offre`) REFERENCES `offre` (`ID_offre`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `utilisateur` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
