-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 26 Octobre 2012 à 10:41
-- Version du serveur: 5.5.25
-- Version de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `up`
--

-- --------------------------------------------------------

--
-- Structure de la table `acos`
--

CREATE TABLE `acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `aros`
--

CREATE TABLE `aros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT '',
  `foreign_key` int(10) unsigned DEFAULT NULL,
  `alias` varchar(255) DEFAULT '',
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `aros_acos`
--

CREATE TABLE `aros_acos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) unsigned NOT NULL,
  `aco_id` int(10) unsigned NOT NULL,
  `_create` char(2) NOT NULL DEFAULT '0',
  `_read` char(2) NOT NULL DEFAULT '0',
  `_update` char(2) NOT NULL DEFAULT '0',
  `_delete` char(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `blocks`
--

CREATE TABLE `blocks` (
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
-- Structure de la table `elements`
--

CREATE TABLE `elements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `plugins_id` int(10) NOT NULL,
  `blocks_id` int(10) NOT NULL,
  `display` int(10) NOT NULL DEFAULT '0',
  `display_absolute` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`plugins_id`,`blocks_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `order` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `src` varchar(255) NOT NULL,
  `size` int(10) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` mediumtext,
  `location` varchar(50) NOT NULL COMMENT '[local,extern]',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
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
  `display` int(10) NOT NULL DEFAULT '0',
  `display_absolute` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `blocks_id`, `plugins_id`, `articles_id`, `order`, `is_active`, `parent_id`, `lft`, `rght`, `display`, `display_absolute`) VALUES
(1, 'Modules', 1, 1, NULL, 1, 1, 0, 1, 2, 0, 0),
(2, 'Blocks', 1, 5, NULL, 2, 1, 0, 3, 8, 0, 0),
(3, 'Menus', 1, 7, NULL, 3, 1, 0, 9, 14, 0, 0),
(4, 'Gestion de menus', 1, 7, NULL, 4, 1, 3, 10, 11, 0, 0),
(5, 'Ajouter un menu', 1, 8, NULL, 5, 1, 3, 12, 13, 0, 0),
(6, 'Gestion de blocks', 1, 5, NULL, 6, 1, 2, 4, 5, 0, 0),
(7, 'Ajouter un block', 1, 6, NULL, 7, 1, 2, 6, 7, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `plugins_id`, `name`, `description`, `author`, `version`, `site`, `url`, `is_active`) VALUES
(1, 1, 'Module manager', 'Permet l''installation et la gestion des modul', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(2, 5, 'Manager block', 'Permet de créer et de gérer les emplacements ', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(3, 7, 'Manager menu', 'Permet la création et la gestion des menus.', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `plugins`
--

CREATE TABLE `plugins` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `prefix`, `plugin`, `controller`, `action`, `parent_id`, `is_main`, `is_active`) VALUES
(1, 'Manager Index', 'manager', 'module', 'module', 'index', 0, 1, 1),
(2, 'Manager Installer', 'manager', 'module', 'module', 'insatller', 1, 0, 1),
(3, 'Manager Uninstall', 'manager', 'module', 'module', 'uninstall', 1, 0, 1),
(4, 'Ajax Activate', 'ajax', 'module', 'module', 'activate', 1, 0, 1),
(5, 'Manager Blocks', 'manager', 'block', 'block', 'index', 0, 1, 1),
(6, 'Block Add', 'manager', 'block', 'block', 'add', 5, 0, 1),
(7, 'Manager Index', 'manager', 'menu', 'menu', 'index', 0, 1, 1),
(8, 'Manager add', 'manager', 'menu', 'menu', 'add', 7, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(45) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`,`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `seo`
--

CREATE TABLE `seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` mediumtext NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `table_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT '[category,tag]',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  PRIMARY KEY (`id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `terms_taxonomies`
--

CREATE TABLE `terms_taxonomies` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `terms_id` int(10) NOT NULL,
  `model_id` int(10) NOT NULL,
  `model` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`terms_id`,`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupes_id` int(10) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`,`groupes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
