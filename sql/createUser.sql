-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2016 at 08:15 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db/development.sqlite3`
--
CREATE DATABASE IF NOT EXISTS `db/development.sqlite3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db/development.sqlite3`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(255) DEFAULT NULL,
  `isRoot` int(11) NOT NULL DEFAULT '1',
  `postCont` text,
  PRIMARY KEY (`postID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `postTitle`, `isRoot`, `postCont`) VALUES
(1, 'Home', 0, '<p>Sample Sample content</p>'),
(2, 'About', 1, '<p>Sample Sample content</p>'),
(3, 'Services', 1, '<p>Sample Sample content</p>'),
(4, 'News', 1, '<p>Sample Sample content</p>'),
(5, 'Contact', 1, '<p>Sample Sample content</p>'),
(11, 'Testing Api', 1, 'This is my first test post applying Twilio API');

-- --------------------------------------------------------

--
-- Table structure for table `schema_migrations`
--

DROP TABLE IF EXISTS `schema_migrations`;
CREATE TABLE IF NOT EXISTS `schema_migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schema_migrations`
--

INSERT INTO `schema_migrations` (`version`) VALUES
('20160409052942'),
('20160409053508'),
('20160409054539'),
('20160409054615'),
('20160409054648'),
('20160409083730'),
('20160409083831'),
('20160409093507');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `password_digest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscribed` tinyint(1) DEFAULT '0',
  `phone_number` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_users_on_email` (`email`) USING BTREE,
  KEY `index_users_on_remember_token` (`remember_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `created_at`, `updated_at`, `password_digest`, `admin`, `remember_token`, `first_name`, `last_name`, `subscribed`, `phone_number`) VALUES
(1, 'csciclub@csci.club', '2016-04-09 00:00:00', '2016-04-09 00:00:00', '$2y$11$itJy4XJEcjcf8JrQdizAfuApPY4Qa5HqWdbUT6gpyIHo6Vi7xzpGW', 1, NULL, 'Suyash', 'Bhatt', 1, 3202982680);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
