-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 avr. 2019 à 00:20
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;




CREATE DATABASE IF NOT EXISTS blog_ecrivain;

USE blog_ecrivain;
--
-- Base de données :  `blog_ecrivain`
--

-- --------------------------------------------------------

--
-- Structure de la table `users_group_permissions`
--

DROP TABLE IF EXISTS `users_group_permissions`;
CREATE TABLE IF NOT EXISTS `users_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_group_id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1757 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_group_permissions`
--

INSERT INTO `users_group_permissions` (`id`, `users_group_id`, `page`) VALUES
(1429, 1, '/admin/contacts/disabled/:id'),
(1428, 1, '/admin/contacts/send/:id'),
(1427, 1, '/admin/contacts/reply/:id'),
(1426, 1, '/admin/contacts'),
(1425, 1, '/admin/logout'),
(1424, 1, '/admin/settings/save'),
(1423, 1, '/admin/settings'),
(1422, 1, '/admin/comments/save/:id'),
(1421, 1, '/admin/comments/edit/:id'),
(1420, 1, '/admin/comments/add'),
(1419, 1, '/admin/comments/submit'),
(1418, 1, '/admin/comments/delete/:text/episode/:id'),
(1417, 1, '/admin/comments/delete/:text'),
(106, 7, '/admin/login'),
(107, 7, '/admin/login/submit'),
(108, 7, '/admin/categories'),
(109, 7, '/admin/categories/add'),
(1745, 4, '/admin/logout'),
(193, 9, '/admin/login'),
(1416, 1, '/admin/comments/delete/:id'),
(146, 10, '/admin/categories/add'),
(141, 8, '/admin/categories'),
(1415, 1, '/admin/episodes/all-disabled-comments'),
(1414, 1, '/admin/episodes/all-reported-comments'),
(216, 12, '/admin/categories'),
(215, 12, '/admin/login/submit'),
(214, 12, '/admin/login'),
(213, 11, '/admin/login'),
(1413, 1, '/admin/episodes/:id/comments'),
(1411, 1, '/admin/episodes/delete/:id'),
(1412, 1, '/admin/episodes/comments'),
(1410, 1, '/admin/episodes/edit/:id'),
(1409, 1, '/admin/episodes/save/:id'),
(1408, 1, '/admin/episodes/submit'),
(354, 13, '/admin/login'),
(355, 13, '/admin/login/submit'),
(356, 13, '/admin/categories'),
(366, 14, '/admin/login'),
(1527, 5, '/admin/login'),
(1448, 17, '/admin/contacts'),
(1447, 17, '/admin/dashboard'),
(1407, 1, '/admin/episodes/add'),
(1406, 1, '/admin/episodes'),
(1405, 1, '/admin/chapters/delete/:id'),
(1404, 1, '/admin/chapters/edit/:id'),
(1403, 1, '/admin/chapters/save/:id'),
(1402, 1, '/admin/chapters/submit'),
(1401, 1, '/admin/chapters/add'),
(1400, 1, '/admin/chapters'),
(1399, 1, '/admin/profile/update'),
(1398, 1, '/admin/users-groups/delete/:id'),
(1397, 1, '/admin/users-groups/edit/:id'),
(1396, 1, '/admin/users-groups/save/:id'),
(1395, 1, '/admin/users-groups/submit'),
(1394, 1, '/admin/users-groups/add'),
(1393, 1, '/admin/users-groups'),
(1392, 1, '/admin/users/delete/:id'),
(1391, 1, '/admin/users/edit/:id'),
(1390, 1, '/admin/users/save/:id'),
(1389, 1, '/admin/users/submit'),
(1388, 1, '/admin/users/add'),
(1387, 1, '/admin/users'),
(1386, 1, '/admin/submit'),
(1385, 1, '/admin/dashboard'),
(1383, 1, '/admin/login/submit'),
(1384, 1, '/admin'),
(1382, 1, '/admin/login'),
(1446, 17, '/admin'),
(1445, 17, '/admin/login/submit'),
(1444, 17, '/admin/login'),
(1492, 16, '/admin/episodes/all-disabled-comments'),
(1491, 16, '/admin/episodes/all-reported-comments'),
(1490, 16, '/admin/episodes/:id/comments'),
(1489, 16, '/admin/episodes/comments'),
(1488, 16, '/admin/episodes/delete/:id'),
(1487, 16, '/admin/episodes/edit/:id'),
(1486, 16, '/admin/episodes/save/:id'),
(1485, 16, '/admin/episodes/submit'),
(1484, 16, '/admin/episodes/add'),
(1483, 16, '/admin/episodes'),
(1482, 16, '/admin/dashboard'),
(1481, 16, '/admin'),
(1480, 16, '/admin/login/submit'),
(1726, 2, '/admin/episodes/all-disabled-comments'),
(1744, 4, '/admin/comments/save/:id'),
(1449, 17, '/admin/contacts/reply/:id'),
(1450, 17, '/admin/contacts/send/:id'),
(1451, 17, '/admin/contacts/disabled/:id'),
(1452, 18, '/admin/login'),
(1453, 18, '/admin/login/submit'),
(1454, 18, '/admin'),
(1455, 18, '/admin/dashboard'),
(1456, 18, '/admin/comments/delete/:id'),
(1457, 18, '/admin/comments/delete/:text'),
(1458, 18, '/admin/comments/delete/:text/episode/:id'),
(1459, 18, '/admin/comments/submit'),
(1460, 18, '/admin/comments/add'),
(1461, 18, '/admin/comments/edit/:id'),
(1462, 18, '/admin/comments/save/:id'),
(1463, 18, '/admin/logout'),
(1479, 16, '/admin/login'),
(1493, 16, '/admin/logout'),
(1727, 2, '/admin/logout'),
(1725, 2, '/admin/episodes/all-reported-comments'),
(1724, 2, '/admin/episodes/:id/comments'),
(1722, 2, '/admin/episodes/delete/:id'),
(1723, 2, '/admin/episodes/comments'),
(1741, 4, '/admin/comments/submit'),
(1742, 4, '/admin/comments/add'),
(1743, 4, '/admin/comments/edit/:id'),
(1736, 4, '/admin/episodes/all-reported-comments'),
(1740, 4, '/admin/comments/delete/:text/episode/:id'),
(1739, 4, '/admin/comments/delete/:text'),
(1738, 4, '/admin/comments/delete/:id'),
(1756, 3, '/admin/logout'),
(1721, 2, '/admin/episodes/edit/:id'),
(1755, 3, '/admin/contacts/disabled/:id'),
(1754, 3, '/admin/contacts/send/:id'),
(1753, 3, '/admin/contacts/reply/:id'),
(1752, 3, '/admin/contacts'),
(1528, 5, '/admin/login/submit'),
(1529, 5, '/admin'),
(1530, 5, '/admin/dashboard'),
(1531, 5, '/admin/profile/update'),
(1532, 5, '/admin/logout'),
(1533, 5, '/admin/contacts'),
(1534, 5, '/admin/contacts/reply/:id'),
(1535, 5, '/admin/contacts/send/:id'),
(1536, 5, '/admin/contacts/disabled/:id'),
(1751, 3, '/admin/profile/update'),
(1750, 3, '/admin/submit'),
(1749, 3, '/admin/dashboard'),
(1748, 3, '/admin'),
(1747, 3, '/admin/login/submit'),
(1746, 3, '/admin/login'),
(1737, 4, '/admin/episodes/all-disabled-comments'),
(1735, 4, '/admin/episodes/:id/comments'),
(1734, 4, '/admin/episodes/comments'),
(1720, 2, '/admin/episodes/save/:id'),
(1733, 4, '/admin/profile/update'),
(1732, 4, '/admin/submit'),
(1731, 4, '/admin/dashboard'),
(1730, 4, '/admin'),
(1729, 4, '/admin/login/submit'),
(1728, 4, '/admin/login'),
(1719, 2, '/admin/episodes/submit'),
(1718, 2, '/admin/episodes/add'),
(1717, 2, '/admin/episodes'),
(1716, 2, '/admin/chapters/delete/:id'),
(1715, 2, '/admin/chapters/edit/:id'),
(1714, 2, '/admin/chapters/save/:id'),
(1713, 2, '/admin/chapters/submit'),
(1712, 2, '/admin/chapters/add'),
(1711, 2, '/admin/chapters'),
(1710, 2, '/admin/profile/update'),
(1709, 2, '/admin/submit'),
(1708, 2, '/admin/dashboard'),
(1707, 2, '/admin'),
(1706, 2, '/admin/login/submit'),
(1705, 2, '/admin/login');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
