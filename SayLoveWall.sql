-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2017-08-03 04:03:03
-- 服务器版本： 5.5.52-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SayLoveWall`
--

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_blacklist`
--

CREATE TABLE `saylove_2017_blacklist` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_commtents`
--

CREATE TABLE `saylove_2017_commtents` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `contents` varchar(140) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_guess`
--

CREATE TABLE `saylove_2017_guess` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `guessName` varchar(30) NOT NULL,
  `isRight` enum('0','1') NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_like`
--

CREATE TABLE `saylove_2017_like` (
  `id` int(11) NOT NULL,
  `posts_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `saylove_2017_posts`
--

CREATE TABLE `saylove_2017_posts` (
  `id` int(11) NOT NULL,
  `nickName` varchar(30) NOT NULL,
  `tureName` varchar(30) NOT NULL,
  `toWho` varchar(30) NOT NULL,
  `gender` enum('male','female','secrecy') NOT NULL,
  `itsGender` enum('male','female','secrecy') NOT NULL,
  `contents` varchar(520) NOT NULL,
  `email` text NOT NULL,
  `isDisplay` enum('0','1') NOT NULL DEFAULT '0',
  `isSended` enum('0','1','2') NOT NULL DEFAULT '0',
  `love` int(11) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saylove_2017_commtents`
--
ALTER TABLE `saylove_2017_commtents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saylove_2017_guess`
--
ALTER TABLE `saylove_2017_guess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saylove_2017_like`
--
ALTER TABLE `saylove_2017_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saylove_2017_posts`
--
ALTER TABLE `saylove_2017_posts`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `saylove_2017_commtents`
--
ALTER TABLE `saylove_2017_commtents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;
--
-- 使用表AUTO_INCREMENT `saylove_2017_guess`
--
ALTER TABLE `saylove_2017_guess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3159;
--
-- 使用表AUTO_INCREMENT `saylove_2017_like`
--
ALTER TABLE `saylove_2017_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25779;
--
-- 使用表AUTO_INCREMENT `saylove_2017_posts`
--
ALTER TABLE `saylove_2017_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31685;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
