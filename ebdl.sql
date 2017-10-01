-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: sid-sql
-- Generation Time: Feb 21, 2013 at 04:57 PM
-- Server version: 5.1.66-log
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `danielpa_ebdl`
--

-- --------------------------------------------------------

--
-- Table structure for table `accept`
--

CREATE TABLE IF NOT EXISTS `accept` (
  `id_accept` int(11) NOT NULL,
  `etat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_accept`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accept`
--

INSERT INTO `accept` (`id_accept`, `etat`) VALUES
(34, '1'),
(33, '0'),
(32, '0'),
(31, '0'),
(30, '1'),
(35, '0'),
(36, '1'),
(37, '1'),
(38, '1'),
(39, '1'),
(40, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ami_de`
--

CREATE TABLE IF NOT EXISTS `ami_de` (
  `id_accept` int(11) NOT NULL AUTO_INCREMENT,
  `id_demandeur` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_accept`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `ami_de`
--

INSERT INTO `ami_de` (`id_accept`, `id_demandeur`, `id_user`) VALUES
(37, 1, 3),
(36, 4, 1),
(35, 1, 13),
(34, 1, 2),
(38, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_del`
--

CREATE TABLE IF NOT EXISTS `conversation_del` (
  `id_conversation` int(11) NOT NULL,
  `user1` int(11) NOT NULL DEFAULT '0',
  `user1_del` int(11) NOT NULL DEFAULT '0',
  `user2` int(11) NOT NULL DEFAULT '0',
  `user2_del` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conversation_del`
--

INSERT INTO `conversation_del` (`id_conversation`, `user1`, `user1_del`, `user2`, `user2_del`) VALUES
(99, 1, 1, 3, 1),
(100, 1, 1, 3, 1),
(102, 1, 1, 3, 1),
(105, 3, 0, 1, 1),
(126, 2, 1, 1, 1),
(133, 1, 1, 2, 0),
(156, 2, 0, 1, 1),
(159, 3, 0, 1, 1),
(160, 3, 0, 1, 1),
(161, 1, 0, 2, 0),
(166, 2, 0, 3, 0),
(168, 1, 0, 3, 0),
(169, 1, 1, 2, 1),
(173, 1, 1, 2, 1),
(188, 2, 1, 1, 1),
(191, 2, 1, 1, 1),
(193, 1, 1, 2, 1),
(197, 1, 1, 4, 0),
(226, 1, 0, 2, 0),
(233, 1, 0, 2, 0),
(234, 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fluxrss`
--

CREATE TABLE IF NOT EXISTS `fluxrss` (
  `id_rss` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `URL` varchar(200) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'clé étrangere utilisateur',
  `favori` int(11) NOT NULL,
  PRIMARY KEY (`id_rss`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `fluxrss`
--

INSERT INTO `fluxrss` (`id_rss`, `nom`, `URL`, `id_user`, `favori`) VALUES
(1, 'Korben', 'http://feeds2.feedburner.com/KorbensBlog-UpgradeYourMind', 1, 1),
(2, 'Le Monde', 'http://rss.lemonde.fr/c/205/f/3050/index.rss', 1, 0),
(3, 'Le journal du Geek', 'http://feeds2.feedburner.com/LeJournalduGeek', 1, 0),
(4, 'Le Monde', 'http://rss.lemonde.fr/c/205/f/3050/index.rss', 2, 0),
(5, 'Le Monde', 'http://rss.lemonde.fr/c/205/f/3050/index.rss', 3, 1),
(6, 'Korben', 'http://feeds2.feedburner.com/KorbensBlog-UpgradeYourMind', 3, 0),
(7, 'Korben', 'http://feeds2.feedburner.com/KorbensBlog-UpgradeYourMind', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_categorie`
--

CREATE TABLE IF NOT EXISTS `forum_categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `forum_categorie`
--

INSERT INTO `forum_categorie` (`id_categorie`, `nom`) VALUES
(1, 'BTS SIO 2012'),
(2, 'Jeux Video'),
(3, 'Evenements/Sorties');

-- --------------------------------------------------------

--
-- Table structure for table `forum_message`
--

CREATE TABLE IF NOT EXISTS `forum_message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  `id_topic` int(11) NOT NULL COMMENT 'clé étrangere forum_topic',
  PRIMARY KEY (`id_message`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `forum_message`
--

INSERT INTO `forum_message` (`id_message`, `auteur`, `message`, `date`, `id_topic`) VALUES
(164, 2, ':?php echo ''hack'': ?: by daniel', 1361462129, 16),
(163, 2, 'm***e', 1361462108, 16),
(162, 2, 'â™¥', 1361462103, 16),
(161, 2, 'test msg :)', 1361462096, 16),
(160, 2, 'ergthgfh', 1361462068, 16);

-- --------------------------------------------------------

--
-- Table structure for table `forum_sujet`
--

CREATE TABLE IF NOT EXISTS `forum_sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_sujet`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `forum_sujet`
--

INSERT INTO `forum_sujet` (`id_sujet`, `id_cat`, `auteur`, `titre`) VALUES
(28, 3, 1, 'Vacances'),
(27, 3, 1, 'Anniversaires'),
(26, 2, 1, 'Black Ops 2'),
(25, 1, 1, 'PPE''s');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `id_sujet` int(11) NOT NULL,
  `auteur` int(11) NOT NULL,
  `description` varchar(3000) NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `forum_topic`
--

INSERT INTO `forum_topic` (`id_topic`, `id_sujet`, `auteur`, `description`) VALUES
(1, 18, 1, 'Pour un gros test'),
(4, 22, 1, 'Test de crÃ©ation d''un topic dans diablo3'),
(5, 20, 1, 'SoirÃ©e du 17/01'),
(11, 20, 1, 'Test'),
(12, 18, 1, 'T''est'),
(13, 18, 1, 'CrÃ©er un topic c''est super simple :)'),
(14, 18, 1, 'Ret'),
(15, 18, 2, 'TEST'),
(16, 25, 2, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `id_mp` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `date_post` int(50) NOT NULL,
  `lu` int(11) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'clé étrangere ',
  `id_destinataire` int(11) NOT NULL,
  `objet` varchar(1000) NOT NULL,
  `conversation` int(11) NOT NULL,
  PRIMARY KEY (`id_mp`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=238 ;

--
-- Dumping data for table `messagerie`
--

INSERT INTO `messagerie` (`id_mp`, `message`, `date_post`, `lu`, `id_user`, `id_destinataire`, `objet`, `conversation`) VALUES
(162, 'Tu t\\''en sort? :)', 1354802923, 1, 1, 2, 'Suivi programmation forum', 161),
(161, 'Besoin d''aide? ici\r\n', 1354802460, 1, 1, 2, 'Suivi programmation forum', 161),
(163, 'hey la je met juste mes pages sur le site ', 1354803339, 1, 2, 1, 'Suivi programmation forum', 161),
(164, 'Il est pas bon le sous-menu de tes pages', 1354805016, 1, 1, 2, 'Suivi programmation forum', 161),
(165, 'oui je sais mais je sai pas quoi mettre', 1354805720, 1, 2, 1, 'Suivi programmation forum', 161),
(166, 'Hey sa va ? t''as vu mon forum? ', 1354806658, 1, 2, 3, 'PPE', 166),
(167, 'Coucou! Ã§a marche pas :-/', 1354807156, 1, 3, 2, 'PPE', 166),
(171, 'ben tu met tes pages', 1354809802, 1, 1, 2, 'Suivi programmation forum', 161),
(172, 'Host: 78.229.22.162 <br />\r\nUser: ebdl <br />\r\nPassword: 0000', 1354870825, 1, 1, 3, 'Identifiants FTP', 168),
(193, 'sdfsdf', 1356965460, 1, 1, 2, 'dsfsd', 193),
(194, 'Ta vu un peu le forum mtn ?<br />\r\n', 1357659921, 1, 1, 2, 'Suivi programmation forum', 161),
(198, 'c\\''est joli!!!', 1357660225, 1, 2, 1, 'Suivi programmation forum', 161),
(199, 'Mais ya pas le nom de ceux qui rÃ©ponde sur le forum', 1357660408, 1, 2, 1, 'Suivi programmation forum', 161),
(200, 'manque l\\''affichage des messages', 1357660418, 1, 1, 2, 'Suivi programmation forum', 161),
(201, 'oui voila il manque faire le design de  cette page', 1357660441, 1, 1, 2, 'Suivi programmation forum', 161),
(202, 'sa bosse mdr?', 1357661522, 1, 1, 2, 'Suivi programmation forum', 161),
(203, '?', 1357661610, 1, 1, 2, 'Suivi programmation forum', 161),
(205, ':)', 1357661849, 1, 1, 3, 'Identifiants FTP', 168),
(209, 'Host: 172.16.1.26<br />\r\nUser: ebdl <br />\r\nPassword: 0000', 1358427674, 1, 1, 3, 'Identifiants FTP', 168),
(208, 'Bonjour,<br />\r\nTu fou rien !<br />\r\nmerci.', 1358427177, 1, 1, 3, 'Identifiants FTP', 168),
(210, 'c\\''est quoi le id et mdp pour la base de donnÃ©es stp? ', 1358430210, 1, 2, 1, 'Suivi programmation forum', 161),
(211, 'root<br />\r\nebdlroot', 1358434794, 1, 1, 2, 'Suivi programmation forum', 161),
(212, ' root<br />\r\nebdlroot', 1358434809, 1, 1, 2, 'Suivi programmation forum', 161),
(213, 'm***e', 1359641705, 1, 1, 2, 'Suivi programmation forum', 161),
(214, ':?php echo \\''ok\\'': ?:<br />\r\n', 1359641802, 1, 1, 2, 'Suivi programmation forum', 161),
(215, '::', 1359641817, 1, 1, 2, 'Suivi programmation forum', 161),
(216, ':3', 1359641825, 1, 1, 2, 'Suivi programmation forum', 161),
(217, 'â™¥', 1359641965, 1, 1, 2, 'Suivi programmation forum', 161),
(218, 'â™¥', 1359641971, 1, 1, 2, 'Suivi programmation forum', 161),
(219, 'â™¥', 1359645110, 1, 1, 2, 'Suivi programmation forum', 161),
(220, 'ok <3<br />\r\n', 1359645136, 1, 1, 2, 'Suivi programmation forum', 161),
(221, 'ok<br />\r\n', 1359645147, 1, 1, 2, 'Suivi programmation forum', 161),
(222, '<3', 1359645152, 1, 1, 2, 'Suivi programmation forum', 161),
(223, 'ok', 1359645231, 1, 1, 2, 'Suivi programmation forum', 161),
(224, 'â™¥', 1359645371, 1, 1, 2, 'Suivi programmation forum', 161),
(225, 'm***e', 1359645381, 1, 1, 2, 'Suivi programmation forum', 161),
(226, 'Ce qui Ã  a faire :<br />\r\n- Promotion<br />\r\n- Amis<br />\r\n- Stockage<br />\r\n- Forum (finir)<br />\r\n- Recherche<br />\r\n- Parametres (finir)', 1360094360, 1, 1, 2, 'Ã  faire', 226),
(227, 'Ce qui Ã  a faire :<br />\r\n- Stockage<br />\r\n- Forum (finir)<br />\r\n- Recherche<br />\r\n- Parametres (finir)', 1360256957, 1, 1, 2, 'Ã  faire', 226),
(228, 'â™¥', 1360257017, 1, 1, 2, 'Suivi programmation forum', 161),
(229, 'm***e', 1360257031, 1, 1, 2, 'Suivi programmation forum', 161),
(230, ':?php', 1360257046, 1, 1, 2, 'Suivi programmation forum', 161),
(231, 'Ce qui Ã  a faire :<br />\r\n- Stockage<br />\r\n- Forum (finir)<br />\r\n- Recherche<br />\r\n- Parametres (finir)<br />\r\n- Contact', 1360832835, 1, 1, 2, 'Ã  faire', 226),
(232, 'FTP server: FTP.danielpaiva.fr<br />\r\nFTP username: ragel@danielpaiva.fr<br />\r\nFTP password: 000000<br />\r\n', 1360833981, 1, 1, 3, 'Identifiants FTP', 168),
(233, 'FTP server: FTP.danielpaiva.fr<br />\r\nFTP username: loic@danielpaiva.fr<br />\r\nFTP password: 000000', 1361450686, 1, 1, 2, 'Identifiants FTP', 233),
(234, 'Il reste quoi a faire du coup (de facile bien sur ^^)', 1361452709, 1, 2, 1, 'Taf', 234),
(235, 'je crois avoir trouvÃ© un bug', 1361458879, 1, 2, 1, 'Taf', 234),
(236, 'a bah nn ', 1361458949, 1, 2, 1, 'Taf', 234),
(237, 'mdr<br />\r\n', 1361459197, 1, 1, 2, 'Taf', 234);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL COMMENT 'clé étrangere utilisateur',
  `id_destinataire` int(11) NOT NULL,
  `vu` int(11) NOT NULL,
  PRIMARY KEY (`id_notif`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `date`, `contenu`, `type`, `id_user`, `id_destinataire`, `vu`) VALUES
(12, 1360928470, '<a href="profil.php?user=1">Daniel Paiva souhaite vous ajouter a ses amis.</a>', 'add_ami', 1, 3, 1),
(10, 1360847589, '<a href="profil.php?user=2">LoÃ¯c Manet souhaite vous ajouter a ses amis.</a>', 'add_ami', 2, 1, 1),
(16, 1361457557, 'contenu', 'partage_fichier', 1, 2, 1),
(17, 1361457566, 'contenu', 'partage_fichier', 1, 2, 1),
(18, 1361457601, '<a href="hdd.php">Daniel Paiva Ã  partagÃ© un fichier avec vous</a>', 'partage_fichier', 1, 2, 1),
(19, 1361457740, '<a href="hdd.php">Daniel Paiva Ã  partagÃ© un fichier avec vous</a>', 'partage_fichier', 1, 2, 1),
(20, 1361457753, '<a href="hdd.php">Daniel Paiva Ã  partagÃ© un fichier avec vous</a>', 'partage_fichier', 1, 2, 1),
(21, 1361457761, '<a href="hdd.php">Daniel Paiva Ã  partagÃ© un fichier avec vous</a>', 'partage_fichier', 1, 2, 1),
(22, 1361458045, '<a href="hdd.php">LoÃ¯c Manet Ã  partagÃ© un fichier avec vous</a>', 'partage_fichier', 2, 1, 1),
(23, 1361458343, '<a href="hdd.php">Daniel Paiva Ã  partagÃ© un fichier avec vous le 21/02/2013 15:52</a>', 'partage_fichier', 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promo` int(11) NOT NULL AUTO_INCREMENT,
  `nom_promo` varchar(50) NOT NULL,
  `annee` int(11) NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `nom_promo`, `annee`) VALUES
(2, 'BTS INFO 2012', 2012),
(1, 'BTS INFO 2011', 2011);

-- --------------------------------------------------------

--
-- Table structure for table `stockage`
--

CREATE TABLE IF NOT EXISTS `stockage` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(100) NOT NULL,
  `lien` varchar(500) NOT NULL,
  `taille` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` int(50) NOT NULL,
  PRIMARY KEY (`id_fichier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `stockage`
--

INSERT INTO `stockage` (`id_fichier`, `nom_fichier`, `lien`, `taille`, `type`, `date`) VALUES
(1, 'test', 'test.png', 6265, 'png', 1354802460),
(2, 'test 2', 'tedddst.png', 6265, 'png', 1353597748),
(4, 'kjhgluk', 'cloud/11361396272.jpg', 88471, '.jpg', 1361396272),
(5, 'essaie', 'cloud/21361455777.docx', 13855, '.docx', 1361455777),
(6, 'Base de donnÃ©es', 'cloud/21361455809.sql', 17654, '.sql', 1361455809),
(7, 'Meurise', 'cloud/11361457073.sql', 18063, '.sql', 1361457073),
(8, 'BDD', 'cloud/11361457111.sql', 17654, '.sql', 1361457111),
(9, 'cah', 'cloud/21361457793.doc', 341504, '.doc', 1361457793);

-- --------------------------------------------------------

--
-- Table structure for table `stocke`
--

CREATE TABLE IF NOT EXISTS `stocke` (
  `id_user` int(11) NOT NULL,
  `id_fichier` int(11) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocke`
--

INSERT INTO `stocke` (`id_user`, `id_fichier`, `auth`) VALUES
(1, 8, 1),
(3, 8, 0),
(4, 8, 0),
(2, 8, 0),
(2, 9, 1),
(1, 9, 0),
(3, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `Mail` varchar(100) NOT NULL,
  `Mot_de_passe` varchar(40) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` varchar(5) NOT NULL,
  `id_promo` int(11) NOT NULL COMMENT 'clé étrangere promotion',
  `avatar` varchar(200) NOT NULL,
  `rang` int(11) NOT NULL,
  `notifications` int(1) NOT NULL DEFAULT '1',
  `recherche` int(1) NOT NULL DEFAULT '1',
  `loisirs` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `utilisateur`
--