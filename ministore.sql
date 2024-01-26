-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 jan. 2024 à 09:30
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
-- Base de données : `ministore`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `type`) VALUES
(1, 'Mobile'),
(2, 'Watch'),
(3, 'Earphones'),
(4, 'Gaming');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240105180837', '2024-01-05 18:08:49', 185),
('DoctrineMigrations\\Version20240108092839', '2024-01-08 09:28:52', 44),
('DoctrineMigrations\\Version20240112082030', '2024-01-12 08:20:46', 40),
('DoctrineMigrations\\Version20240115075118', '2024-01-15 07:51:33', 38),
('DoctrineMigrations\\Version20240115081701', '2024-01-15 08:17:07', 25),
('DoctrineMigrations\\Version20240115082910', '2024-01-15 08:29:12', 18),
('DoctrineMigrations\\Version20240115085325', '2024-01-15 08:53:29', 18),
('DoctrineMigrations\\Version20240116084113', '2024-01-16 08:41:17', 31);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category_id` int NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_1F1B251E12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`id`, `name`, `brand`, `price`, `quantity`, `created_at`, `category_id`, `picture`, `description`) VALUES
(1, 'Iphone 10', 'Apple', 980, 0, '2024-01-04 10:25:02', 1, 'product-item1.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(2, 'Iphone 11', 'Apple', 1100, 12, '2024-01-04 10:25:46', 1, 'product-item2.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(3, 'Iphone 8', 'Apple', 780, 15, '2024-01-04 10:26:04', 1, 'product-item3.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(4, 'Iphone 13', 'Apple', 1500, 0, '2024-01-04 10:26:31', 1, 'product-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(5, 'Iphone 12', 'Apple', 1300, 4, '2024-01-04 10:26:50', 1, 'product-item5.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(6, 'Pink Watch', 'Apple', 870, 14, '2024-01-04 10:27:22', 2, 'product-item6.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(7, 'Heavy Watch', 'Apple', 680, 15, '2024-01-04 10:27:58', 2, 'product-item7.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(8, 'Spotted Watch', 'Apple', 750, 15, '2024-01-04 10:28:24', 2, 'product-item8.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(9, 'Black Watch', 'Apple', 650, 14, '2024-01-04 10:28:50', 2, 'product-item9.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(10, 'Black Watch 2', 'Apple', 750, 9, '2024-01-04 10:29:18', 2, 'product-item10.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(11, 'Earphones 1', 'Samsung', 750, 10, '2024-01-12 15:09:47', 3, 'insta-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(12, 'Earphones 2', 'testSamsung', 750, 10, '2024-01-12 15:10:39', 3, 'insta-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(13, 'Earphones 3', 'testSamsung', 750, 10, '2024-01-12 15:10:54', 3, 'insta-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(14, 'Earphones 4', 'testSamsung', 750, 10, '2024-01-12 15:11:06', 3, 'insta-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(15, 'Earphones 5', 'AppleSamsung', 750, 10, '2024-01-12 15:11:20', 3, 'insta-item4.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(16, 'Playstation', 'Sony', 980, 4, '2024-01-15 07:13:15', 4, 'post-item1.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.'),
(17, 'Virtual Reality headset', 'Sony', 1500, 9, '2024-01-15 07:15:45', 4, 'post-item5.jpg', 'Cum eveniet sequi et odit architecto cum dicta aliquam eos autem impedit aut ipsum nihil eum aperiam aperiam. Et iure quaerat ut natus iusto non dolorem consequatur qui obcaecati deleniti non consequatur nesciunt ut dolores enim est consequatur voluptatem. Qui quibusdam quod quo laborum nostrum ea sint doloremque non magnam laboriosam qui sunt soluta non rerum repudiandae et cumque ullam.');

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

DROP TABLE IF EXISTS `logo`;
CREATE TABLE IF NOT EXISTS `logo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `logo`
--

