-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2022 at 12:12 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tifightgame`
--

-- --------------------------------------------------------

--
-- Table structure for table `characters`
--

CREATE TABLE `characters` (
  `id_character` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_user` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `classe` varchar(256) NOT NULL,
  `weapon` varchar(256) NOT NULL,
  `shield` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `characters`
--

INSERT INTO `characters` (`id_character`, `id_user`, `name_user`, `name`, `classe`, `weapon`, `shield`) VALUES
(1, 1, 'Test1', 'Garen', 'Combattant', 'Épée', 'null'),
(2, 1, 'Test1', 'Gandalf', 'Sorcier', 'Baguette basique', 'null'),
(3, 1, 'Test1', 'Taki', 'Percuteur', 'Aucune', 'null'),
(4, 2, 'Test2', 'Poppy', 'Chevalier', 'Épée', 'Bouclier en bois'),
(5, 2, 'Test2', 'Alys', 'Combattant', 'Épée', 'null'),
(6, 2, 'Test2', 'Wyzla', 'Sorcier', 'Baguette basique', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `games_played` int(11) DEFAULT '0',
  `games_won` int(11) DEFAULT '0',
  `games_lost` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `mail`, `password`, `games_played`, `games_won`, `games_lost`) VALUES
(1, 'Test1', 'test1@gmail.com', '123', 0, 0, 0),
(2, 'Test2', 'test2@gmail.com', '123', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `characters`
--
ALTER TABLE `characters`
  ADD PRIMARY KEY (`id_character`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `characters`
--
ALTER TABLE `characters`
  MODIFY `id_character` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
