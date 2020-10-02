-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  ven. 02 oct. 2020 à 12:24
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `db_iut_concours`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nom_admin` varchar(50) NOT NULL,
  `prenom_admin` varchar(100) DEFAULT NULL,
  `email_admin` varchar(50) NOT NULL,
  `mot_de_pass` varchar(255) NOT NULL,
  `role` enum('admin','resp_delg') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `nom_admin`, `prenom_admin`, `email_admin`, `mot_de_pass`, `role`) VALUES
(12, 'ADMIN', NULL, 'admin@gmail.com', '$2y$10$AHthAu10tY/mkZcts.THy.E9MXM1W7gcba9gBi6.8VN0EqwsalGli', 'admin'),
(13, 'MACBOOK', NULL, 'macbook@gmail.com', '$2y$10$fnbWESShNk8HJs5ZESzkfejDXUaavD8JA1URUmFdtQQbn/m7NZagO', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id_candidat` int(11) NOT NULL,
  `nom_candidat` varchar(50) NOT NULL,
  `prenom_candidat` varchar(50) NOT NULL,
  `date_naiss` date NOT NULL,
  `lieu_naiss` varchar(50) NOT NULL,
  `sexe` enum('m','f') NOT NULL DEFAULT 'm',
  `adresse_perso` varchar(50) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `nom_du_pere` varchar(100) DEFAULT NULL,
  `nom_de_la_mere` varchar(100) DEFAULT NULL,
  `tentative` int(10) NOT NULL,
  `id_reg_or` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id_candidat`, `nom_candidat`, `prenom_candidat`, `date_naiss`, `lieu_naiss`, `sexe`, `adresse_perso`, `telephone`, `email`, `photo`, `nom_du_pere`, `nom_de_la_mere`, `tentative`, `id_reg_or`) VALUES
(1, 'DIMISSIGUE', 'GRACE', '2000-05-21', 'YAGOUA', 'f', 'GAROUA', '696511201', 'dimissigue@gmail.com', 'default.png', NULL, NULL, 0, 1),
(2, 'SAMANKASSOU', 'FOULLA', '1996-05-18', 'GAROUA', 'm', 'GAROUA', '691565877', 'sam@gmail.com', 'default.png', 'FOULLA JOSEPH', 'MARTHA MARTINE', 0, 2),
(3, 'FITA', 'CLARISSE', '1999-09-05', 'GAROUA', 'f', 'GAROUA DJAMBOUTOU', '691100834', 'fitaclarisse@gmail.com', 'default.png', NULL, NULL, 0, 2),
(4, 'ATONIE ', 'BIBIANE', '1991-11-29', 'NGWATTA', 'f', 'NGWATTA', '696511201', 'bava@gmail.com', 'default.png', NULL, NULL, 0, 8),
(5, 'PLONG', 'MATIAL MARIUS', '1998-09-28', 'NDERE', 'm', 'NDERE', '655335789', 'nmartial@yahoo.fr', 'default.png', NULL, NULL, 0, 3),
(6, 'FEUKAM TAMBO', 'JOSIANE RAISSA', '1997-08-10', 'DOUALA', 'f', 'DOUALA', '655345412', 'js@yahoo.fr', 'default.png', NULL, NULL, 0, 7),
(7, 'VOUGUE', 'MANUELLA', '1999-12-25', 'YAOUNDE', 'f', 'BINI DANG', '698413911', 'vouguemanuella@gmail.com', 'default.png', NULL, NULL, 0, 4),
(8, 'HAMMADOU', 'YACOUBOU', '1998-08-23', 'MAROUA', 'm', 'NJOLA', '655345412', 'hammadouy@gmail.com', 'default.png', NULL, NULL, 0, 15),
(9, 'YANDAL', 'MEDARD', '1995-09-12', 'BAGNO', 'm', 'GAROUA', '691234564', 'yandalmadard@gmail.com', 'default.png', NULL, NULL, 0, 3),
(10, 'AISSATOU', 'OUSMANOU', '2000-07-12', 'NDERE', 'f', 'NDERE', '655784565', 'aissatouousman@gmail.com', 'default.png', NULL, NULL, 0, 4),
(11, 'MOHAMMADOU', 'YAOUBA', '1998-09-23', 'DOUALA', 'm', 'DOUALA', '655345412', 'mh@gmail.com', 'default.png', NULL, NULL, 0, 5),
(12, 'DAYNOU', 'MONKAN', '1995-07-24', 'BAMENDJOU', 'm', 'BAFANG', '690786543', 'dv@gmail.com', 'default.png', NULL, NULL, 0, 2),
(13, 'HAMZA', 'SOULEYMANE', '1999-03-06', 'GAROUA', 'm', 'BINI DANG', '675676876', 'hamzasouleymane@gmail.com', 'default.png', NULL, NULL, 0, 10),
(14, 'ESSOLA LAURENCE', 'MANUELA', '1999-12-12', 'EBOLOWA', 'f', 'EBOLOWA', '691345676', 'essolalaurence@gmail.com', 'default.png', NULL, NULL, 0, 6),
(15, 'GONDJI', 'SOULEYMANE', '2001-09-12', 'SANGMELIMA', 'm', 'SANGMELIMA', '698675489', 'gondjisouly@yahoo.fr', 'default.png', NULL, NULL, 0, 5),
(16, 'AWATIF', 'OUMAROU', '1994-09-12', 'EBOLOWA', 'm', 'EBOLOWA', '690063900', 'atiffdjime@gmail.com', 'default.png', NULL, NULL, 0, 6),
(17, 'TCHEUKO', 'ROSE', '2000-04-10', 'BAFOUSSAM', 'f', 'BINI DANG', '678546789', 'rosepamla@yahoo.fr', 'default.png', NULL, NULL, 0, 8),
(18, 'SOULEYMANE', 'IBNOU', '1998-04-10', 'BERTOUA', 'm', 'BERTOUA', '691100834', 'souleymanou.i@yahoo.fr', 'default.png', NULL, NULL, 0, 8),
(19, 'WILFRIED', 'GEOFREY', '1998-05-12', 'YAOUNDE', 'm', 'YELWA GAROUA', '694886635', 'wilfriedmissam937@gmail.com', 'default.png', NULL, NULL, 0, 4),
(20, 'YANDA RITOUANDI', 'MOISE', '1999-12-23', 'YAOUNDE', 'm', 'KONKANA YAOUNDE', '698675489', 'yandamoise@yahoo.fr', 'default.png', NULL, NULL, 0, 3),
(21, 'ADOUM', 'TAIGA', '1997-08-23', 'NDERE', 'm', 'BINI DANG', '655345412', 'san@gmail.com', 'default.png', NULL, NULL, 0, 3),
(22, 'ALIOU', 'GARGA', '1998-03-12', 'NDERE', 'm', 'NDERE', '697896754', 'aliougargalgmail.com', 'default.png', NULL, NULL, 0, 3),
(23, 'DAYANG', 'VICTOR', '1997-08-12', 'BAMENDA', 'm', 'BASTOS', '698467744', 'dayangvictorlgmail.com', 'default.png', NULL, NULL, 0, 9),
(24, 'FONYOUNDI', 'IDRISSOU', '1999-05-11', 'MAROUA', 'm', 'MAROUA', '698467744', 'ygnhh@gmail.com', 'default.png', NULL, NULL, 0, 1),
(25, 'HARADENE', 'DJIHONDOURBA', '1995-07-11', 'GAROUA', 'm', 'GAROUA', '691100834', 'dayang.jesus@gmail.com', 'default.png', NULL, NULL, 0, 2),
(26, 'OIRA BONEBO', 'YACINTHE', '1997-05-12', 'GAROUA', 'm', 'GAROUA', '698467744', 'oirabonebo@gmail.com', 'default.png', NULL, NULL, 0, 2),
(27, 'HAMMAN', 'YEZOUA', '2000-12-12', 'GAROUA', 'm', 'GAROUA', '698467744', 'sdffg@gmail.om', 'default.png', NULL, NULL, 0, 5),
(28, 'MOUSSA', 'NASSOUROU', '1999-05-12', 'TCHATCHIBAL', 'm', 'DOURMI', '655456789', 'mnass@gmail.com', 'default.png', NULL, NULL, 1, 3),
(29, 'ALIM', 'MOUSSA', '2020-09-10', 'DFG', 'm', 'DFFFD', '6565656565', 'samankassou@ghjkl.com', 'default.png', NULL, NULL, 0, 1),
(30, 'MOUSSA', 'ISSA', '2020-09-11', 'DSSSD', 'm', 'DSDSDS', '6767766776', 'ens@univ-ndere.cm', 'default.png', NULL, NULL, 0, 1),
(31, 'AASSAAS', 'HH', '2020-10-01', 'GGFFG', 'm', 'GFF', '567676767', 'ens@univ-ndere.c', 'default.png', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `centre_examen`
--

CREATE TABLE `centre_examen` (
  `id_centre_examen` int(11) NOT NULL,
  `nom_centre_examen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `centre_examen`