INSERT INTO `logo` (`id`, `name`) VALUES
(1, '20231118_155106.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `navbar`
--

DROP TABLE IF EXISTS `navbar`;
CREATE TABLE IF NOT EXISTS `navbar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `buttons` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `navbar`
--

INSERT INTO `navbar` (`id`, `buttons`, `link`, `route`) VALUES
(1, 'Home', '#billboard', 'home.index'),
(2, 'Services', '#company-services', 'home.index'),
(3, 'Sale', '#yearly-sale', 'home.index'),
(4, 'Blog', '#latest-blog', 'home.index'),
(5, 'shop', NULL, 'app_item_index');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_E52FFDEEAEA34913` (`reference`),
  KEY `IDX_E52FFDEEA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `reference`, `created_at`, `adresse`, `code_postal`, `ville`) VALUES
(46, 1, 'order_659e9b1b0e4e1', '2024-01-10 13:26:48', '58T RUE PAUL VAILLANT-COUTURIER', 59770, 'MARLY'),
(47, 2, 'order_659e9b71c7683', '2024-01-10 13:28:13', '1 RUE JULES MASSENET', 59125, 'TRITH ST LEGER'),
(48, 1, 'order_659fc3062b614', '2024-01-11 10:29:23', '11 Clos des villas', 59300, 'Valenciennes'),
(49, 2, 'order_659fe8710171b', '2024-01-11 13:08:59', '32 avenue de la barre', 59560, 'Comines'),
(50, 1, 'order_65a10f349161e', '2024-01-12 10:06:41', '11 Clos des villas', 59300, 'Valenciennes'),
(51, 2, 'order_65a111a923e55', '2024-01-12 10:16:51', '10 AVENUE HENRI MATISSE', 59300, 'AULNOY LEZ VALENCIENNES'),
(52, 1, 'order_65a5501e404c1', '2024-01-15 15:32:42', '58T RUE PAUL VAILLANT-COUTURIER', 59770, 'MARLY'),
(53, 1, 'order_65a65fd2dd866', '2024-01-16 10:49:35', '11 Clos des villas', 59300, 'Valenciennes'),
(54, 1, 'order_65aa367abc557', '2024-01-19 08:44:34', '11 RUE DES PLATANES', 59570, 'BAVAY');

-- --------------------------------------------------------

--
-- Structure de la table `orders_details`
--

DROP TABLE IF EXISTS `orders_details`;
CREATE TABLE IF NOT EXISTS `orders_details` (
  `orders_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`orders_id`,`item_id`),
  KEY `IDX_835379F1CFFE9AD6` (`orders_id`),
  KEY `IDX_835379F1126F525E` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders_details`
--

INSERT INTO `orders_details` (`orders_id`, `item_id`, `quantity`, `price`) VALUES
(46, 4, 15, 1500),
(46, 10, 10, 750),
(47, 10, 5, 750),
(48, 9, 1, 650),
(49, 5, 1, 1300),
(49, 6, 1, 870),
(50, 1, 15, 980),
(51, 5, 10, 1300),
(52, 16, 1, 980),
(52, 17, 1, 1500),
(53, 2, 2, 1100),
(53, 10, 1, 750),
(54, 2, 1, 1100);

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `buttons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pages`
--

INSERT INTO `pages` (`id`, `buttons`, `route`, `link`) VALUES
(1, 'Shop', 'app_item_index', NULL),
(2, 'cart', 'cart_index', NULL),
(3, 'checkout', 'home.index', NULL),
(4, 'blog', 'home.index', '#latest-blog'),
(5, 'sale', 'home.index', '#yearly-sale'),
(6, 'contact', 'home.index', NULL),
(8, 'test', 'home.index', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `fav_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fav_code_postal` int DEFAULT NULL,
  `fav_ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `prenom`, `nom`, `adresse`, `code_postal`, `ville`, `created_at`, `fav_adresse`, `fav_code_postal`, `fav_ville`) VALUES
(1, 'melchiah.nico@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$hQpA02TvmfVRw0RNWFBShOZ1AUqt.KwGqW96tsHtAOK1yYuWiwOmK', 'Nicolas', 'Zabik', '66 Clos des villas', 59300, 'Valenciennes', '2024-01-03 10:53:47', '58T RUE PAUL VAILLANT-COUTURIER', 59770, 'MARLY'),
(2, 'titi@toto.com', '[\"ROLE_USER\"]', '$2y$13$6aiXUz7Z34ngd3wLfKk5XO9gtKL/qHeqk5GKDkZwbotT/lz/XWdL.', 'Toto', 'Titi', '32 avenue de la barre', 59560, 'Comines', '2024-01-03 14:02:40', '3 AVENUE DES LILAS', 59770, 'MARLY');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `FK_835379F1126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `FK_835379F1CFFE9AD6` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
