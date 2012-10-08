-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 07 Octobre 2012 à 17:24
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `up`
--

-- --------------------------------------------------------

--
-- Structure de la table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `alias` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT '[menu,element]',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `alias`, `type`) VALUES
(1, 'Menu manager', 'menu_manager', 'menu'),
(2, 'Menu public', 'menu_public', 'menu'),
(3, 'Element droit', 'element_droit', 'element');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `blocks_id` int(10) DEFAULT NULL,
  `plugins_id` int(10) DEFAULT NULL,
  `articles_id` int(10) DEFAULT NULL,
  `order` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `blocks_id`, `plugins_id`, `articles_id`, `order`, `is_active`, `parent_id`, `lft`, `rght`) VALUES
(1, 'Modules', 1, 49, NULL, 1, 1, 0, 1, 4),
(2, 'Gestion des modules', 1, 49, NULL, 2, 1, 1, 2, 3),
(3, 'Menus', 1, 55, NULL, 3, 1, 0, 5, 10),
(4, 'Gestion des menus', 1, 55, NULL, 5, 1, 3, 6, 7),
(5, 'Ajouter un menu', 1, 55, NULL, 4, 1, 3, 8, 9);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `plugins_id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `version` varchar(45) NOT NULL,
  `site` varchar(45) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `plugins_id`, `name`, `description`, `author`, `version`, `site`, `url`, `is_active`) VALUES
(17, 49, 'Module manager', 'Permet l''installation de modules complémentai', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(18, 53, 'Manager block', 'Permet la création et la gestion d''emplacemen', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(19, 54, 'Manager menu', 'Permet la création de menus', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `prefix` varchar(45) NOT NULL,
  `plugin` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL DEFAULT 'index',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Contenu de la table `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `prefix`, `plugin`, `controller`, `action`, `parent_id`, `is_main`, `is_active`) VALUES
(49, 'Manager Index', 'manager', 'module', 'module', 'installer', 0, 1, 1),
(50, 'Manager Installer', 'manager', 'module', 'module', 'add', 49, 0, 1),
(51, 'Manager Uninstall', 'manager', 'module', 'module', 'uninstall', 49, 0, 1),
(52, 'Ajax Activate', 'ajax', 'module', 'module', 'activate', 49, 0, 1),
(53, 'Manager Blocks', 'manager', 'block', 'block', 'index', 0, 1, 1),
(54, 'Manager Index', 'manager', 'menu', 'menu', 'index', 0, 1, 1),
(55, 'Manager add', 'manager', 'menu', 'menu', 'add', 54, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
