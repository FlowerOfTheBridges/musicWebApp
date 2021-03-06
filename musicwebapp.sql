-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2018 at 04:21 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicwebapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_follower` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`,`id_follower`),
  KEY `id_follower` (`id_follower`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `size` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  `img` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mp3`
--

CREATE TABLE IF NOT EXISTS `mp3` (
  `id_song` smallint(5) UNSIGNED NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '',
  `size` varchar(25) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `mp3` longblob NOT NULL,
  PRIMARY KEY (`id_song`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `id_moderatore` smallint(5) UNSIGNED DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(300) NOT NULL DEFAULT '"no description needed"',
  `id_segnalatore` smallint(5) UNSIGNED NOT NULL,
  `id_object` smallint(5) NOT NULL,
  `object_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_moderatore` (`id_moderatore`),
  KEY `id_segnalatore` (`id_segnalatore`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `genre` varchar(40) NOT NULL,
  `forall` tinyint(1) DEFAULT '0',
  `registered` tinyint(1) DEFAULT '1',
  `supporters` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`id_artist`),
  KEY `id_artist` (`id_artist`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supporter`
--

CREATE TABLE IF NOT EXISTS `supporter` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `id_supporter` smallint(5) UNSIGNED NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`id`,`id_supporter`),
  KEY `id_supporter` (`id_supporter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support_info`
--

CREATE TABLE IF NOT EXISTS `support_info` (
  `id_artist` smallint(5) UNSIGNED NOT NULL,
  `contribute` varchar(10) NOT NULL,
  `period` smallint(5) NOT NULL,
  PRIMARY KEY (`id_artist`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `type` set('listener','musician','moderator') NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `birth_place` varchar(30) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `bio` char(255) DEFAULT NULL,
  `genre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`id_follower`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mp3`
--
ALTER TABLE `mp3`
  ADD CONSTRAINT `song_mp3_constraint` FOREIGN KEY (`id_song`) REFERENCES `song` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`id_segnalatore`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supporter`
--
ALTER TABLE `supporter`
  ADD CONSTRAINT `supporter_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supporter_ibfk_2` FOREIGN KEY (`id_supporter`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `support_info`
--
ALTER TABLE `support_info`
  ADD CONSTRAINT `support_info_ibfk_1` FOREIGN KEY (`id_artist`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