--

INSERT INTO `centre_examen` (`id_centre_examen`, `nom_centre_examen`) VALUES
(1, 'Bertoua'),
(2, 'Ngaoundéré'),
(3, 'Yaoundé'),
(4, 'Maroua'),
(5, 'Garoua'),
(6, 'Bafoussam'),
(7, 'Ebolowa'),
(8, 'Bamenda'),
(9, 'Douala'),
(10, 'Buéa');

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

CREATE TABLE `cursus` (
  `id_cursus` int(11) NOT NULL,
  `annee` varchar(25) NOT NULL,
  `etablissement` varchar(100) NOT NULL,
  `classe_suivie` varchar(25) NOT NULL,
  `examen_prepare` varchar(25) NOT NULL,
  `resultat` varchar(25) NOT NULL,
  `mention` varchar(25) NOT NULL,
  `id_dossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cursus`
--

INSERT INTO `cursus` (`id_cursus`, `annee`, `etablissement`, `classe_suivie`, `examen_prepare`, `resultat`, `mention`, `id_dossier`) VALUES
(1, '2019/2020', '', '', '', '', '', 1),
(2, '2018/2019', '', '', '', '', '', 1),
(3, '2017/2018', '', '', '', '', '', 1),
(4, '2016/2017', '', '', '', '', '', 1),
(5, '2015/2016', '', '', '', '', '', 1),
(6, '2019/2020', '', '', '', '', '', 2),
(7, '2018/2019', '', '', '', '', '', 2),
(8, '2017/2018', '', '', '', '', '', 2),
(9, '2016/2017', '', '', '', '', '', 2),
(10, '2015/2016', '', '', '', '', '', 2),
(11, '2019/2020', '', '', '', '', '', 3),
(12, '2018/2019', '', '', '', '', '', 3),
(13, '2017/2018', '', '', '', '', '', 3),
(14, '2016/2017', '', '', '', '', '', 3),
(15, '2015/2016', '', '', '', '', '', 3),
(16, '2019/2020', '', '', '', '', '', 4),
(17, '2018/2019', '', '', '', '', '', 4),
(18, '2017/2018', '', '', '', '', '', 4),
(19, '2016/2017', '', '', '', '', '', 4),
(20, '2015/2016', '', '', '', '', '', 4),
(21, '2019/2020', '', '', '', '', '', 5),
(22, '2018/2019', '', '', '', '', '', 5),
(23, '2017/2018', '', '', '', '', '', 5),
(24, '2016/2017', '', '', '', '', '', 5),
(25, '2015/2016', '', '', '', '', '', 5),
(26, '2019/2020', '', '', '', '', '', 6),
(27, '2018/2019', '', '', '', '', '', 6),
(28, '2017/2018', '', '', '', '', '', 6),
(29, '2016/2017', '', '', '', '', '', 6),
(30, '2015/2016', '', '', '', '', '', 6),
(31, '2019/2020', '', '', '', '', '', 7),
(32, '2018/2019', '', '', '', '', '', 7),
(33, '2017/2018', '', '', '', '', '', 7),
(34, '2016/2017', '', '', '', '', '', 7),
(35, '2015/2016', '', '', '', '', '', 7),
(36, '2019/2020', '', '', '', '', '', 8),
(37, '2018/2019', '', '', '', '', '', 8),
(38, '2017/2018', '', '', '', '', '', 8),
(39, '2016/2017', '', '', '', '', '', 8),
(40, '2015/2016', '', '', '', '', '', 8),
(41, '2019/2020', '', '', '', '', '', 9),
(42, '2018/2019', '', '', '', '', '', 9),
(43, '2017/2018', '', '', '', '', '', 9),
(44, '2016/2017', '', '', '', '', '', 9),
(45, '2015/2016', '', '', '', '', '', 9),
(46, '2019/2020', '', '', '', '', '', 10),
(47, '2018/2019', '', '', '', '', '', 10),
(48, '2017/2018', '', '', '', '', '', 10),
(49, '2016/2017', '', '', '', '', '', 10),
(50, '2015/2016', '', '', '', '', '', 10),
(51, '2019/2020', '', '', '', '', '', 11),
(52, '2018/2019', '', '', '', '', '', 11),
(53, '2017/2018', '', '', '', '', '', 11),
(54, '2016/2017', '', '', '', '', '', 11),
(55, '2015/2016', '', '', '', '', '', 11),
(56, '2019/2020', '', '', '', '', '', 12),
(57, '2018/2019', '', '', '', '', '', 12),
(58, '2017/2018', '', '', '', '', '', 12),
(59, '2016/2017', '', '', '', '', '', 12),
(60, '2015/2016', '', '', '', '', '', 12),
(61, '2019/2020', '', '', '', '', '', 13),
(62, '2018/2019', '', '', '', '', '', 13),
(63, '2017/2018', '', '', '', '', '', 13),
(64, '2016/2017', '', '', '', '', '', 13),
(65, '2015/2016', '', '', '', '', '', 13),
(66, '2019/2020', '', '', '', '', '', 14),
(67, '2018/2019', '', '', '', '', '', 14),
(68, '2017/2018', '', '', '', '', '', 14),
(69, '2016/2017', '', '', '', '', '', 14),
(70, '2015/2016', '', '', '', '', '', 14),
(71, '2019/2020', '', '', '', '', '', 15),
(72, '2018/2019', '', '', '', '', '', 15),
(73, '2017/2018', '', '', '', '', '', 15),
(74, '2016/2017', '', '', '', '', '', 15),
(75, '2015/2016', '', '', '', '', '', 15),
(76, '2019/2020', '', '', '', '', '', 16),
(77, '2018/2019', '', '', '', '', '', 16),
(78, '2017/2018', '', '', '', '', '', 16),
(79, '2016/2017', '', '', '', '', '', 16),
(80, '2015/2016', '', '', '', '', '', 16),
(81, '2019/2020', '', '', '', '', '', 17),
(82, '2018/2019', '', '', '', '', '', 17),
(83, '2017/2018', '', '', '', '', '', 17),
(84, '2016/2017', '', '', '', '', '', 17),
(85, '2015/2016', '', '', '', '', '', 17),
(86, '2019/2020', '', '', '', '', '', 18),
(87, '2018/2019', '', '', '', '', '', 18),
(88, '2017/2018', '', '', '', '', '', 18),
(89, '2016/2017', '', '', '', '', '', 18),
(90, '2015/2016', '', '', '', '', '', 18),
(91, '2019/2020', '', '', '', '', '', 19),
(92, '2018/2019', '', '', '', '', '', 19),
(93, '2017/2018', '', '', '', '', '', 19),
(94, '2016/2017', '', '', '', '', '', 19),
(95, '2015/2016', '', '', '', '', '', 19),
(96, '2019/2020', '', '', '', '', '', 20),
(97, '2018/2019', '', '', '', '', '', 20),
(98, '2017/2018', '', '', '', '', '', 20),
(99, '2016/2017', '', '', '', '', '', 20),
(100, '2015/2016', '', '', '', '', '', 20),
(101, '2019/2020', '', '', '', '', '', 21),
(102, '2018/2019', '', '', '', '', '', 21),
(103, '2017/2018', '', '', '', '', '', 21),
(104, '2016/2017', '', '', '', '', '', 21),
(105, '2015/2016', '', '', '', '', '', 21),
(106, '2019/2020', 'LYCEE', '4eme', '', '14', 'bien', 22),
(107, '2018/2019', '', '', '', '', '', 22),
(108, '2017/2018', '', '', '', '', '', 22),
(109, '2016/2017', '', '', '', '', '', 22),
(110, '2015/2016', '', '', '', '', '', 22),
(111, '2019/2020', 'LYCEE', '4eme', '', '17', 'bien', 23),
(112, '2018/2019', '', '', '', '', '', 23),
(113, '2017/2018', '', '', '', '', '', 23),
(114, '2016/2017', '', '', '', '', '', 23),
(115, '2015/2016', '', '', '', '', '', 23),
(116, '2019/2020', '', '', '', '', '', 24),
(117, '2018/2019', '', '', '', '', '', 24),
(118, '2017/2018', '', '', '', '', '', 24),
(119, '2016/2017', '', '', '', '', '', 24),
(120, '2015/2016', 'LYCEE CLASSIQUE ET MODERNE DE MAROUA', '3eme', 'BEPC', '12', 'passable', 24),
(121, '2019/2020', 'LYCEE DE OURO HOURSO', 'tle c', '', 'baccalaureat c', '', 25),
(122, '2018/2019', 'LYCEE DE OURO HOURSO', '1ere c', '', 'probatoire c', '', 25),
(123, '2017/2018', 'LYCEE DE OURO HOURSO', '2nde c', '', '', '', 25),
(124, '2016/2017', 'LYCEE DE OURO HOURSO', '3eme', '', 'bepc', '', 25),
(125, '2015/2016', 'LYCEE DE OURO HOURSO', '4eme', '', '', '', 25),
(126, '2019/2020', '', '', '', '', '', 26),
(127, '2018/2019', '', '', '', '', '', 26),
(128, '2017/2018', '', '', '', '', '', 26),
(129, '2016/2017', '', '', '', '', '', 26),
(130, '2015/2016', '', '', '', '', '', 26),
(131, '2019/2020', '', '', '', '', '', 27),
(132, '2018/2019', '', '', '', '', '', 27),
(133, '2017/2018', '', '', '', '', '', 27),
(134, '2016/2017', '', '', '', '', '', 27),
(135, '2015/2016', '', '', '', '', '', 27),
(136, '2019/2020', '', '', '', '', '', 28),
(137, '2018/2019', '', '', '', '', '', 28),
(138, '2017/2018', '', '', '', '', '', 28),
(139, '2016/2017', '', '', '', '', '', 28),
(140, '2015/2016', '', '', '', '', '', 28),
(141, '2019/2020', 'DFFDDF', 'fdfd', 'FDDFFD', '12fd', 'sdds', 29),
(142, '2018/2019', '', '', '', '', '', 29),
(143, '2017/2018', '', '', '', '', '', 29),
(144, '2016/2017', '', '', '', '', '', 29),
(145, '2015/2016', '', '', '', '', '', 29),
(146, '2019/2020', 'SSASA', '5eme', 'DDSDS', 'dsds', 'sdsd', 30),
(147, '2018/2019', '', '', '', '', '', 30),
(148, '2017/2018', '', '', '', '', '', 30),
(149, '2016/2017', '', '', '', '', '', 30),
(150, '2015/2016', '', '', '', '', '', 30),
(151, '2019/2020', 'FZZZ', 'zzfzf', 'FTFFG', 'vgv', 'gggv', 31),
(152, '2018/2019', '', '', '', '', '', 31),
(153, '2017/2018', '', '', '', '', '', 31),
(154, '2016/2017', '', '', '', '', '', 31),
(155, '2015/2016', '', '', '', '', '', 31);

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

CREATE TABLE `cycle` (
  `id_cycle` int(11) NOT NULL,
  `nom_cycle` varchar(50) NOT NULL,
  `abreviation_cycle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`id_cycle`, `nom_cycle`, `abreviation_cycle`) VALUES
(1, 'Diplôme Universitaire de Technologie', 'DUT'),
(2, 'Brevet de Technicien Supérieur', 'BTS'),
(3, 'Licence Technologique', 'LITECH');

-- --------------------------------------------------------

--
-- Structure de la table `cycle_centre_examen`
--

CREATE TABLE `cycle_centre_examen` (
  `id_cycle_centre_examen` int(11) NOT NULL,
  `id_cycle` int(11) NOT NULL,
  `id_centre_examen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cycle_centre_examen`
--

INSERT INTO `cycle_centre_examen` (`id_cycle_centre_examen`, `id_cycle`, `id_centre_examen`) VALUES
(1, 2, 9),
(2, 2, 5),
(3, 2, 2),
(4, 2, 3),
(5, 1, 1),
(6, 1, 2),
(7, 1, 3),
(8, 1, 4),
(9, 1, 5),
(10, 1, 6),
(11, 1, 7),
(12, 1, 8),
(13, 1, 9),
(14, 1, 10);

-- --------------------------------------------------------

--
-- Structure de la table `cycle_parcours`
--

CREATE TABLE `cycle_parcours` (
  `id_cycle_parcour` int(11) NOT NULL,
  `id_cycle` int(11) NOT NULL,
  `id_parcour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cycle_parcours`
--

INSERT INTO `cycle_parcours` (`id_cycle_parcour`, `id_cycle`, `id_parcour`) VALUES
(27, 1, 1),
(28, 1, 2),
(29, 1, 3),
(30, 1, 4),
(36, 1, 6),
(31, 1, 7),
(32, 1, 8),
(33, 1, 9),
(34, 1, 13),
(35, 1, 14),
(48, 2, 24),
(49, 2, 25),
(50, 2, 26),
(51, 2, 27),
(52, 2, 28),
(53, 2, 29),
(54, 2, 30),
(55, 2, 31),
(56, 2, 32),
(57, 2, 33),
(58, 2, 34),
(37, 3, 11),
(38, 3, 12),
(39, 3, 15),
(41, 3, 16),
(40, 3, 17),
(42, 3, 19),
(43, 3, 20),
(44, 3, 21),
(45, 3, 22),
(46, 3, 23);

-- --------------------------------------------------------

--
-- Structure de la table `diplome`
--

CREATE TABLE `diplome` (
  `id_diplome` int(11) NOT NULL,
  `intitule_diplome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `diplome`
--

INSERT INTO `diplome` (`id_diplome`, `intitule_diplome`) VALUES
(1, 'Baccalauréat A4 (Option Allemand)'),
(2, 'Baccalauréat A4 (Option Espagnol)'),
(3, 'Baccalauréat C'),
(4, 'Baccalauréat D'),
(5, 'Baccalauréat E'),
(6, 'Baccalauréat ABI'),
(7, 'Baccalauréat F1'),
(8, 'Baccalauréat TI'),
(9, 'GCE AL'),
(12, 'Autre'),
(13, 'GCE AL (Biology, Physics)'),
(14, 'GCE AL (Biology, Mathematics)'),
(15, 'GCE AL (Biology, Chemestry)'),
(31, 'Baccalauréat F2'),
(33, 'Baccalauréat F3'),
(34, 'Baccalauréat F5'),
(35, 'Baccalauréat F6'),
(36, 'Baccalauréat BT(MA)'),
(37, 'Baccalauréat BT(MAV)'),
(38, 'Baccalauréat BT(MEM)'),
(39, 'Baccalauréat BT(MF/CF)'),
(40, 'Baccalauréat BT(MHB)'),
(41, 'Baccalauréat B'),
(42, 'Baccalauréat F7'),
(43, 'Baccalauréat CI'),
(44, 'Baccalauréat A4 (Option Arabe)'),
(45, 'Baccalauréat A4 (Option Chinois)'),
(46, 'Baccalauréat F4'),
(47, 'Autre'),
(48, 'Baccalauréat ESF'),
(49, 'Autre'),
(50, 'DUT'),
(51, 'BTS'),
(52, 'HND'),
(53, 'DEUG'),
(54, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `diplome_entree`
--

CREATE TABLE `diplome_entree` (
  `id_diplome_entree` int(11) NOT NULL,
  `annee` year(4) NOT NULL,
  `centre_obtention` varchar(100) NOT NULL,
  `id_diplome` int(11) NOT NULL,
  `id_pays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `diplome_entree`
--

INSERT INTO `diplome_entree` (`id_diplome_entree`, `annee`, `centre_obtention`, `id_diplome`, `id_pays`) VALUES
(1, 2018, 'LYCEE DE GAROUA', 3, 1),
(2, 2017, 'LYCEE DE GAROUA', 3, 1),
(3, 2018, 'LYCEE TECHNIQUE DE GAROUA', 31, 1),
(4, 2014, 'LYCEE LECLERC', 4, 1),
(5, 2018, 'LYCEE DE GUIDER', 3, 1),
(6, 2017, 'LYCEE MIXTE DE KOUSSERI', 4, 1),
(7, 2018, 'YAOUNDE', 13, 1),
(8, 2018, 'LYCEE MIXTE DE KOUSSERI', 1, 1),
(9, 2016, 'LYCEE LECLERC', 4, 1),
(10, 2018, '', 4, 1),
(11, 2018, 'LYCEE LECLERC', 8, 1),
(12, 2019, 'LYCEE DE REG', 3, 1),
(13, 2016, 'LYCEE MIXTE DE KOUSSERI', 8, 1),
(14, 2018, 'LYCEE LECLERC', 33, 1),
(15, 2018, 'LYCEE DE GUIDER', 4, 1),
(16, 2017, 'LYCEE DE GUIDER', 8, 1),
(17, 2018, 'LYCEE LECLERC', 3, 1),
(18, 2017, 'LYCEE DE GAROUA', 36, 1),
(19, 2016, 'COLLEGE PROTESTANT', 2, 1),
(20, 2018, 'LYCEE DE GUIDER', 4, 1),
(21, 2018, 'LYCEE LECLERC', 31, 1),
(22, 2018, 'LYCEE DE GAROUA', 8, 1),
(23, 2017, 'LYCEE LECLERC', 3, 1),
(24, 2018, 'LYCEE DE GUIDER', 46, 1),
(25, 2017, 'LYCEE DE OURO HOURSO', 3, 1),
(26, 2017, 'LYCEE DE GAROUA', 4, 1),
(27, 2016, 'LYCEE DE GUIDER', 4, 1),
(28, 2018, 'LYCEE DE GAROUA', 4, 1),
(29, 2019, 'FDFFFD', 1, 1),
(30, 2018, 'KLJHJJK', 4, 1),
(31, 2018, 'LYCEE DE GUIDER', 50, 1),
(32, 2019, 'LYCEE DE GAROUA', 50, 1),
(33, 2018, 'GFGGFHHG', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `diplome_requis`
--

CREATE TABLE `diplome_requis` (
  `id_diplome_requis` int(11) NOT NULL,
  `id_diplome` int(11) NOT NULL,
  `id_parcour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `diplome_requis`
--

INSERT INTO `diplome_requis` (`id_diplome_requis`, `id_diplome`, `id_parcour`) VALUES
(64, 3, 1),
(65, 41, 1),
(66, 4, 1),
(67, 5, 1),
(68, 8, 1),
(69, 31, 1),
(70, 12, 1),
(71, 9, 1),
(72, 15, 1),
(73, 14, 1),
(74, 13, 1),
(75, 3, 14),
(76, 4, 14),
(77, 5, 14),
(78, 7, 14),
(79, 31, 14),
(80, 33, 14),
(81, 46, 14),
(82, 34, 14),
(83, 8, 14),
(84, 36, 14),
(85, 37, 14),
(86, 38, 14),
(87, 39, 14),
(88, 12, 14),
(89, 9, 14),
(90, 15, 14),
(91, 14, 14),
(92, 13, 14),
(93, 3, 13),
(94, 4, 13),
(95, 5, 13),
(96, 31, 13),
(97, 33, 13),
(98, 34, 13),
(99, 8, 13),
(100, 40, 13),
(101, 38, 13),
(102, 12, 13),
(103, 9, 13),
(104, 15, 13),
(105, 14, 13),
(106, 13, 13),
(107, 1, 3),
(108, 44, 3),
(109, 45, 3),
(110, 2, 3),
(111, 41, 3),
(112, 3, 3),
(113, 4, 3),
(114, 5, 3),
(115, 43, 3),
(116, 42, 3),
(117, 12, 3),
(118, 9, 3),
(119, 15, 3),
(120, 14, 3),
(121, 13, 3),
(122, 48, 3),
(123, 1, 4),
(124, 44, 4),
(125, 45, 4),
(126, 2, 4),
(127, 41, 4),
(128, 3, 4),
(129, 4, 4),
(130, 5, 4),
(131, 43, 4),
(132, 8, 4),
(133, 42, 4),
(134, 48, 4),
(135, 9, 4),
(136, 15, 4),
(137, 14, 4),
(138, 13, 4),
(139, 12, 4),
(140, 1, 2),
(141, 44, 2),
(142, 45, 2),
(143, 2, 2),
(144, 41, 2),
(145, 3, 2),
(146, 4, 2),
(147, 5, 2),
(148, 43, 2),
(149, 8, 2),
(150, 42, 2),
(151, 48, 2),
(152, 9, 2),
(153, 15, 2),
(154, 14, 2),
(155, 13, 2),
(156, 12, 2),
(157, 3, 7),
(158, 4, 7),
(159, 5, 7),
(160, 7, 7),
(161, 31, 7),
(162, 33, 7),
(163, 34, 7),
(164, 8, 7),
(165, 36, 7),
(166, 37, 7),
(167, 38, 7),
(168, 39, 7),
(169, 12, 7),
(170, 9, 7),
(171, 15, 7),
(172, 14, 7),
(173, 13, 7),
(174, 3, 8),
(175, 4, 8),
(176, 5, 8),
(177, 7, 8),
(178, 31, 8),
(179, 33, 8),
(180, 34, 8),
(181, 8, 8),
(182, 36, 8),
(183, 37, 8),
(184, 38, 8),
(185, 39, 8),
(186, 12, 8),
(187, 9, 8),
(188, 15, 8),
(189, 14, 8),
(190, 13, 8),
(191, 3, 9),
(192, 4, 9),
(193, 5, 9),
(194, 7, 9),
(195, 31, 9),
(196, 33, 9),
(197, 34, 9),
(198, 8, 9),
(199, 36, 9),
(200, 37, 9),
(201, 38, 9),
(202, 39, 9),
(203, 12, 9),
(204, 9, 9),
(205, 15, 9),
(206, 14, 9),
(207, 13, 9),
(208, 3, 6),
(209, 4, 6),
(210, 5, 6),
(211, 7, 6),
(212, 31, 6),
(213, 33, 6),
(214, 34, 6),
(215, 8, 6),
(216, 36, 6),
(217, 37, 6),
(218, 38, 6),
(219, 39, 6),
(220, 12, 6),
(221, 9, 6),
(222, 15, 6),
(223, 14, 6),
(224, 13, 6),
(249, 4, 24),
(250, 3, 24),
(251, 5, 24),
(252, 7, 24),
(253, 31, 24),
(254, 33, 24),
(255, 34, 24),
(256, 35, 24),
(257, 42, 24),
(258, 46, 24),
(259, 37, 24),
(260, 38, 24),
(261, 4, 25),
(262, 3, 25),
(263, 5, 25),
(264, 31, 25),
(265, 33, 25),
(266, 4, 26),
(267, 3, 26),
(268, 5, 26),
(269, 31, 26),
(270, 33, 26),
(271, 4, 27),
(272, 3, 27),
(273, 5, 27),
(274, 31, 27),
(275, 33, 27),
(276, 34, 27),
(277, 13, 27),
(278, 14, 27),
(279, 15, 27),
(280, 4, 33),
(281, 5, 33),
(282, 3, 33),
(283, 13, 33),
(284, 14, 33),
(285, 15, 33),
(286, 4, 34),
(287, 5, 34),
(288, 3, 34),
(289, 13, 34),
(290, 14, 34),
(291, 15, 34),
(292, 1, 28),
(293, 2, 28),
(294, 3, 28),
(295, 4, 28),
(296, 48, 28),
(297, 9, 28),
(298, 4, 29),
(299, 5, 29),
(300, 3, 29),
(301, 13, 29),
(302, 14, 29),
(303, 15, 29),
(304, 3, 30),
(305, 4, 30),
(306, 5, 30),
(307, 13, 30),
(308, 14, 30),
(309, 15, 30),
(310, 50, 11),
(311, 51, 11),
(312, 52, 11),
(313, 53, 11),
(314, 54, 11),
(315, 50, 12),
(316, 51, 12),
(317, 52, 12),
(318, 53, 12),
(319, 54, 12),
(320, 50, 15),
(321, 51, 15),
(322, 52, 15),
(323, 53, 15),
(324, 54, 15),
(325, 50, 16),
(326, 51, 16),
(327, 52, 16),
(328, 53, 16),
(329, 54, 16),
(330, 50, 17),
(331, 51, 17),
(332, 52, 17),
(333, 53, 17),
(334, 54, 17),
(335, 50, 19),
(336, 51, 19),
(337, 52, 19),
(338, 53, 19),
(339, 54, 19),
(340, 50, 20),
(341, 51, 20),
(342, 52, 20),
(343, 53, 20),
(344, 54, 20),
(345, 50, 21),
(346, 51, 21),
(347, 52, 21),
(348, 53, 21),
(349, 54, 21);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id_doc` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `nom_doc` varchar(50) NOT NULL,
  `langue_doc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE `dossier` (
  `id_dossier` int(11) NOT NULL,
  `langue_composition` enum('Français','Anglais','') NOT NULL,
  `date_inscription` date NOT NULL,
  `mode_admission` enum('Concours','Etude de dossier') NOT NULL,
  `statut` enum('valide','en_attente') NOT NULL,
  `id_lieu_depot` int(11) NOT NULL,
  `id_candidat` int(11) NOT NULL,
  `id_centre_examen` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  `id_diplome_entree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dossier`
--

INSERT INTO `dossier` (`id_dossier`, `langue_composition`, `date_inscription`, `mode_admission`, `statut`, `id_lieu_depot`, `id_candidat`, `id_centre_examen`, `id_paiement`, `id_diplome_entree`) VALUES
(1, 'Français', '2020-08-23', 'Concours', 'valide', 4, 1, 5, 1, 1),
(2, 'Français', '2020-08-23', 'Concours', 'valide', 1, 2, 7, 2, 2),
(3, 'Français', '2020-08-23', 'Concours', 'valide', 3, 3, 4, 3, 3),
(4, 'Français', '2020-08-23', 'Concours', 'valide', 7, 4, 6, 4, 4),
(5, 'Français', '2020-08-23', 'Concours', 'valide', 5, 5, 9, 5, 5),
(6, 'Français', '2020-08-23', 'Concours', 'valide', 8, 6, 8, 6, 6),
(7, 'Anglais', '2020-08-25', 'Concours', 'valide', 15, 7, 3, 7, 7),
(8, 'Français', '2020-08-25', 'Concours', 'valide', 2, 8, 1, 8, 8),
(9, 'Français', '2020-08-25', 'Concours', 'valide', 9, 9, 2, 9, 9),
(10, 'Français', '2020-08-25', 'Concours', 'valide', 12, 10, 10, 10, 10),
(11, 'Français', '2020-08-26', 'Concours', 'valide', 2, 11, 1, 11, 11),
(12, 'Français', '2020-08-27', 'Concours', 'valide', 3, 12, 2, 12, 12),
(13, 'Français', '2020-08-27', 'Concours', 'valide', 11, 13, 7, 13, 13),
(14, 'Français', '2020-08-27', 'Concours', 'valide', 16, 14, 10, 14, 14),
(15, 'Français', '2020-08-27', 'Concours', 'valide', 1, 15, 3, 15, 15),
(16, 'Français', '2020-08-27', 'Concours', 'valide', 2, 16, 4, 16, 16),
(17, 'Français', '2020-08-27', 'Concours', 'valide', 2, 17, 2, 17, 17),
(18, 'Français', '2020-08-27', 'Concours', 'valide', 5, 18, 9, 18, 18),
(19, 'Anglais', '2020-08-27', 'Concours', 'valide', 9, 19, 2, 19, 19),
(20, 'Français', '2020-08-27', 'Concours', 'valide', 5, 20, 2, 20, 20),
(21, 'Anglais', '2020-08-27', 'Concours', 'en_attente', 3, 21, 2, 21, 21),
(22, 'Anglais', '2020-08-27', 'Concours', 'en_attente', 1, 22, 2, 22, 22),
(23, 'Anglais', '2020-08-27', 'Concours', 'en_attente', 8, 23, 8, 23, 23),
(24, 'Français', '2020-08-27', 'Concours', 'valide', 3, 24, 4, 24, 24),
(25, 'Français', '2020-08-27', 'Concours', 'valide', 4, 25, 5, 25, 25),
(26, 'Français', '2020-08-28', 'Concours', 'en_attente', 3, 26, 2, 26, 26),
(27, 'Français', '2020-08-28', 'Concours', 'valide', 5, 27, 2, 27, 27),
(28, '', '2020-08-29', 'Etude de dossier', 'valide', 1, 28, 2, 28, 28),
(29, 'Anglais', '2020-09-02', 'Concours', 'en_attente', 1, 29, 2, 29, 29),
(30, 'Anglais', '2020-09-02', 'Concours', 'valide', 2, 30, 2, 30, 30),
(31, 'Anglais', '2020-10-01', 'Concours', 'valide', 3, 31, 2, 31, 33);

-- --------------------------------------------------------

--
-- Structure de la table `emploi`
--

CREATE TABLE `emploi` (
  `id_emploi` int(11) NOT NULL,
  `employeur` varchar(100) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `id_candidat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `lieu_depot`
--

CREATE TABLE `lieu_depot` (
  `id_lieu_depot` int(11) NOT NULL,
  `nom_lieu_depot` varchar(50) NOT NULL,
  `abrev_lieu_depot` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lieu_depot`
--

INSERT INTO `lieu_depot` (`id_lieu_depot`, `nom_lieu_depot`, `abrev_lieu_depot`) VALUES
(1, 'Délégation Régionale du MINESEC du Centre', 'MINESEC Centre'),
(2, 'Délégation Régionale du MINESEC de l\'Est', 'MINESEC Est'),
(3, 'Délégation Régionale du MINESEC de l\'Extrême-Nord', 'MINESEC Extreme-Nord'),
(4, 'Délégation Régionale du MINESEC du Nord', 'MINESEC Nord'),
(5, 'Délégation Régionale du MINESEC du Littoral', 'MINESEC Littoral'),
(6, 'Délégation Régionale du MINESEC du Sud', 'MINESEC Sud'),
(7, 'Délégation Régionale du MINESEC de l\'Ouest', 'MINESEC Ouest'),
(8, 'Délégation Régionale du MINESEC du Nord-Ouest', 'MINESEC Nord-Ouest'),
(9, 'Délégation Régionale du MINESEC de l\'Adamaoua', 'MINESEC Adamaoua'),
(10, 'Délégation Régionale du MINESEC du Sud-Ouest', 'MINESEC Sud-Ouest'),
(11, 'IUT Ngaoundere', 'IUT Ndere'),
(12, 'IUT Douala', 'IUT Douala'),
(13, 'IUT Bandjoun', 'IUT Bandjoun'),
(14, 'MINESUP', 'MINESUP'),
(15, 'Antenne Universite Ndere Yaounde', 'Antenne UN Ydé'),
(16, 'Antenne Universite Ndere Bertoua', 'Antenne UN Bertoua');

-- --------------------------------------------------------

--
-- Structure de la table `mention`
--

CREATE TABLE `mention` (
  `id_mention` int(11) NOT NULL,
  `nom_mention` varchar(50) NOT NULL,
  `sigle_mention` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mention`
--

INSERT INTO `mention` (`id_mention`, `nom_mention`, `sigle_mention`) VALUES
(1, 'Génie Informatique', 'GIN'),
(2, 'Génie Industriel et Maintenance', 'GIM'),
(3, 'Génie Biologique', 'GBIO'),
(4, 'Génie Civil et Construction Durable', 'GCD'),
(5, 'Maintenance des Equipements Biomédicaux', 'MEB'),
(6, 'Genie Mecanique et Productique', 'GMP'),
(7, 'Genie Electrique', 'GEL'),
(8, 'Genie Thermique', 'GTE'),
(9, 'Reseaux et Telecommunication', 'RTEL'),
(10, 'Sciences de Gestion et Commerciale', 'SGC');

-- --------------------------------------------------------

--
-- Structure de la table `mode_paiement`
--

CREATE TABLE `mode_paiement` (
  `id_mode_paiement` int(11) NOT NULL,
  `nom_banque` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mode_paiement`
--

INSERT INTO `mode_paiement` (`id_mode_paiement`, `nom_banque`) VALUES
(1, 'ECOBANK'),
(2, 'EXPRESS UNION'),
(3, 'EXPRESS EXCHANGE');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `id_paiement` int(11) NOT NULL,
  `num_bordereau` varchar(50) NOT NULL,
  `num_transaction` varchar(50) NOT NULL,
  `nom_agence` varchar(50) NOT NULL,
  `id_mode_paiement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`id_paiement`, `num_bordereau`, `num_transaction`, `nom_agence`, `id_mode_paiement`) VALUES
(1, '57756454', '565665', 'EXPRESS EXCHANGE GAROUA', 3),
(2, '5444455', '466667', 'EXPRESS UNION GUIDER', 2),
(3, '355445', '6655565', 'EXPRESS EXCHANGE GAROUA', 3),
(4, '54644', '455454', 'EXPRESS UNION BAFOUSSAM', 2),
(5, '65454', '545445', 'EXPRESS EXCHANGE DOUALA 3', 3),
(6, '65565', '565665', 'ECOBANK DOUALA 3', 1),
(7, '2132453', '476435745', 'ECOBANK YAOUNDE', 1),
(8, '55656', '56565656', 'ECOBANK YAOUNDE', 1),
(9, '34545545', '45544554', 'EXPRESS UNION GUIDER', 2),
(10, '6666798', '767688', 'EXPRESS EXCHANGE GAROUA', 2),
(11, '4344343', '34433434', 'ECOBANK DOUALA 3', 1),
(12, '878755', '7677676', 'EXPRESS UNION NDERE', 2),
(13, '4554454', '45545454', 'EXPRESS UNION GUIDER', 2),
(14, '454544', '45454554', 'ECOBANK DOUALA 3', 1),
(15, '8788786', '877878', 'EXPRESS EXCHANGE GAROUA', 3),
(16, '566565', '65655665', 'EXPRESS UNION NDERE', 2),
(17, '34545545', '4545455445', 'EXPRESS EXCHANGE GAROUA', 3),
(18, '6658578', '889966554', 'EXPRESS UNION GUIDER', 2),
(19, '67765655', '77655765', 'ECOBANK DOUALA 3', 1),
(20, '7667656', '77656556', 'ECOBANK DOUALA 3', 1),
(21, '76576567', '786667', 'EXPRESS UNION GAROUA', 2),
(22, '54455445', '45544554', 'EXPRESS EXCHANGE GAROUA', 3),
(23, '6566565', '65656565', 'EXPRESS UNION GUIDER', 2),
(24, '655655665', '65656565', 'EXPRESS UNION MAROUA', 2),
(25, '7676767', '75775676', 'EXPRESS UNION GAROUA', 2),
(26, '4334343', '3343443', 'ECOBANK DOUALA 3', 1),
(27, '655665', '676767', 'ECOBANK DOUALA 3', 1),
(28, '4434343', '4343434', 'EXPRESS UNION GUIDER', 2),
(29, '121221', '122121', 'DSDS', 1),
(30, '55354', '54544566', 'SDDSDS', 1),
(31, '6556577', '954544566', 'EC', 1);

-- --------------------------------------------------------

--
-- Structure de la table `param_concours`
--

CREATE TABLE `param_concours` (
  `id_param_concours` int(11) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `id_doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `parcour`
--

CREATE TABLE `parcour` (
  `id_parcour` int(11) NOT NULL,
  `abreviation_parcour` varchar(8) NOT NULL,
  `nom_parcour` varchar(50) NOT NULL,
  `id_mention` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parcour`
--

INSERT INTO `parcour` (`id_parcour`, `abreviation_parcour`, `nom_parcour`, `id_mention`) VALUES
(1, 'GIN', 'Génie Informatique', 1),
(2, 'ABB', 'Analyses Biologiques et Biochimiques', 3),
(3, 'GEN', 'Génie de l’Environnement', 3),
(4, 'IAB', 'Industries Alimentaires et Biotechnologiques', 3),
(6, 'GMP', 'Génie Mécanique et Productique', 2),
(7, 'GEL', 'Génie Electrique', 2),
(8, 'GTE', 'Génie Thermique et Energétique', 2),
(9, 'MIP', 'Maintenance Industrielle et Productique', 2),
(11, 'GLO', 'Génie Logiciel', 1),
(12, 'RIN', 'Réseautique et Internet', 1),
(13, 'MEB', 'Maintenance des Equipements Biomédicaux', 5),
(14, 'GCD', 'Génie Civil et Construction Durable', 4),
(15, 'ABB', 'Analyses Biologiques et Biochimiques', 3),
(16, 'IAB', 'Industries Alimentaires et Biotechnologiques', 3),
(17, 'GEN', 'Génie de l\'Environnement', 3),
(19, 'GMP', 'Génie Mécanique et Productique', 2),
(20, 'GEL', 'Génie Electrique', 2),
(21, 'GTE', 'Génie Thermique et Energétique', 2),
(22, 'MIP', 'Maintenance Industrielle et Productique', 2),
(23, 'GCD', 'Génie Civil et Construction Durable', 4),
(24, 'MT', 'Mecatronique', 6),
(25, 'ETT', 'Electrotechnique', 7),
(26, 'MSE', 'Maintenance des Systemes Electroniques', 7),
(27, 'FC', 'Froid et Climatisation', 8),
(28, 'DTT', 'Dietetique', 3),
(29, 'GLO', 'Genie Logiciel', 1),
(30, 'TEL', 'Telecommunication', 9),
(31, 'CGE', 'Comptabilite et Gestion des Entreprises', 10),
(32, 'MCV', 'Marketing Communication Vente', 10),
(33, 'ABB', 'Analyses Biologiques et Biochimiques', 3),
(34, 'IA', 'Industrie Alimentaire', 3);

-- --------------------------------------------------------

--
-- Structure de la table `parcour_choisi`
--

CREATE TABLE `parcour_choisi` (
  `id_parcour_choisi` int(11) NOT NULL,
  `ordre_parcour_choisi` varchar(11) NOT NULL,
  `id_parcour` int(11) NOT NULL,
  `id_dossier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `parcour_choisi`
--

INSERT INTO `parcour_choisi` (`id_parcour_choisi`, `ordre_parcour_choisi`, `id_parcour`, `id_dossier`) VALUES
(1, '1', 1, 1),
(2, '1', 11, 2),
(3, '1', 1, 3),
(4, '1', 13, 4),
(5, '1', 14, 5),
(6, '1', 1, 6),
(7, '1', 27, 7),
(8, '1', 2, 8),
(9, '2', 3, 8),
(10, '3', 4, 8),
(11, '1', 30, 9),
(12, '1', 1, 10),
(13, '2', 12, 2),
(14, '1', 1, 11),
(15, '1', 1, 12),
(16, '1', 4, 13),
(17, '2', 2, 13),
(18, '3', 3, 13),
(19, '1', 13, 14),
(20, '1', 3, 15),
(21, '2', 4, 15),
(22, '3', 2, 15),
(23, '1', 13, 16),
(24, '1', 1, 17),
(25, '1', 14, 18),
(26, '1', 3, 19),
(27, '2', 4, 19),
(28, '3', 2, 19),
(29, '1', 1, 20),
(30, '1', 1, 21),
(31, '1', 14, 22),
(32, '1', 1, 23),
(33, '1', 14, 24),
(34, '1', 1, 25),
(35, '1', 14, 26),
(36, '1', 2, 27),
(37, '2', 3, 27),
(38, '3', 4, 27),
(39, '1', 11, 28),
(40, '2', 12, 28),
(41, '1', 3, 29),
(42, '2', 2, 29),
(43, '3', 4, 29),
(44, '1', 33, 30),
(45, '1', 1, 31);

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `id_pays` int(11) NOT NULL,
  `nom_pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`id_pays`, `nom_pays`) VALUES
(1, 'Cameroun'),
(2, 'Tchad'),
(3, 'Gabon'),
(4, 'Benin'),
(5, 'RCA'),
(6, 'RD Congo'),
(7, '(Autre)');

-- --------------------------------------------------------

--
-- Structure de la table `region_or`
--

CREATE TABLE `region_or` (
  `id_reg_or` int(11) NOT NULL,
  `nom_reg_or` varchar(50) NOT NULL,
  `id_pays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `region_or`
--

INSERT INTO `region_or` (`id_reg_or`, `nom_reg_or`, `id_pays`) VALUES
(1, 'Extrême-nord', 1),
(2, 'Nord', 1),
(3, 'Adamaoua', 1),
(4, 'Centre', 1),
(5, 'Littoral', 1),
(6, 'Sud', 1),
(7, 'Est', 1),
(8, 'Ouest', 1),
(9, 'Nord-ouest', 1),
(10, 'Sud-ouest', 1),
(11, '(Autre)', 4),
(12, '(Autre)', 6),
(13, '(Autre)', 2),
(14, '(Autre)', 5),
(15, '(Autre)', 3),
(16, '(Autre)', 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `statut` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0:inactif, 1:actif',
  `role` enum('admin','resp_delg') DEFAULT 'admin',
  `photo` varchar(255) DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `email`, `password`, `statut`, `role`, `photo`, `create_by`) VALUES
(7, 'Admin', 'Admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1', 'admin', '1601581471815.png', 2),
(12, 'Macbook', 'Pro', 'macbook@gmail.com', 'bbb084c3adf4a0fed82b7c4093f16fb7fb50f908', '1', 'admin', '1600277623524.jpg', 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id_candidat`),
  ADD KEY `id_reg_or` (`id_reg_or`);

--
-- Index pour la table `centre_examen`
--
ALTER TABLE `centre_examen`
  ADD PRIMARY KEY (`id_centre_examen`);

--
-- Index pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`id_cursus`),
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Index pour la table `cycle`
--
ALTER TABLE `cycle`
  ADD PRIMARY KEY (`id_cycle`);

--
-- Index pour la table `cycle_centre_examen`
--
ALTER TABLE `cycle_centre_examen`
  ADD PRIMARY KEY (`id_cycle_centre_examen`),
  ADD KEY `id_cycle` (`id_cycle`),
  ADD KEY `id_centre_examen` (`id_centre_examen`);

--
-- Index pour la table `cycle_parcours`
--
ALTER TABLE `cycle_parcours`
  ADD PRIMARY KEY (`id_cycle_parcour`),
  ADD KEY `id_cycle` (`id_cycle`,`id_parcour`),
  ADD KEY `id_parcour` (`id_parcour`);

--
-- Index pour la table `diplome`
--
ALTER TABLE `diplome`
  ADD PRIMARY KEY (`id_diplome`);

--
-- Index pour la table `diplome_entree`
--
ALTER TABLE `diplome_entree`
  ADD PRIMARY KEY (`id_diplome_entree`),
  ADD KEY `id_diplome` (`id_diplome`),
  ADD KEY `region_or` (`id_pays`);

--
-- Index pour la table `diplome_requis`
--
ALTER TABLE `diplome_requis`
  ADD PRIMARY KEY (`id_diplome_requis`),
  ADD KEY `id_parcour` (`id_parcour`),
  ADD KEY `id_diplome` (`id_diplome`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_doc`);

--
-- Index pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id_dossier`),
  ADD KEY `id_candidat` (`id_candidat`,`id_centre_examen`,`id_lieu_depot`,`id_paiement`),
  ADD KEY `id_lieu_depot` (`id_lieu_depot`),
  ADD KEY `id_centre_examen` (`id_centre_examen`),
  ADD KEY `id_paiement` (`id_paiement`),
  ADD KEY `id_diplome_entree` (`id_diplome_entree`);

--
-- Index pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD PRIMARY KEY (`id_emploi`),
  ADD KEY `id_candidat` (`id_candidat`);

--
-- Index pour la table `lieu_depot`
--
ALTER TABLE `lieu_depot`
  ADD PRIMARY KEY (`id_lieu_depot`);

--
-- Index pour la table `mention`
--
ALTER TABLE `mention`
  ADD PRIMARY KEY (`id_mention`);

--
-- Index pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  ADD PRIMARY KEY (`id_mode_paiement`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id_paiement`),
  ADD KEY `id_mode_paiement` (`id_mode_paiement`);

--
-- Index pour la table `param_concours`
--
ALTER TABLE `param_concours`
  ADD PRIMARY KEY (`id_param_concours`),
  ADD KEY `id_doc` (`id_doc`);

--
-- Index pour la table `parcour`
--
ALTER TABLE `parcour`
  ADD PRIMARY KEY (`id_parcour`),
  ADD KEY `id_mention` (`id_mention`);

--
-- Index pour la table `parcour_choisi`
--
ALTER TABLE `parcour_choisi`
  ADD PRIMARY KEY (`id_parcour_choisi`),
  ADD KEY `id_parcour` (`id_parcour`),
  ADD KEY `id_dossier` (`id_dossier`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`id_pays`);

--
-- Index pour la table `region_or`
--
ALTER TABLE `region_or`
  ADD PRIMARY KEY (`id_reg_or`),
  ADD KEY `id_pays` (`id_pays`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `create_by` (`create_by`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id_candidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `centre_examen`
--
ALTER TABLE `centre_examen`
  MODIFY `id_centre_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `cursus`
--
ALTER TABLE `cursus`
  MODIFY `id_cursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT pour la table `cycle`
--
ALTER TABLE `cycle`
  MODIFY `id_cycle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cycle_centre_examen`
--
ALTER TABLE `cycle_centre_examen`
  MODIFY `id_cycle_centre_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `cycle_parcours`
--
ALTER TABLE `cycle_parcours`
  MODIFY `id_cycle_parcour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `diplome`
--
ALTER TABLE `diplome`
  MODIFY `id_diplome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `diplome_entree`
--
ALTER TABLE `diplome_entree`
  MODIFY `id_diplome_entree` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `diplome_requis`
--
ALTER TABLE `diplome_requis`
  MODIFY `id_diplome_requis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id_dossier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `emploi`
--
ALTER TABLE `emploi`
  MODIFY `id_emploi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieu_depot`
--
ALTER TABLE `lieu_depot`
  MODIFY `id_lieu_depot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `mention`
--
ALTER TABLE `mention`
  MODIFY `id_mention` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `mode_paiement`
--
ALTER TABLE `mode_paiement`
  MODIFY `id_mode_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `param_concours`
--
ALTER TABLE `param_concours`
  MODIFY `id_param_concours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parcour`
--
ALTER TABLE `parcour`
  MODIFY `id_parcour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `parcour_choisi`
--
ALTER TABLE `parcour_choisi`
  MODIFY `id_parcour_choisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `id_pays` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `region_or`
--
ALTER TABLE `region_or`
  MODIFY `id_reg_or` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `candidat_ibfk_1` FOREIGN KEY (`id_reg_or`) REFERENCES `region_or` (`id_reg_or`);

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `cursus_ibfk_1` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`);

--
-- Contraintes pour la table `cycle_centre_examen`
--
ALTER TABLE `cycle_centre_examen`
  ADD CONSTRAINT `cycle_centre_examen_ibfk_1` FOREIGN KEY (`id_centre_examen`) REFERENCES `centre_examen` (`id_centre_examen`),
  ADD CONSTRAINT `cycle_centre_examen_ibfk_2` FOREIGN KEY (`id_cycle`) REFERENCES `cycle` (`id_cycle`);

--
-- Contraintes pour la table `cycle_parcours`
--
ALTER TABLE `cycle_parcours`
  ADD CONSTRAINT `cycle_parcours_ibfk_1` FOREIGN KEY (`id_parcour`) REFERENCES `parcour` (`id_parcour`),
  ADD CONSTRAINT `cycle_parcours_ibfk_2` FOREIGN KEY (`id_cycle`) REFERENCES `cycle` (`id_cycle`);

--
-- Contraintes pour la table `diplome_entree`
--
ALTER TABLE `diplome_entree`
  ADD CONSTRAINT `diplome_entree_ibfk_1` FOREIGN KEY (`id_diplome`) REFERENCES `diplome` (`id_diplome`),
  ADD CONSTRAINT `diplome_entree_ibfk_2` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`id_pays`);

--
-- Contraintes pour la table `diplome_requis`
--
ALTER TABLE `diplome_requis`
  ADD CONSTRAINT `diplome_requis_ibfk_2` FOREIGN KEY (`id_diplome`) REFERENCES `diplome` (`id_diplome`),
  ADD CONSTRAINT `diplome_requis_ibfk_3` FOREIGN KEY (`id_parcour`) REFERENCES `parcour` (`id_parcour`);

--
-- Contraintes pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD CONSTRAINT `dossier_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  ADD CONSTRAINT `dossier_ibfk_2` FOREIGN KEY (`id_lieu_depot`) REFERENCES `lieu_depot` (`id_lieu_depot`),
  ADD CONSTRAINT `dossier_ibfk_3` FOREIGN KEY (`id_centre_examen`) REFERENCES `centre_examen` (`id_centre_examen`),
  ADD CONSTRAINT `dossier_ibfk_4` FOREIGN KEY (`id_paiement`) REFERENCES `paiement` (`id_paiement`),
  ADD CONSTRAINT `dossier_ibfk_5` FOREIGN KEY (`id_diplome_entree`) REFERENCES `diplome_entree` (`id_diplome_entree`);

--
-- Contraintes pour la table `emploi`
--
ALTER TABLE `emploi`
  ADD CONSTRAINT `emploi_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`id_mode_paiement`) REFERENCES `mode_paiement` (`id_mode_paiement`);

--
-- Contraintes pour la table `param_concours`
--
ALTER TABLE `param_concours`
  ADD CONSTRAINT `param_concours_ibfk_1` FOREIGN KEY (`id_doc`) REFERENCES `document` (`id_doc`);

--
-- Contraintes pour la table `parcour`
--
ALTER TABLE `parcour`
  ADD CONSTRAINT `parcour_ibfk_1` FOREIGN KEY (`id_mention`) REFERENCES `mention` (`id_mention`);

--
-- Contraintes pour la table `parcour_choisi`
--
ALTER TABLE `parcour_choisi`
  ADD CONSTRAINT `parcour_choisi_ibfk_1` FOREIGN KEY (`id_parcour`) REFERENCES `parcour` (`id_parcour`),
  ADD CONSTRAINT `parcour_choisi_ibfk_2` FOREIGN KEY (`id_dossier`) REFERENCES `dossier` (`id_dossier`);

--
-- Contraintes pour la table `region_or`
--
ALTER TABLE `region_or`
  ADD CONSTRAINT `region_or_ibfk_1` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`id_pays`);
