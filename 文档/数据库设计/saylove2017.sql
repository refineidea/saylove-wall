-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-17 10:23:11
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `saylove2017`
--

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_blacklist`
--

CREATE TABLE IF NOT EXISTS `saylove_2017_blacklist` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_commtents`
--

CREATE TABLE IF NOT EXISTS `saylove_2017_commtents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) NOT NULL,
  `contents` varchar(140) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_guess`
--

CREATE TABLE IF NOT EXISTS `saylove_2017_guess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) NOT NULL,
  `guessName` varchar(30) NOT NULL,
  `isRight` enum('0','1') NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_like`
--

CREATE TABLE IF NOT EXISTS `saylove_2017_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posts_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_posts`
--

CREATE TABLE IF NOT EXISTS `saylove_2017_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickName` varchar(30) NOT NULL,
  `tureName` varchar(30) NOT NULL,
  `toWho` varchar(30) NOT NULL,
  `contents` varchar(520) NOT NULL,
  `email` text NOT NULL,
  `isDisplay` enum('0','1') NOT NULL DEFAULT '0',
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
