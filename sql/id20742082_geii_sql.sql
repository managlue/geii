-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 juin 2023 à 18:57
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id20742082_geii.sql`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`) VALUES
(1, '1ère année'),
(2, '2ème année');

-- --------------------------------------------------------

--
-- Structure de la table `classe_matiere`
--

DROP TABLE IF EXISTS `classe_matiere`;
CREATE TABLE IF NOT EXISTS `classe_matiere` (
  `id_classe` int NOT NULL,
  `id_matiere` int NOT NULL,
  PRIMARY KEY (`id_classe`,`id_matiere`),
  KEY `id_matiere` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `classe_matiere`
--

INSERT INTO `classe_matiere` (`id_classe`, `id_matiere`) VALUES
(2, 1),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `emploi_du_temps`
--

DROP TABLE IF EXISTS `emploi_du_temps`;
CREATE TABLE IF NOT EXISTS `emploi_du_temps` (
  `id_edt` int NOT NULL AUTO_INCREMENT,
  `jour` date DEFAULT NULL,
  `heure_debut` varchar(6) DEFAULT NULL,
  `heure_fin` varchar(6) DEFAULT NULL,
  `salle` varchar(10) DEFAULT NULL,
  `id_enseignant` int DEFAULT NULL,
  `id_matiere` int DEFAULT NULL,
  `id_classe` int DEFAULT NULL,
  PRIMARY KEY (`id_edt`),
  KEY `id_enseignant` (`id_enseignant`),
  KEY `id_matiere` (`id_matiere`),
  KEY `id_classe` (`id_classe`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `emploi_du_temps`
--

INSERT INTO `emploi_du_temps` (`id_edt`, `jour`, `heure_debut`, `heure_fin`, `salle`, `id_enseignant`, `id_matiere`, `id_classe`) VALUES
(1, '2023-06-06', '9h', '13h', 'D206', 1, 1, 1),
(2, '2023-06-06', '14h', '18h', 'D206', 2, 2, 1),
(3, '2023-06-07', '9h', '13h', 'D206', 1, 1, 1),
(4, '2023-06-07', '14h', '18h', 'D206', 2, 2, 1),
(5, '2023-06-08', '8h', '12h', 'D206', 1, 3, 1),
(6, '2023-06-08', '13h', '15h', 'D206', 1, 5, 1),
(7, '2023-06-08', '15h', '17h', 'D206', 1, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id_enseignant` int NOT NULL AUTO_INCREMENT,
  `nom_enseignant` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_enseignant` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `login_enseignant` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pswd_enseignant` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_classe` int DEFAULT NULL,
  PRIMARY KEY (`id_enseignant`),
  KEY `id_classe` (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id_enseignant`, `nom_enseignant`, `prenom_enseignant`, `login_enseignant`, `pswd_enseignant`, `id_classe`) VALUES
(1, 'Aboukikane', 'Alain', 'Alain', 'Alain', 1),
(2, 'Bourgeois', 'Corentin', 'coco', 'coco', 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_classe`
--

DROP TABLE IF EXISTS `enseignant_classe`;
CREATE TABLE IF NOT EXISTS `enseignant_classe` (
  `id_enseignant` int NOT NULL,
  `id_classe` int NOT NULL,
  PRIMARY KEY (`id_enseignant`,`id_classe`),
  KEY `id_classe` (`id_classe`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enseignant_classe`
--

INSERT INTO `enseignant_classe` (`id_enseignant`, `id_classe`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_matiere`
--

DROP TABLE IF EXISTS `enseignant_matiere`;
CREATE TABLE IF NOT EXISTS `enseignant_matiere` (
  `id_enseignant` int NOT NULL,
  `id_matiere` int NOT NULL,
  PRIMARY KEY (`id_enseignant`,`id_matiere`),
  KEY `id_matiere` (`id_matiere`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `enseignant_matiere`
--

INSERT INTO `enseignant_matiere` (`id_enseignant`, `id_matiere`) VALUES
(1, 1),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tel_entreprise` bigint DEFAULT NULL,
  `mail_entreprise` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pswd_entreprise` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom_entreprise`, `tel_entreprise`, `mail_entreprise`, `pswd_entreprise`) VALUES
(22, 'Carrefour', 601020304, 'carrefour@gmail.com', '$2y$10$Vl9ao7obCLDmlzPrDKNN0unkZp0za20exvNjWm4.QSRyZ2w86p2uO'),
(23, 'Akadium', 102020202, 'akadium91@gmail.com', '$2y$10$WLdmpCJ9K5cyzDdG9oVuIOQZ6ExpgH6oAnndd6Aeq/npEehucKFu2'),
(24, 'Akadium', 102020202, 'akadium91@gmail.com', '$2y$10$/Y3wvsiB0lXepOBFLy9xM.kATx0JcKAIwdpT/qftojE38nSYCK9nq'),
(25, 'Carrefour', 102030405, 'carrefour@gmail.com', '$2y$10$gNHIHHqGn2PD80hvmq.eZOgHvmznT3VIwItK8A1rwmsYD8bgGzYya'),
(26, 'Akadium', 102030405, 'akadium91@gmail.com', '$2y$10$TQyCloGcSdA7iAM69mQF3eCMgOkkqNIcetNpX3uy2igTxTCCVSLsu'),
(27, 'Carrefour', 102020304, 'carrefour@gmail.com', '$2y$10$LpE05gld4.pRc7yrvZz4.u3tS.v25wXWDP.Q09pIc0B6JVD8uxtVS'),
(28, 'Safran', 601020304, 'safran91@gmail.com', '$2y$10$geFiLkKzg2meBde/NTq0YOT5yJri4D6IhTNzV6HNh0E.khlyqn4wW'),
(31, 'Thales', 203040506, 'moussisidahmed0@gmail.com', '$2y$10$QlyU9lMj6Ux8BN0G.zdL8OdJtRrAKuKglmeHBkyBhLSNvxhb4XJGa');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id_etudiant` int NOT NULL AUTO_INCREMENT,
  `nom_etudiant` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom_etudiant` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `login_etudiant` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pswd_etudiant` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_classe` int DEFAULT NULL,
  `moyenne` float DEFAULT NULL,
  PRIMARY KEY (`id_etudiant`),
  KEY `id_classe` (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `login_etudiant`, `pswd_etudiant`, `id_classe`, `moyenne`) VALUES
(7, 'Bourgeois', 'Corentin', 'cbo', 'AzertY12', 2, NULL),
(8, 'Crotti-Hem', 'Marco', 'mcr', 'QsdfgH34', 1, 14.57),
(9, 'Moussi', 'Sid-Ahmed', 'smoussi', 'password', 1, 14.43),
(10, 'Dupont', 'Vanessa', 'vdupont', 'password', 2, NULL),
(11, 'Martin', 'Enzo', 'emartin', 'password', 1, 12.14),
(12, 'Durand', 'Sami', 'sdurand', 'password', 2, NULL),
(13, 'Petit', 'Lucie', 'lpetit', 'password', 1, 14.57),
(14, 'Moreau', 'Isabelle', 'imoreau', 'password', 2, NULL),
(15, 'Lefebvre', 'Jacques', 'jlefebvre', 'password', 1, 11.86),
(16, 'Fournier', 'Nathalie', 'nfournier', 'password', 2, NULL),
(17, 'Girard', 'François', 'fgirard', 'password', 1, 13),
(18, 'Lambert', 'Catherine', 'clambert', 'password', 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id_matiere` int NOT NULL AUTO_INCREMENT,
  `nom_matiere` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `couleur` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_matiere`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id_matiere`, `nom_matiere`, `couleur`) VALUES
(1, 'Energie', 'sky'),
(2, 'Système d\'information num', 'green'),
(3, 'Informatique', 'yellow'),
(4, 'Systèmes électroniques', 'orange'),
(5, 'Outils logiciels', 'purple'),
(6, 'Réalisation d\'ensembles p', 'red');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id_note` int NOT NULL AUTO_INCREMENT,
  `note` float NOT NULL,
  `intitule` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `coefficient` int NOT NULL DEFAULT '1',
  `commentaire` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `id_etudiant` int DEFAULT NULL,
  `id_matiere` int DEFAULT NULL,
  `id_enseignant` int DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id_note`),
  KEY `id_etudiant` (`id_etudiant`),
  KEY `id_matiere` (`id_matiere`),
  KEY `id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=365 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id_note`, `note`, `intitule`, `coefficient`, `commentaire`, `id_etudiant`, `id_matiere`, `id_enseignant`, `date`) VALUES
(254, 11, 'QCM', 1, 'Lacunes en PHP, mais réussite en Pokemons', 7, 3, 1, '2023-06-10'),
(271, 13, 'QCM', 1, 'ras', 8, 1, 1, '2023-06-10'),
(272, 17, 'QCM', 1, 'ras', 9, 1, 1, '2023-06-10'),
(273, 8, 'QCM', 1, 'à revoir', 11, 1, 1, '2023-06-10'),
(274, 14, 'QCM', 1, 'ras', 13, 1, 1, '2023-06-10'),
(275, 12, 'QCM', 1, 'ras', 15, 1, 1, '2023-06-10'),
(276, 15, 'QCM', 1, 'ras', 17, 1, 1, '2023-06-10'),
(277, 16, 'Projets de fin d\'étude', 4, 'ras', 8, 1, 1, '2023-06-10'),
(278, 14, 'Projets de fin d\'étude', 4, 'ras', 9, 1, 1, '2023-06-10'),
(279, 12, 'Projets de fin d\'étude', 4, 'ras', 11, 1, 1, '2023-06-10'),
(280, 16, 'Projets de fin d\'étude', 4, 'ras', 13, 1, 1, '2023-06-10'),
(281, 12, 'Projets de fin d\'étude', 4, 'ras', 15, 1, 1, '2023-06-10'),
(282, 12, 'Projets de fin d\'étude', 4, 'ras', 17, 1, 1, '2023-06-10'),
(283, 8, 'GG', 1, 'auchan', 8, 1, 1, '2023-06-10'),
(284, 11, 'GG', 1, 'auchan', 9, 1, 1, '2023-06-10'),
(285, 12, 'GG', 1, 'auchan', 11, 1, 1, '2023-06-10'),
(286, 7, 'GG', 1, 'auchan', 13, 1, 1, '2023-06-10'),
(287, 6, 'GG', 1, 'auchan', 15, 1, 1, '2023-06-10'),
(288, 11, 'GG', 1, 'auchan', 17, 1, 1, '2023-06-10'),
(289, 17, 'bienvenue', 1, 'v', 8, 1, 1, '2023-06-07'),
(290, 17, 'bienvenue', 1, 'a', 9, 1, 1, '2023-06-07'),
(291, 17, 'bienvenue', 1, 'a', 11, 1, 1, '2023-06-07'),
(292, 17, 'bienvenue', 1, 'a', 13, 1, 1, '2023-06-07'),
(293, 17, 'bienvenue', 1, 'a', 15, 1, 1, '2023-06-07'),
(294, 17, 'bienvenue', 1, 'a', 17, 1, 1, '2023-06-07');

-- --------------------------------------------------------

--
-- Structure de la table `offre_alternance`
--

DROP TABLE IF EXISTS `offre_alternance`;
CREATE TABLE IF NOT EXISTS `offre_alternance` (
  `id_offre` int NOT NULL AUTO_INCREMENT,
  `titre_offre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lieu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `contrat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_limite` date NOT NULL,
  `sujet_offre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_entreprise` int NOT NULL,
  `competences` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remuneration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `postuler` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_entr` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id_offre`),
  KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `offre_alternance`
--

INSERT INTO `offre_alternance` (`id_offre`, `titre_offre`, `lieu`, `contrat`, `date_limite`, `sujet_offre`, `id_entreprise`, `competences`, `remuneration`, `postuler`, `date_ajout`, `image`, `description_entr`) VALUES
(7, 'Développeur Web', 'Evry-Courcouronnes', 'Alternance', '2023-06-02', 'développement', 22, 'PHP JS', '2500€', 'Sur le site internet', '2023-05-27 14:25:38', '', NULL),
(12, 'Développeur Web', 'Evry-Courcouronnes', 'Alternance', '2023-06-25', 'Développer', 22, 'PHP JS', '2500€', 'Sur le site d\'entreprise\r\n', '2023-06-01 23:33:12', 'carrefour.jpg', 'Vous cherchez à acquérir des compétences d’aujourd’hui et un métier qui a de l’avenir en alternance?\r\n\r\nNotre mission ? Rendre l’éducation accessible à tous !\r\n\r\nL’alternance avec OpenClassrooms, c’est apprendre un métier avec une formation mêlant 20 % de théorie et 80 % de pratique, pour être 100 % prêt à l’emploi ! Grâce à nos équipes, qui épaulent chaque profil dans la recherche d’un employeur, nous affichons un taux d’insertion de nos étudiants de plus de 80 % en entreprise !\r\n\r\nNotre école en ligne propose des centaines de formations sur des métiers du numérique, 100 % en ligne, avec un diplôme reconnu par l\'État à la clé. Apprendre avec OpenClassrooms, c’est aussi rejoindre une communauté internationale de plus de 12 000 étudiants actifs et motivés, dans 72 pays.'),
(14, 'Développeur Web', 'Evry-Courcouronnes', 'Alternance', '2023-06-08', 'Développer activité', 26, 'PHP JS', '2500€', 'Sur le site de l\'entreprise', '2023-06-05 09:48:23', 'carrefour.jpg', 'Akadium est une entreprise'),
(15, 'Opérateur soudage', 'Paris', 'Alternance', '2023-06-25', 'Opérateur soudage', 28, 'Ingénieur', '2500€', 'Sur le site ', '2023-06-05 15:22:42', 'logo-Safran.jpg', 'Safran est une entreprise française spécialisée dans les hautes technologies de l\'aérospatiale, de la défense et de la sécurité. Fondée en 2005 suite à la fusion entre SNECMA et SAGEM, Safran est devenue un leader mondial dans son domaine.\r\n\r\nSafran opère dans plusieurs secteurs d\'activité, notamment les moteurs d\'avions et d\'hélicoptères, les systèmes de propulsion spatiale, les équipements aéronautiques, les systèmes de défense, les systèmes de sécurité, les systèmes de navigation et les solutions de sécurité biométrique.'),
(21, 'Devops Junior F/H', 'Evry-Courcouronnes', 'Alternance', '2023-06-25', 'En rejoignant Thales Analytics and IoT Solutions vous travaillerez en étroite collaboration avec l\'équipe d\'ingénierie (Product Owner, Scrum Master, autres développeurs et ingénieurs d\'intégration) en mode Agile (Scrum) pour recueillir les besoins, concevoir, développer et mettre en œuvre des solutions logicielles et systèmes intégrés dans les domaines de la cybersécurité.', 31, 'Une expérience avec des bases de données relationnelles, d\'intégration de systèmes client-serveur, de développement de services Web (REST-API) serait un plus.\r\nVous parlez couramment anglais et avez de bonnes capacités de communication orales et écrites ?\r\n\r\nVous êtes motivé par les résultats et l\'innovation, doté d\'une bonne communication et de compétences interpersonnelles ?\r\n\r\nVous êtes autonome et aimez collaborer et évoluer dans une équipe ?\r\nVous vous reconnaissez ? Parlons des missions maintenant !', '1500 €', 'Sur le site de l\'entreprise', '2023-06-08 09:30:39', 'thales.jpg', 'Chez Thales, nous sommes fiers de travailler ensemble pour imaginer des solutions innovantes qui contribuent à construire un avenir plus sûr, plus vert et plus inclusif. Un avenir de confiance. Mais ces technologies ne viennent pas de nulle part.');

-- --------------------------------------------------------

--
-- Structure de la table `projet_tut`
--

DROP TABLE IF EXISTS `projet_tut`;
CREATE TABLE IF NOT EXISTS `projet_tut` (
  `id_projet_tut` int NOT NULL AUTO_INCREMENT,
  `titre_projet_tut` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sujet_projet_tut` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_entreprise` int NOT NULL,
  `image_projet_tut` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `pdf_projet_tut` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `datedebut_projet_tut` date DEFAULT NULL,
  `datefin_projet_tut` date DEFAULT NULL,
  `dateajout_projet_tut` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_projet_tut`),
  KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `projet_tut`
--

INSERT INTO `projet_tut` (`id_projet_tut`, `titre_projet_tut`, `sujet_projet_tut`, `id_entreprise`, `image_projet_tut`, `pdf_projet_tut`, `datedebut_projet_tut`, `datefin_projet_tut`, `dateajout_projet_tut`) VALUES
(26, 'Réalisation d’un gyropode.', 'La réalisation d\'un gyropode est un processus complexe qui combine des compétences en mécanique, en électronique et en programmation. Le gyropode, également connu sous le nom de Segway, est un véhicule électrique à deux roues qui utilise des capteurs gyroscopiques pour maintenir son équilibre.', 31, 'thales.jpg', 'Projets-UEVE-Programmation-2023 (3).pdf', '2023-06-28', '2023-07-07', '2023-06-08 10:04:54');

-- --------------------------------------------------------

--
-- Structure de la table `support_de_cours`
--

DROP TABLE IF EXISTS `support_de_cours`;
CREATE TABLE IF NOT EXISTS `support_de_cours` (
  `id_support` int NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id_matiere` int DEFAULT NULL,
  `id_enseignant` int DEFAULT NULL,
  PRIMARY KEY (`id_support`),
  KEY `id_matiere` (`id_matiere`),
  KEY `id_enseignant` (`id_enseignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe_matiere`
--
ALTER TABLE `classe_matiere`
  ADD CONSTRAINT `Classe_Matiere_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `Classe_Matiere_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`);

--
-- Contraintes pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `Enseignant_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id_classe`);

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `Note_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id_etudiant`),
  ADD CONSTRAINT `Note_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id_matiere`),
  ADD CONSTRAINT `Note_ibfk_3` FOREIGN KEY (`id_enseignant`) REFERENCES `enseignant` (`id_enseignant`);

--
-- Contraintes pour la table `offre_alternance`
--
ALTER TABLE `offre_alternance`
  ADD CONSTRAINT `Offre_Alternance_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
