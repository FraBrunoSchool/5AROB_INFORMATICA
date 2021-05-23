-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 26, 2021 alle 12:42
-- Versione del server: 10.4.17-MariaDB
-- Versione PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_agenziamatrimoniale`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abbinamenti`
--

CREATE TABLE `abbinamenti` (
  `id` int(11) NOT NULL,
  `idUtente1` int(11) NOT NULL,
  `idUtente2` int(11) NOT NULL,
  `giudizio1` int(11) NOT NULL,
  `giudizio2` int(11) NOT NULL,
  `scartato` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `abbinamenti`
--

INSERT INTO `abbinamenti` (`id`, `idUtente1`, `idUtente2`, `giudizio1`, `giudizio2`, `scartato`) VALUES
(1, 1, 2, 0, 0, 0),
(2, 1, 4, 0, 0, 0),
(3, 1, 6, 0, 0, 0),
(4, 1, 2, 0, 0, 0),
(5, 1, 4, 0, 0, 0),
(6, 1, 6, 0, 0, 0),
(7, 1, 2, 0, 0, 0),
(8, 1, 4, 0, 0, 0),
(9, 1, 6, 0, 0, 0),
(10, 1, 2, 0, 0, 0),
(11, 1, 4, 0, 0, 0),
(12, 1, 6, 0, 0, 0),
(13, 1, 2, 0, 0, 0),
(14, 1, 4, 0, 0, 0),
(15, 1, 6, 0, 0, 0),
(16, 1, 2, 0, 0, 0),
(17, 1, 4, 0, 0, 0),
(18, 1, 6, 0, 0, 0),
(19, 1, 2, 0, 0, 0),
(20, 1, 4, 0, 0, 0),
(21, 1, 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `sesso` tinyint(1) NOT NULL,
  `eta` int(11) NOT NULL,
  `altezza` float NOT NULL,
  `peso` float NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `pwd` varchar(16) NOT NULL,
  `amministratore` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `sesso`, `eta`, `altezza`, `peso`, `nickname`, `pwd`, `amministratore`) VALUES
(1, 'Paperino', 1, 23, 155, 54, 'pap', 'pap24', 0),
(2, 'Paperina', 0, 66, 188, 33, 'papaina', 'pina66', 0),
(3, 'Gastone', 1, 56, 123, 25, 'gast', 'gast88', 0),
(4, 'Brigitta', 0, 18, 166, 78, 'brig18', 'brig1866', 0),
(5, 'Paperone', 1, 93, 200, 100, 'pap100', 'papciccione', 0),
(6, 'Amelia', 0, 63, 175, 96, 'am96', 'am63', 0),
(7, 'PuppetMaster', 1, 55, 180, 65, 'puppAmm', 'amm', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abbinamenti`
--
ALTER TABLE `abbinamenti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `abbinamenti`
--
ALTER TABLE `abbinamenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
