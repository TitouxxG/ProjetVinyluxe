-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 21 déc. 2020 à 13:14
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_admin`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `Name` varchar(50) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Categorie` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tbl_users` (`name`, `prix`, `categorie`, `etat`) VALUES
(1, 'chocolat', '100', 'parfun', 1),
(2, 'fraise', '50', 'parfun', 0),
(3, 'vinyle', '70', 'parfun', 1);
-- --------------------------------------------------------

--
-- Structure de la table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'role_id',
  `role` varchar(255) DEFAULT NULL COMMENT 'role_text',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `roleid` tinyint(4) DEFAULT NULL,
  `isActive` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `email`, `password`, `mobile`, `roleid`, `isActive`, `created_at`, `updated_at`) VALUES
(23, 'achref', 'achref', 'achref.nefzazoui@gmail.com', '3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138', '54852852', 1, 0, '2020-12-19 14:35:56', '2020-12-19 14:35:56'),
(24, 'ahmed', 'benahmed', 'achme@gmail.com', '7f0c9d56d40c3cc1e23e0113d5377779a4de86ff', '54277528', 3, 0, '2020-12-19 15:13:39', '2020-12-19 15:13:39'),
(25, 'Fathi', 'fathiA', 'fathianh@gmail.com', '0a859b9a4ebbde4f63383bca7e34890985782348', '54672828', 3, 0, '2020-12-19 15:15:52', '2020-12-19 15:15:52'),
(26, 'Makrem', 'makrem', 'makrem@gmail.com', 'adef7009a84a71c226ddf68671e929d68a707762', '42551771', 3, 0, '2020-12-19 15:16:59', '2020-12-19 15:16:59'),
(27, 'Sirin', 'Sirin', 'Sirin@gmail.com', '03ee5fda2eae80be34c0142fe28ac6401e63324c', '23451671', 3, 0, '2020-12-19 15:17:34', '2020-12-19 15:17:34');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




DROP TABLE IF EXISTS `tbl_clients`;
CREATE TABLE IF NOT EXISTS `tbl_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `text` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  
)


INSERT INTO `tbl_clients` (`id`, `name`, `username`, `email`, `address`, `text`,`password`) VALUES
(23, 'achref', 'achref', 'achref.nefzazoui@gmail.com','rohero_2' , 'lalsi', '3ea543d29ad3c1c09fcfbdda3f2f0617c50ab138'),
(24, 'ahmed', 'benahmed', 'achme@gmail.com','kinindo1', 'cakoli','7f0c9d56d40c3cc1e23e0113d5377779a4de86ff'),
(25, 'Fathi', 'fathiA', 'fathianh@gmail.com','Gatoki_2', 'kokota','0a859b9a4ebbde4f63383bca7e34890985782348'),
(26, 'Makrem', 'makrem', 'makrem@gmail.com','kigobe4', 'titka','adef7009a84a71c226ddf68671e929d68a707762'),
(27, 'Sirin', 'Sirin', 'Sirin@gmail.com', 'Musaga1','keza','03ee5fda2eae80be34c0142fe28ac6401e63324c');
COMMIT;


DROP TABLE IF EXISTS `tbl_panier`;
CREATE TABLE IF NOT EXISTS `tbl_panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` varchar(255) DEFAULT NULL,
  `prix_panier` int(25) DEFAULT NULL
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
)
INSERT INTO `tbl_panier` (`id`, `quantite`, `prix_panier`,`created_at`) VALUES
(3, '100Kg', 10000,'2020-12-19 15:17:34'),
(4, '900Kg', 50000,'2020-09-19 15:17:34');

DROP TABLE IF EXISTS `tbl_commande`;
CREATE TABLE IF NOT EXISTS `tbl_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut_com` int(25) DEFAULT NULL,
  `prix_com` int(25) DEFAULT NULL,
  `created_at` timestamp NOT NULL
)

INSERT INTO 'tbl_commande' (`id`,'statut_com`, `prix_com`,`created_at`) VALUES
                          ('1,'Kg',5000,'2020-09-19'),
                          (2,'Kg',1000,'2020-10-29');


DROP TABLE IF EXISTS `tbl_paiement`;
CREATE TABLE IF NOT EXISTS `tbl_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `montant` int(15) DEFAULT NULL,
  `date_paie` date DEFAULT NULL
)
INSERT INTO `tbl_paiement`(`id`, 'montant`, `date_paie`) VALUES
(1,3000,'2020-12-19'),
(2,800,'2020-09-19');

