-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 27 mars 2022 à 19:27
-- Version du serveur : 5.7.31
-- Version de PHP : 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `hebergeur`
--

DROP TABLE IF EXISTS `hebergeur`;
CREATE TABLE IF NOT EXISTS `hebergeur` (
  `hebergeur_id` int(11) NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) NOT NULL,
  `lieux_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`hebergeur_id`),
  KEY `publication_id` (`publication_id`),
  KEY `lieux_id` (`lieux_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hebergeur`
--

INSERT INTO `hebergeur` (`hebergeur_id`, `publication_id`, `lieux_id`, `date`, `time`) VALUES
(9, 25, 17, '2022-03-31', '23:35:14'),
(8, 25, 11, '2022-03-31', '10:23:30'),
(5, 36, 1, '2022-03-25', '09:10:00'),
(6, 36, 11, '2022-03-25', '10:20:00'),
(7, 36, 6, '2022-03-25', '20:20:00');

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

DROP TABLE IF EXISTS `lieux`;
CREATE TABLE IF NOT EXISTS `lieux` (
  `lieux_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `gps_lat` float(10,8) NOT NULL,
  `gps_long` float(10,8) NOT NULL,
  `ville` varchar(40) NOT NULL,
  `code_postale` varchar(5) NOT NULL,
  PRIMARY KEY (`lieux_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lieux`
--

INSERT INTO `lieux` (`lieux_id`, `nom`, `gps_lat`, `gps_long`, `ville`, `code_postale`) VALUES
(1, 'Marseille', 3.00235605, 3.00000000, 'Toulouse', '25000'),
(11, 'Place', 1.00000000, 34.00000000, 'Aix-en-provence', '13120'),
(6, 'Cathedrale', 4.00000000, -5.00000000, 'Rince', '70020'),
(25, 'azer', 1.22249997, 1.22255003, 'azeraezr', '12345'),
(26, 'sdfgsfg', 1.23000002, 1.23000002, 'sdfgsfdg', '12345'),
(17, 'Rue', 11.00000000, 12.00000000, 'St Etienne', '12345');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `fonction` varchar(40) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`membre_id`),
  KEY `organisation_id` (`organisation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`membre_id`, `organisation_id`, `nom`, `prenom`, `fonction`, `actif`) VALUES
(1, 1, 'Durand', 'Jean', 'TrÃ©sorerie', 1),
(2, 1, 'Martin', 'Elisa', 'Administration', 1),
(3, 1, 'Bernard', 'Thomas', 'PrÃ©sident', 1),
(4, 1, 'Dubois', 'Mathilde', 'Secretaire', 0),
(5, 1, 'Mathilde', 'Elisa', 'Animateur', 0),
(6, 1, 'dfgh', 'dfgh', 'dfgh', 0),
(7, 1, 'Hofstater', 'Leonard', 'TrÃ©sorier Adjoint', 0);

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

DROP TABLE IF EXISTS `organisation`;
CREATE TABLE IF NOT EXISTS `organisation` (
  `organisation_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `gps_lat` float(10,8) NOT NULL,
  `gps_long` float(10,8) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY (`organisation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `organisation`
--

INSERT INTO `organisation` (`organisation_id`, `nom`, `adresse`, `email`, `tel`, `gps_lat`, `gps_long`, `logo`) VALUES
(1, 'Club', '12 rue des tulipes Marseille 13012', 'club@gmail.com', '0712423226', 4.53082466, 43.62772751, '6218f5b9c8984.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `publication_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) NOT NULL,
  `date_publication` datetime NOT NULL,
  `date_event` date NOT NULL,
  `titre` varchar(100) NOT NULL,
  `sous_titre` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `illustration` varchar(100) NOT NULL,
  `type` set('actualite','evenement') NOT NULL,
  PRIMARY KEY (`publication_id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `publication`
--

INSERT INTO `publication` (`publication_id`, `utilisateur_id`, `date_publication`, `date_event`, `titre`, `sous_titre`, `text`, `illustration`, `type`) VALUES
(25, 3, '2022-02-23 00:00:00', '2022-02-28', 'Lorem ipsum dolor sit amet consectetur.', 'Lorem, ipsum dolor.', 'l        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum animi mollitia itaque possimus vero inventore vel ex odit excepturi aut cupiditate a nam tenetur ut suscipit dolor sit, minus perferendis! Molestiae nisi deleniti quibusdam aspernatur id ipsa enim velit aliquid. Eaque ad ex obcaecati commodi quae quo, ullam, a, nisi culpa perferendis voluptates expedita assumenda. Iure tenetur veniam placeat, minus debitis dolorem iusto vitae quia repellendus beatae deleniti nesciunt, saepe necessitatibus, eligendi eaque non sequi deserunt quaerat dignissimos omnis accusantium doloribus? Ad provident consectetur minus libero amet dolore mollitia ipsam laboriosam distinctio veniam? Nulla ut, modi laborum dolores impedit minima. Dolor nisi iusto incidunt fugit voluptate cum reprehenderit quaerat architecto voluptatum exercitationem amet expedita maiores aliquid earum, autem quos perferendis eaque voluptas dolorum assumenda voluptates a repellendus. Sapiente, quod ex sed aliquid repellat accusantium omnis doloremque, enim molestiae veritatis quisquam? Magnam rem atque debitis vero, nesciunt nam velit perspiciatis quam et earum a deleniti, nostrum odio fuga numquam pariatur itaque doloremque alias maiores vitae nihil? Laudantium aperiam hic earum possimus repudiandae voluptates minus reprehenderit delectus cupiditate beatae voluptatum iusto veniam saepe facere repellendus deserunt molestias, sit, esse est! Magnam rem nobis temporibus earum fugit est eius quo unde velit pariatur consectetur recusandae, voluptas laborum accusamus dicta voluptatibus id ex minus. Natus, ipsa! Similique praesentium culpa odit, fugiat voluptas necessitatibus tempore aliquam maxime consectetur. Deleniti ut corrupti porro fugit. Exercitationem quasi, ullam, eos autem maiores aspernatur placeat molestias delectus veniam obcaecati reprehenderit, explicabo inventore consequuntur! Incidunt ipsam laborum nisi placeat sed. Distinctio assumenda illum quam, quis impedit minus quod facere ad nostrum? Cupiditate magni voluptatum molestiae quam sunt eveniet quos excepturi nesciunt nemo minus provident omnis architecto, ratione ab. Amet dolore ut necessitatibus non. Ducimus tempore, quidem cupiditate accusantium eum pariatur fugiat dolorem illo atque impedit tempora id soluta nihil aliquam illum dolor, laboriosam praesentium? Doloribus eveniet in cum nemo. Voluptate tempora tenetur assumenda soluta atque veniam autem omnis placeat hic? Doloremque blanditiis nesciunt fugit dolor repellat sint cupiditate, hic excepturi dolorem quia! Consequuntur quis, suscipit porro nostrum saepe exercitationem sapiente sint adipisci deserunt quam explicabo reiciendis aspernatur quos! Magnam, illo? Nihil id ad soluta tempora?\r\n', '6215fb1b445f8.jpeg', 'evenement'),
(3, 3, '2022-02-18 00:00:00', '2022-02-24', '            Lorem ipsum dolor sit amet.', 'dolor sit amet', '            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Excepturi commodi consequuntur in corporis. Corporis doloribus ad similique aut odio culpa, debitis accusantium numquam architecto. Dolore, pariatur veniam. Quod doloribus, similique provident, delectus harum dolor alias saepe architecto nobis perspiciatis velit? Non doloremque aperiam tenetur beatae necessitatibus voluptatem. Neque debitis quod voluptas est expedita, aspernatur eligendi, totam dolorem nesciunt odio numquam?\r\n', '620f58b358170.jpg', 'evenement'),
(4, 2, '2022-02-16 00:00:00', '2022-02-24', 'Title', 'Du text', '                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur nulla neque quae officia itaque quidem similique quos omnis qui, provident fuga minima unde laboriosam porro sequi! Esse soluta nihil accusantium odio. Voluptates, autem. Praesentium ipsa necessitatibus mollitia distinctio obcaecati, ipsam, quaerat doloribus aperiam reprehenderit nobis repudiandae fuga quis molestiae possimus quod iure esse, consequuntur inventore reiciendis exercitationem quia voluptates quas.\r\n', '620f6eff48c1f.png', 'actualite'),
(5, 2, '2022-02-18 00:00:00', '2022-02-23', 'Title', 'Sous titre', '                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo minima praesentium et. Provident illum nulla quos porro nobis quibusdam, molestiae totam unde pariatur delectus officiis iste qui commodi cumque ipsa quisquam beatae, minus dignissimos inventore dolorem, in et? Deserunt quas perferendis, dolores architecto exercitationem nemo repellat! Aspernatur ipsum assumenda deserunt perferendis sapiente totam ullam! Eum hic at ullam sequi? Odio repellat velit eum in. Non blanditiis laborum itaque. Minima, fugit!\r\n', '620f6fb2c2221.jpg', 'actualite'),
(22, 2, '2022-02-23 00:00:00', '2022-02-25', 'Lorem ipsum dolor sit.', 'Lorem ipsum dolor sit amet consectetur.', '    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Necessitatibus impedit pariatur nemo aspernatur, porro assumenda, neque itaque mollitia hic corrupti eum ad unde. Facilis reiciendis nemo vero totam, natus ratione ducimus commodi, optio quibusdam id dicta, officiis doloremque harum recusandae eum? Voluptatibus consequuntur voluptas minus aliquam! Laboriosam voluptate facere sit? Debitis repudiandae possimus incidunt sint ipsam consectetur itaque natus inventore quis, similique ex! Quo, molestiae? Quae itaque eos architecto magni excepturi molestias deleniti. Deserunt nihil unde, dignissimos molestias eum natus ex dolores similique non, assumenda impedit. Explicabo odit iure pariatur, quod at accusamus quae possimus quibusdam vitae, corrupti excepturi illum itaque fugit expedita reiciendis neque aperiam adipisci ratione rem sed a aliquid reprehenderit! Expedita consequuntur culpa eaque. Iste pariatur ratione officiis tenetur nesciunt totam necessitatibus quae eius culpa, dolor nemo soluta ab sed! Perspiciatis ducimus similique culpa saepe? Eligendi vero quas non distinctio, nesciunt cumque error maxime debitis possimus amet perferendis velit magnam cupiditate eum, exercitationem culpa rem deserunt quibusdam asperiores! Ipsam doloribus consectetur assumenda eaque quis sunt provident maiores possimus saepe? Rerum, consequatur praesentium?\r\n', '6215f0df0566c.png', 'actualite'),
(24, 2, '2022-02-23 00:00:00', '2022-02-25', '    Lorem ipsum dolor sit amet consectetur.', '    Lorem, ipsum dolor.', '    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem mollitia ratione itaque sed ullam ut nam ad amet impedit odit reiciendis numquam quibusdam laboriosam eos omnis vero voluptatum, magnam soluta similique esse pariatur, rerum illo doloribus! Incidunt in rerum voluptatum, aspernatur quaerat magnam deserunt laboriosam molestiae! Neque debitis accusamus tempore necessitatibus recusandae. Pariatur consequuntur illo quidem deserunt dicta esse placeat mollitia alias animi suscipit dolorem, sint eius voluptas iusto id aliquid odit velit. Earum culpa quidem, voluptatem, quibusdam pariatur eveniet eius error beatae necessitatibus neque eum fugit impedit laborum voluptates vero inventore nesciunt repellendus alias nulla repudiandae ipsam sequi repellat voluptatibus facere. Rerum at amet, dolor enim quod vel exercitationem aliquam magnam expedita eius inventore temporibus voluptas deleniti accusantium similique consequuntur nihil labore. Possimus eum aspernatur sunt eveniet tempora asperiores expedita nostrum facilis obcaecati, perspiciatis non quod quae dicta culpa quo harum ipsum deleniti! Animi alias totam porro eius quam accusamus minima recusandae quisquam voluptatum autem pariatur dicta excepturi voluptates laboriosam culpa velit inventore, nihil, nesciunt sit. Libero deleniti rem nostrum itaque dolor! Atque mollitia, laudantium necessitatibus labore id accusantium temporibus optio repellat dignissimos at molestias nisi vitae sed nobis nesciunt ipsum. Velit modi dolore quis similique ullam necessitatibus eius neque asperiores officiis et doloremque, officia tempora. Et magni soluta repellendus ratione, totam odit minima, voluptas dolorum itaque libero dolores sapiente accusantium odio debitis, nesciunt atque voluptatibus corporis sunt. Impedit maiores facilis dicta vitae perspiciatis natus quos nesciunt sapiente quasi ipsa eos reiciendis a cum, aspernatur expedita odit ducimus doloribus fugiat. Debitis perspiciatis voluptate tempora sunt.\r\n', '6215f7a5be763.jpg', 'actualite'),
(30, 2, '2022-03-10 18:39:33', '2022-03-24', 'sfgsfdg', 'sdfgsfgsdfg', 'sfdgsfdgsdfgsfdgs', '622a37d59a1dd.jpg', 'actualite'),
(31, 3, '2022-03-10 21:05:50', '2022-03-15', 'sdf', 'sfd', 'sdfgsfdg', '622a5a1e2c58e.jpg', 'evenement'),
(32, 3, '2022-03-10 21:07:02', '2022-03-24', 'fgh', 'dfgh', 'dgfhdghdghdghdfgh', '622a5a66c8442.jpg', 'evenement'),
(33, 3, '2022-03-10 21:07:58', '2022-03-16', 'sdfgsfg', 'sdfgsfg', 'sdfgsfgsfdgsdfg', '622a5a9e2f75c.jpg', 'evenement'),
(34, 3, '2022-03-10 21:15:06', '2022-03-23', 'zregqdsfgqsdfgsfdg', 'sdfgsfgsfdgsdfgsdfg', 'sdfgsdfgsfdgsfdg', '622a5c4a04f98.jpg', 'evenement'),
(35, 3, '2022-03-10 21:16:19', '2022-03-24', 'dsfgsfdg', 'sfdgsdfg', 'sfdgsfgsdfgsdfg', '622a5c93e9856.jpg', 'evenement'),
(36, 3, '2022-03-10 21:19:41', '2022-03-17', 'titre', 'sous titre', 'tziorngoinergon onrgnnzregbzrgzertg', '622a5d5d0b9da.jpg', 'evenement'),
(27, 3, '2022-02-24 00:00:00', '2022-03-10', '    Lorem, ipsum dolor.', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis, asperiores.', '    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere placeat voluptatibus ullam architecto eligendi. Architecto et voluptates iste illum sint necessitatibus nemo dolore, numquam soluta perspiciatis officiis id fuga sunt officia! Dolor tempore excepturi distinctio laborum eius possimus nihil totam, dignissimos architecto quasi est rerum molestiae amet, atque non vitae eaque nulla dolore veritatis delectus? Natus mollitia dolorum error earum, quis, dolores vel labore alias harum tempore libero soluta ipsum recusandae in voluptate odit pariatur ratione nobis incidunt enim corporis. Accusantium sunt iusto, obcaecati asperiores ex reprehenderit ea soluta. Enim inventore quod dolore dolores provident ducimus numquam laboriosam architecto velit doloremque, reprehenderit cum laborum alias amet quidem maxime dolor omnis error debitis dicta minima accusamus excepturi asperiores. Error repellat quasi nulla, dolores eaque repellendus provident numquam aut dignissimos voluptatem odio. Asperiores quisquam cupiditate assumenda quo. Distinctio fugiat id consequuntur ullam accusantium nihil doloribus dolore dolor dolorem deleniti obcaecati consectetur, itaque magnam repellendus nulla earum veniam dolores modi? Nemo molestiae suscipit, ducimus iure, nobis fuga quisquam adipisci veritatis fugiat vel, eveniet ipsum dignissimos. Dolorem et odit, fuga cupiditate inventore reprehenderit nesciunt labore facere corrupti iure fugiat sunt excepturi nisi perferendis harum? Tenetur voluptatum, blanditiis error labore libero quidem harum corrupti, consectetur similique placeat consequatur quas doloremque fugit, quo cupiditate. Eum deserunt voluptatibus minima fuga ipsum commodi, nulla vero repudiandae, necessitatibus maiores adipisci suscipit ducimus nam nemo. Sit, excepturi vitae saepe quisquam libero nam doloremque culpa illo tempora delectus quo reiciendis nostrum impedit illum dolores porro corporis facere sunt dolor. Mollitia harum, odit voluptatem, voluptatibus veritatis minima quae rem esse optio deserunt, pariatur quo suscipit officiis est. Dicta dolor eligendi mollitia repellat accusantium libero cum eveniet nemo repellendus est neque commodi architecto, doloremque ipsa quia necessitatibus delectus nobis corporis! Facilis in eveniet asperiores mollitia debitis molestias voluptates illum voluptatem eum soluta non, possimus aut ea culpa harum delectus rem a? Nihil, placeat.\r\n', '6217b220d0939.jpg', 'evenement');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` set('admin','redacteur-evenement','redacteur-actualite','user') NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `tokenPassword` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `photo_identite` varchar(255) DEFAULT NULL,
  `adhesion` set('null','demande','accepter','refuser') NOT NULL DEFAULT 'null',
  PRIMARY KEY (`utilisateur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateur_id`, `nom`, `prenom`, `email`, `password`, `type`, `actif`, `token`, `tokenPassword`, `date_naissance`, `adresse`, `photo_identite`, `adhesion`) VALUES
(1, 'Doe', 'Jhon', 'admin@gmail.com', '$2y$10$khMaLox4o4lw6q1AmCZ0vee.Ufl0fhdjT1bM4bJPl12kzWyp.JIw2', 'user', 1, '0', '0', '2022-03-31', '16 rue sa marche pas vraiment', '6238582b65014.jpg', 'accepter'),
(2, 'Smith', 'Michael', 'redacteur1a@gmail.com', '$2y$10$8IlJk3WIC3nQ.zbLIGiSFeuojgQnjnBIq4ikl9RLXetwpwvU3Dyhm', 'redacteur-actualite', 1, '0', '0', NULL, NULL, NULL, ''),
(3, 'Durand', 'Sylvain', 'redacteur1e@gmail.com', '$2y$10$wyncni0xVRw6sTFA7jh71eLXD9pwo9X/uNwOrKU3PkHcPUjqnagza', 'redacteur-evenement', 1, '0', '0', NULL, NULL, NULL, ''),
(6, 'qsdfqdf', 'qdfsqdsf', 'qsd@qsdf.qd', 'qdsfqsdf', 'user', 1, NULL, NULL, '2022-03-16', 'qdsfqdfqdf', 'qdfqdfqdf', 'accepter'),
(7, 'fgf', 'fgf', 'q@q.fr', '$2y$10$9IKCBTI.X3xeGllxSBNZ8e3ceoiYn5a/8TGcOY12iFYtMdA2zf8Gm', 'user', 0, '77c8fbb285a9d49570cd06bf14861c93', NULL, NULL, NULL, NULL, 'null');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
