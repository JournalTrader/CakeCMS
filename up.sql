-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 25 Octobre 2012 à 11:52
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Plugin', 1, 'module/module/manager_index', 1, 2),
(2, NULL, 'Plugin', 2, 'module/module/manager_insatller', 3, 4),
(3, NULL, 'Plugin', 3, 'module/module/manager_uninstall', 5, 6),
(4, NULL, 'Plugin', 4, 'module/module/ajax_activate', 7, 8),
(5, NULL, 'Plugin', 5, 'block/block/manager_index', 9, 10),
(6, NULL, 'Plugin', 6, 'block/block/manager_add', 11, 12),
(7, NULL, 'Plugin', 7, 'menu/menu/manager_index', 13, 14),
(8, NULL, 'Plugin', 8, 'menu/menu/manager_add', 15, 16),
(9, NULL, 'Plugin', 13, 'blog/blog/manager_index', 17, 18),
(10, NULL, 'Plugin', 14, 'blog/blog/manager_add', 19, 20),
(11, NULL, 'Plugin', 15, 'blog/article/manager_index', 21, 22),
(12, NULL, 'Plugin', 16, 'blog/article/manager_add', 23, 24),
(13, NULL, 'Plugin', 17, 'blog/category/manager_index', 25, 26),
(14, NULL, 'Plugin', 18, 'blog/category/manager_add', 27, 28),
(15, NULL, 'Plugin', 19, 'blog/category/block_category', 29, 30),
(16, NULL, 'Plugin', 20, 'blog/tag/manager_index', 31, 32),
(17, NULL, 'Plugin', 21, 'blog/tag/manager_add', 33, 34),
(18, NULL, 'Plugin', 22, 'tinymce/tinymce/manager_index', 35, 36),
(19, NULL, 'Plugin', 23, 'tinymce/tinymce/block_head', 37, 38),
(20, NULL, 'Plugin', 24, 'seo/seo/manager_index', 39, 40),
(21, NULL, 'Plugin', 25, 'seo/seo/block_form', 41, 42),
(22, NULL, 'Plugin', 28, 'media/media/manager_index', 43, 44),
(23, NULL, 'Plugin', 29, 'media/media/manager_add', 45, 46),
(24, NULL, 'Plugin', 30, 'user/user/manager_index', 47, 48),
(25, NULL, 'Plugin', 31, 'user/user/manager_add', 49, 50),
(26, NULL, 'Plugin', 32, 'user/user/manager_login', 51, 52),
(27, NULL, 'Plugin', 33, 'user/user/manager_logout', 53, 54),
(28, NULL, 'Plugin', 34, 'user/user/block_vertical_login', 55, 56),
(29, NULL, 'Plugin', 35, 'user/user/block_horizontal_login', 57, 58),
(30, NULL, 'Plugin', 48, 'acl/acl/manager_index', 59, 60),
(31, NULL, 'Plugin', 49, 'acl/groupe/manager_index', 61, 62),
(32, NULL, 'Plugin', 50, 'acl/groupe/manager_add', 63, 64),
(33, NULL, 'Plugin', 51, 'acl/groupe/block_permission', 65, 66),
(34, NULL, 'Plugin', 52, 'page/page/manager_index', 67, 68),
(35, NULL, 'Plugin', 53, 'page/page/manager_add', 69, 70);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Groupe', 1, '', 1, 4),
(2, NULL, 'Groupe', 2, '', 5, 8),
(3, NULL, 'Groupe', 3, '', 9, 10),
(4, 1, 'User', 1, '', 2, 3),
(5, 2, 'User', 2, '', 6, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Contenu de la table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 1, 2, '1', '1', '1', '1'),
(3, 1, 3, '1', '1', '1', '1'),
(4, 1, 4, '1', '1', '1', '1'),
(5, 1, 5, '1', '1', '1', '1'),
(6, 1, 6, '1', '1', '1', '1'),
(7, 1, 7, '1', '1', '1', '1'),
(8, 1, 8, '1', '1', '1', '1'),
(9, 1, 9, '1', '1', '1', '1'),
(10, 1, 10, '1', '1', '1', '1'),
(11, 1, 11, '1', '1', '1', '1'),
(12, 1, 12, '1', '1', '1', '1'),
(13, 1, 13, '1', '1', '1', '1'),
(14, 1, 14, '1', '1', '1', '1'),
(15, 1, 15, '1', '1', '1', '1'),
(16, 1, 16, '1', '1', '1', '1'),
(17, 1, 17, '1', '1', '1', '1'),
(18, 1, 18, '1', '1', '1', '1'),
(19, 1, 19, '1', '1', '1', '1'),
(20, 1, 20, '1', '1', '1', '1'),
(21, 1, 21, '1', '1', '1', '1'),
(22, 1, 22, '1', '1', '1', '1'),
(23, 1, 23, '1', '1', '1', '1'),
(24, 1, 24, '1', '1', '1', '1'),
(25, 1, 25, '1', '1', '1', '1'),
(26, 1, 26, '1', '1', '1', '1'),
(27, 1, 27, '1', '1', '1', '1'),
(28, 1, 28, '1', '1', '1', '1'),
(29, 1, 29, '1', '1', '1', '1'),
(30, 1, 30, '1', '1', '1', '1'),
(31, 1, 31, '1', '1', '1', '1'),
(32, 1, 32, '1', '1', '1', '1'),
(33, 1, 33, '1', '1', '1', '1'),
(34, 1, 34, '1', '1', '1', '1'),
(35, 1, 35, '1', '1', '1', '1'),
(36, 2, 1, '-1', '-1', '-1', '-1'),
(37, 2, 2, '-1', '-1', '-1', '-1'),
(38, 2, 3, '-1', '-1', '-1', '-1'),
(39, 2, 4, '-1', '-1', '-1', '-1'),
(40, 2, 5, '-1', '-1', '-1', '-1'),
(41, 2, 6, '-1', '-1', '-1', '-1'),
(42, 2, 7, '-1', '-1', '-1', '-1'),
(43, 2, 8, '-1', '-1', '-1', '-1'),
(44, 2, 9, '-1', '-1', '-1', '-1'),
(45, 2, 10, '-1', '-1', '-1', '-1'),
(46, 2, 11, '-1', '-1', '-1', '-1'),
(47, 2, 12, '-1', '-1', '-1', '-1'),
(48, 2, 13, '-1', '-1', '-1', '-1'),
(49, 2, 14, '-1', '-1', '-1', '-1'),
(50, 2, 15, '-1', '-1', '-1', '-1'),
(51, 2, 16, '-1', '-1', '-1', '-1'),
(52, 2, 17, '-1', '-1', '-1', '-1'),
(53, 2, 18, '-1', '-1', '-1', '-1'),
(54, 2, 19, '-1', '-1', '-1', '-1'),
(55, 2, 20, '-1', '-1', '-1', '-1'),
(56, 2, 21, '-1', '-1', '-1', '-1'),
(57, 2, 22, '-1', '-1', '-1', '-1'),
(58, 2, 23, '-1', '-1', '-1', '-1'),
(59, 2, 24, '-1', '-1', '-1', '-1'),
(60, 2, 25, '-1', '-1', '-1', '-1'),
(61, 2, 26, '-1', '-1', '-1', '-1'),
(62, 2, 27, '-1', '-1', '-1', '-1'),
(63, 2, 28, '-1', '-1', '-1', '-1'),
(64, 2, 29, '-1', '-1', '-1', '-1'),
(65, 2, 30, '-1', '-1', '-1', '-1'),
(66, 2, 31, '-1', '-1', '-1', '-1'),
(67, 2, 32, '-1', '-1', '-1', '-1'),
(68, 2, 33, '-1', '-1', '-1', '-1'),
(69, 2, 34, '-1', '-1', '-1', '-1'),
(70, 2, 35, '-1', '-1', '-1', '-1'),
(71, 3, 1, '-1', '-1', '-1', '-1'),
(72, 3, 2, '-1', '-1', '-1', '-1'),
(73, 3, 3, '-1', '-1', '-1', '-1'),
(74, 3, 4, '-1', '-1', '-1', '-1'),
(75, 3, 5, '-1', '-1', '-1', '-1'),
(76, 3, 6, '-1', '-1', '-1', '-1'),
(77, 3, 7, '-1', '-1', '-1', '-1'),
(78, 3, 8, '-1', '-1', '-1', '-1'),
(79, 3, 9, '-1', '-1', '-1', '-1'),
(80, 3, 10, '-1', '-1', '-1', '-1'),
(81, 3, 11, '-1', '-1', '-1', '-1'),
(82, 3, 12, '-1', '-1', '-1', '-1'),
(83, 3, 13, '-1', '-1', '-1', '-1'),
(84, 3, 14, '-1', '-1', '-1', '-1'),
(85, 3, 15, '-1', '-1', '-1', '-1'),
(86, 3, 16, '-1', '-1', '-1', '-1'),
(87, 3, 17, '-1', '-1', '-1', '-1'),
(88, 3, 18, '-1', '-1', '-1', '-1'),
(89, 3, 19, '-1', '-1', '-1', '-1'),
(90, 3, 20, '-1', '-1', '-1', '-1'),
(91, 3, 21, '-1', '-1', '-1', '-1'),
(92, 3, 22, '-1', '-1', '-1', '-1'),
(93, 3, 23, '-1', '-1', '-1', '-1'),
(94, 3, 24, '-1', '-1', '-1', '-1'),
(95, 3, 25, '-1', '-1', '-1', '-1'),
(96, 3, 26, '1', '1', '1', '1'),
(97, 3, 27, '1', '1', '1', '1'),
(98, 3, 28, '-1', '-1', '-1', '-1'),
(99, 3, 29, '-1', '-1', '-1', '-1'),
(100, 3, 30, '-1', '-1', '-1', '-1'),
(101, 3, 31, '-1', '-1', '-1', '-1'),
(102, 3, 32, '-1', '-1', '-1', '-1'),
(103, 3, 33, '-1', '-1', '-1', '-1'),
(104, 3, 34, '-1', '-1', '-1', '-1'),
(105, 3, 35, '-1', '-1', '-1', '-1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `created`, `modified`, `status`) VALUES
(1, 'Lorem est cool !', '<p><a title="Google" href="http://www.google.com/" target="_blank"><img class="align-left" src="/files/2012/10/1350899187.jpeg" border="0" width="272" height="194" data-src="webroot/files/2012/10/1350899187.jpeg" data-category="picture" data-id="6" /></a></p>\r\n<p>Le Lorem Ipsum est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n''a pas fait que survivre cinq si&egrave;cles, mais s''est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n''en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>\r\n<p><img class="align-center" src="http://i.ytimg.com/vi/BROgD_ZdBng/default.jpg" border="0" width="273" height="205" data-src="http://www.youtube.com/watch?v=BROgD_ZdBng&amp;feature=g-all-xit" data-category="video" data-id="11" /></p>', '2012-10-23 09:27:03', '2012-10-23 10:16:11', 0),
(2, 'Lorem est cool !', '<p>Le Lorem Ipsum est simplement du faux texte employ&eacute; dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les ann&eacute;es 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour r&eacute;aliser un livre sp&eacute;cimen de polices de texte. Il n''a pas fait que survivre cinq si&egrave;cles, mais s''est aussi adapt&eacute; &agrave; la bureautique informatique, sans que son contenu n''en soit modifi&eacute;. Il a &eacute;t&eacute; popularis&eacute; dans les ann&eacute;es 1960 gr&acirc;ce &agrave; la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus r&eacute;cemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>', '2012-10-23 09:26:43', '2012-10-23 09:26:43', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `blocks`
--

INSERT INTO `blocks` (`id`, `name`, `alias`, `type`) VALUES
(1, 'Menu manager', 'menu_manager', 'menu'),
(2, 'Menu public', 'menu_public', 'menu'),
(3, 'Element droit', 'element_droit', 'element'),
(4, 'Menu 1', 'menu_1', 'menu'),
(5, 'Block 1', 'block_1', 'element'),
(6, 'Block 2', 'block_2', 'element'),
(7, 'Head block', 'head_block', 'element'),
(8, 'Block permissions', 'block_permissions', 'element'),
(9, 'Block account', 'block_account', 'menu');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `elements`
--

INSERT INTO `elements` (`id`, `name`, `plugins_id`, `blocks_id`, `display`, `display_absolute`) VALUES
(1, 'Scripts de tinymce', 23, 7, 0, 0),
(2, 'Activation des permissions', 51, 8, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `groupes`
--

INSERT INTO `groupes` (`id`, `name`, `order`, `created`, `modified`) VALUES
(1, 'Administrateur', 1, '2012-10-23 16:56:07', '2012-10-23 16:56:07'),
(2, 'Membre', 2, '2012-10-23 16:56:32', '2012-10-23 16:56:32'),
(3, 'Visiteur', 3, '2012-10-23 16:56:48', '2012-10-23 16:56:48');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id`, `name`, `src`, `size`, `type`, `category`, `description`, `location`, `created`, `modified`) VALUES
(5, 'Jean Pierre Jacob', 'webroot/files/2012/10/1350899130.pdf', 13859346, 'pdf', 'file', '', 'local', '2012-10-22 11:45:30', '2012-10-22 11:45:30'),
(6, 'Google Chrome Logo', 'webroot/files/2012/10/1350899187.jpeg', 24613, 'jpeg', 'picture', '', 'local', '2012-10-22 11:46:27', '2012-10-22 11:46:27'),
(11, 'Ok', 'http://www.youtube.com/watch?v=BROgD_ZdBng&feature=g-all-xit', 0, 'jpg', 'video', '', 'extern', '2012-10-22 12:15:05', '2012-10-22 12:15:05'),
(12, 'Plus belles vidéos', 'http://www.dailymotion.com/video/xih530_resultat-du-concours-vos-plus-belles-creations_creation', 0, 'jpg', 'video', '', 'extern', '2012-10-22 12:15:40', '2012-10-22 12:15:40'),
(13, '63079bc141049b9163eeba2aa98870bc.zip', 'webroot/files/2012/10/1350901073.zip', 617274, 'zip', 'file', NULL, 'local', '2012-10-22 12:17:53', '2012-10-22 12:17:53'),
(14, '63079bc141049b9163eeba2aa98870bc.zip', 'webroot/files/2012/10/1350901144.zip', 617274, 'zip', 'file', NULL, 'local', '2012-10-22 12:19:04', '2012-10-22 12:19:04'),
(15, '63079bc141049b9163eeba2aa98870bc.zip', 'webroot/files/2012/10/1350901175.zip', 617274, 'zip', 'file', NULL, 'local', '2012-10-22 12:19:35', '2012-10-22 12:19:35'),
(16, 'Plupload_1_5_4.zip', 'webroot/files/2012/10/1350901299.zip', 242032, 'zip', 'file', NULL, 'local', '2012-10-22 12:21:39', '2012-10-22 12:21:39'),
(17, 'Abstract_spring_background_148740.zip', 'webroot/files/2012/10/1350901437.zip', 2095176, 'zip', 'file', NULL, 'local', '2012-10-22 12:23:57', '2012-10-22 12:23:57'),
(18, 'Abstract_spring_background_148740.zip', 'webroot/files/2012/10/1350901466.zip', 2095176, 'zip', 'file', NULL, 'local', '2012-10-22 12:24:26', '2012-10-22 12:24:26'),
(19, 'Abstract_spring_background_148740.zip', 'webroot/files/2012/10/1350901486.zip', 2095176, 'zip', 'file', NULL, 'local', '2012-10-22 12:24:46', '2012-10-22 12:24:46'),
(20, 'Test', 'http://vimeo.com/51036089', 0, 'jpg', 'video', '', 'extern', '2012-10-22 12:27:44', '2012-10-22 12:27:44'),
(21, 'Test', 'http://vimeo.com/47028930', 0, 'jpg', 'video', '', 'extern', '2012-10-22 12:40:08', '2012-10-22 12:40:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Contenu de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `blocks_id`, `plugins_id`, `articles_id`, `order`, `is_active`, `parent_id`, `lft`, `rght`, `display`, `display_absolute`) VALUES
(1, 'Modules', 1, 1, NULL, 2, 1, 0, 1, 2, 0, 0),
(2, 'Blocks', 1, 5, NULL, 3, 1, 0, 3, 8, 0, 0),
(3, 'Menus', 1, 7, NULL, 6, 1, 0, 9, 14, 0, 0),
(4, 'Gestion de menus', 1, 7, NULL, 7, 1, 3, 10, 11, 0, 0),
(5, 'Ajouter un menu', 1, 8, NULL, 8, 1, 3, 12, 13, 0, 0),
(6, 'Gestion de blocks', 1, 5, NULL, 4, 1, 2, 4, 5, 0, 0),
(7, 'Ajouter un block', 1, 6, NULL, 5, 1, 2, 6, 7, 0, 0),
(8, 'CMS', 1, 13, NULL, 1, 0, 0, 15, 20, 0, 0),
(9, 'Gestion du blog', 1, 13, NULL, 9, 0, 8, 16, 17, 0, 0),
(10, 'Gestion des médias', 1, 28, NULL, 10, 0, 8, 18, 19, 0, 0),
(11, 'Ajouter un média', 4, 29, NULL, 11, 0, 0, 21, 22, 28, 0),
(13, 'Articles', 4, 15, NULL, 14, 1, 0, 23, 28, 13, 0),
(14, 'Gestion des articles', 4, 15, NULL, 17, 1, 13, 24, 25, 13, 0),
(15, 'Ajouter un article', 4, 16, NULL, 16, 1, 13, 26, 27, 13, 0),
(16, 'Utilisateurs', 1, 30, NULL, 18, 0, 0, 29, 36, 0, 0),
(17, 'Gestion des utilisateurs', 1, 30, NULL, 19, 0, 16, 30, 31, 0, 0),
(18, 'Ajouter un utilisateur', 1, 31, NULL, 21, 0, 16, 32, 33, 0, 0),
(25, 'Gestion des permissions', 1, 48, NULL, 22, 0, 16, 34, 35, 0, 0),
(26, 'Gestion des groupes', 4, 49, NULL, 23, 0, 0, 37, 42, 48, 0),
(27, 'Liste des groupes', 4, 49, NULL, 24, 0, 26, 38, 39, 48, 0),
(28, 'Ajouter un groupe', 4, 50, NULL, 25, 0, 26, 40, 41, 0, 0),
(29, 'Déconnexion', 9, 33, NULL, 26, 1, 0, 43, 44, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `modules`
--

INSERT INTO `modules` (`id`, `plugins_id`, `name`, `description`, `author`, `version`, `site`, `url`, `is_active`) VALUES
(1, 1, 'Module manager', 'Permet l''installation de modules complémentai', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(2, 5, 'Manager block', 'Permet la création et la gestion d''emplacemen', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(3, 7, 'Manager menu', 'Permet la création de menus', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(6, 13, 'Blog manager', 'Permet la gestion d''un blog.', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(7, 22, 'Tinymce manager', 'Permet de gérer Tinymce.', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(8, 24, 'Seo manager', 'Permet l''installation de module pour la gesti', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(10, 28, 'Media manager', 'Permet de gérer les médias.', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(11, 30, 'User manager', 'Permet l''installation de module pour la gesti', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(17, 48, 'Acl manager', 'Permet l''installation de module pour la gesti', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1),
(18, 52, 'Page manager', 'Permet l''installation de modules pour le gest', 'MORICET Nicolas', '1.0.0', 'Mon super CMS', 'http://www.cms.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `options`
--

INSERT INTO `options` (`key`, `value`) VALUES
('tinymce', '[{"field":"ArticleContent","plugin":"16"}]');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

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
(8, 'Manager add', 'manager', 'menu', 'menu', 'add', 7, 0, 1),
(13, 'Blog Manager Index', 'manager', 'blog', 'blog', 'index', 0, 1, 1),
(14, 'Blog Manager add', 'manager', 'blog', 'blog', 'add', 13, 0, 1),
(15, 'Article Manager Index', 'manager', 'blog', 'article', 'index', 13, 0, 1),
(16, 'Article Manager add', 'manager', 'blog', 'article', 'add', 13, 0, 1),
(17, 'Category Manager Index', 'manager', 'blog', 'category', 'index', 13, 0, 1),
(18, 'Category Manager add', 'manager', 'blog', 'category', 'add', 13, 0, 1),
(19, 'Category Manager add', 'block', 'blog', 'category', 'category', 13, 0, 1),
(20, 'Tag Manager Index', 'manager', 'blog', 'tag', 'index', 13, 0, 1),
(21, 'Tag Manager add', 'manager', 'blog', 'tag', 'add', 13, 0, 1),
(22, 'Tinymce Index', 'manager', 'tinymce', 'tinymce', 'index', 0, 1, 1),
(23, 'Block head tinymce', 'block', 'tinymce', 'tinymce', 'head', 22, 0, 1),
(24, 'Seo Index', 'manager', 'seo', 'seo', 'index', 0, 1, 1),
(25, 'Block add in form', 'block', 'seo', 'seo', 'form', 24, 0, 1),
(28, 'Media Index', 'manager', 'media', 'media', 'index', 0, 1, 1),
(29, 'Media add', 'manager', 'media', 'media', 'add', 28, 0, 1),
(30, 'User Index', 'manager', 'user', 'user', 'index', 0, 1, 1),
(31, 'User add', 'manager', 'user', 'user', 'add', 30, 0, 1),
(32, 'Login', 'manager', 'user', 'user', 'login', 30, 0, 1),
(33, 'Logout', 'manager', 'user', 'user', 'logout', 30, 0, 1),
(34, 'Login block vertical', 'block', 'user', 'user', 'vertical_login', 30, 0, 1),
(35, 'Login block horizontal', 'block', 'user', 'user', 'horizontal_login', 30, 0, 1),
(48, 'ACL Index', 'manager', 'acl', 'acl', 'index', 0, 1, 1),
(49, 'ACL Groupe', 'manager', 'acl', 'groupe', 'index', 48, 0, 1),
(50, 'ACL Add Groupe', 'manager', 'acl', 'groupe', 'add', 48, 0, 1),
(51, 'Block activation des permissions', 'block', 'acl', 'groupe', 'permission', 48, 0, 1),
(52, 'Page Index', 'manager', 'page', 'page', 'index', 0, 1, 1),
(53, 'Page add', 'manager', 'page', 'page', 'add', 52, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `profiles`
--

INSERT INTO `profiles` (`id`, `users_id`, `last_name`, `first_name`, `created`, `modified`) VALUES
(1, 1, 'MORICET', 'Nicolas', '2012-10-24 12:04:32', '2012-10-24 12:04:32'),
(2, 2, 'MOMO', 'Nino', '2012-10-25 10:29:46', '2012-10-25 10:29:46');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `groupes_id`, `mail`, `password`, `last_login`, `created`, `modified`) VALUES
(1, 1, 'nicolas.moricet@altal-editions.fr', '572a50c84643e7b5cc21e4e066940e753028705d', '0000-00-00 00:00:00', '2012-10-24 12:04:32', '2012-10-24 12:04:32'),
(2, 2, 'bibi@free.fr', '572a50c84643e7b5cc21e4e066940e753028705d', '0000-00-00 00:00:00', '2012-10-25 10:29:46', '2012-10-25 10:29:46');
