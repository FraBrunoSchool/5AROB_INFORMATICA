-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 31, 2021 alle 09:06
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
-- Database: `db_myclassroom`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `alunni`
--

CREATE TABLE `alunni` (
  `id_alunno` int(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `data_nascita` varchar(30) NOT NULL,
  `luogo_nascita` varchar(30) NOT NULL,
  `email` varchar(254) NOT NULL,
  `id_classe` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `alunni`
--

INSERT INTO `alunni` (`id_alunno`, `password`, `nome`, `cognome`, `data_nascita`, `luogo_nascita`, `email`, `id_classe`) VALUES
(147852, '147852', '147852', '147852', '2002-08-23', 'Montemale', 'test5@gmail.com', '3arob'),
(654823, '654823', '654823', '654823', '2002-03-06', 'Caraglio', 'test12@gmail.com', '3arob'),
(745896, '745896', '745896', '745896', '2006-05-05', 'Cuneo', 'test20@gmail.com', '1aele'),
(1569823, '1569823', '1569823', '1569823', '2003-11-05', 'Cuneo', 'test26@gmail.com', '4arob'),
(2541563, '2541563', '2541563', '2541563', '2006-07-07', 'Cuneo', 'test22@gmail.com', '1arob'),
(3215698, '3215698', '3215698', '3215698', '2002-08-23', 'Montemale', 'test10@gmail.com', '3arob'),
(3256983, '3256983', '3256983', '3256983', '2006-06-06', 'Cuneo', 'test21@gmail.com', '1aele'),
(3259819, '3259819', '3259819', '3259819', '2005-06-02', 'Cuneo', 'test25@gmail.com', '2arob'),
(4444333, '4444333', 'alu', 'aluA', '2002-10-09', 'Demonte', 'alu@gmail.com', '5arob'),
(4578541, '4578541', '4578541', '4578541', '2002-08-23', 'Cuneo', 'test2@gmail.com', '5arob'),
(6523489, '6523489', '6523489', '6523489', '2002-08-23', 'Savigliano', 'test4@gmail.com', '5arob'),
(6542389, '6542389', '6542389', '6542389', '2002-03-06', 'Savigliano', 'test11@gmail.com', '3arob'),
(6958424, '6958424', '6958424', '6958424', '2002-08-23', 'Cuneo', 'test@gmail.com', '5arob'),
(32569841, '32569841', '32569841', '32569841', '2006-08-08', 'Cuneo', 'test23@gmail.com', '1arob'),
(41256374, '41256374', '41256374', '41256374', '2002-08-23', 'Cuneo', 'test3@gmail', '5arob'),
(65541259, '65541259', '65541259', '65541259', '2005-03-15', 'Cuneo', 'test24@gmail.com', '2arob'),
(96315834, '96315834', '96315834', '96315834', '2003-12-30', 'Cuneo', 'test30@gmail.com', '4arob'),
(666333444, '66633344', 'Francesco', 'Bruno', '2002-08-23', 'Savigliano', 'fra@gmail.com', '3arob');

-- --------------------------------------------------------

--
-- Struttura della tabella `argomenti`
--

CREATE TABLE `argomenti` (
  `id_argomento` int(10) NOT NULL,
  `descr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `argomenti`
--

INSERT INTO `argomenti` (`id_argomento`, `descr`) VALUES
(1, 'verifica normalizzazione'),
(2, 'argomento bello'),
(3, 'verifica php'),
(4, 'test'),
(5, 'normalizzazione'),
(6, 'mapping'),
(7, 'Parini'),
(8, 'Quasimodo'),
(9, 'epica1'),
(10, 'epica2'),
(11, 'epica3');

-- --------------------------------------------------------

--
-- Struttura della tabella `classi`
--

CREATE TABLE `classi` (
  `id_classe` varchar(5) NOT NULL,
  `num_alunni` int(2) NOT NULL,
  `id_docente_coord` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `classi`
--

INSERT INTO `classi` (`id_classe`, `num_alunni`, `id_docente_coord`) VALUES
('1aele', 44, 456321),
('1arob', 21, 1356894),
('2arob', 25, 23096325),
('3arob', 22, 666333666),
('4arob', 14, 456789),
('5arob', 21, 122333);

-- --------------------------------------------------------

--
-- Struttura della tabella `dirigenza`
--

CREATE TABLE `dirigenza` (
  `id_dirigenza` int(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `data_nascita` varchar(30) NOT NULL,
  `luogo_nascita` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `num_tel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `dirigenza`
--

INSERT INTO `dirigenza` (`id_dirigenza`, `password`, `nome`, `cognome`, `data_nascita`, `luogo_nascita`, `email`, `num_tel`) VALUES
(123456789, '13245678', 'test', 'test', '2017-10-09', 'Savigliano', 'test@test.com', 338666553),
(744158963, '744158963', '744158963', '744158963', '1950-05-05', 'Cuneo', 'test_dirigenza@gmail.com', 2147483647),
(2147483647, '77788887', 'Dirigenza', 'Dirigenza', '1970-12-25', 'Cuneo', 'dir@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Struttura della tabella `docenti`
--

CREATE TABLE `docenti` (
  `id_docente` int(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `data_nascita` varchar(30) NOT NULL,
  `luogo_nascita` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `docenti`
--

INSERT INTO `docenti` (`id_docente`, `password`, `nome`, `cognome`, `data_nascita`, `luogo_nascita`, `email`) VALUES
(122333, '122333', 'doc', 'docC', '2018-10-16', 'Cuneo', 'doc@gmail.com'),
(456321, '456321', 'Mario', 'Rossi', '2002-12-01', 'Cuneo', 'mario@gmail.com'),
(456789, '456789', 'doc2', 'doc2', '1980-12-12', 'Cuneo', 'doc2@gmail.com'),
(1356894, '1356894', '1356894', '1356894', '1965-10-20', 'Caraglio', 'test0@gmail.com'),
(23096325, '23096325', 'Mario', 'Rossi', '1980-04-01', 'Montemale', 'mario.rossi@gmail.com'),
(45698256, '45698256', '45698256', '45698256', '1966-06-26', 'Cuneo', '45698256@gmail.com'),
(555554444, '555554444', '555554444', '555554444', '1970-08-23', 'Cuneo', '555554444@gmail.com'),
(666333666, '666333666', 'profICT', 'ICT', '1993-05-03', 'Cuneo', 'ICT@gmail.com'),
(999999999, '999999999', 'Maria', 'Rossi', '1950-09-01', 'Cuneo', 'maria@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `docentidelleclassi`
--

CREATE TABLE `docentidelleclassi` (
  `id_classe` varchar(5) NOT NULL,
  `id_docente` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `docentidelleclassi`
--

INSERT INTO `docentidelleclassi` (`id_classe`, `id_docente`) VALUES
('1aele', 456321),
('1arob', 1356894),
('2arob', 1356894),
('2arob', 23096325),
('3arob', 122333),
('3arob', 1356894),
('3arob', 666333666),
('4arob', 122333),
('4arob', 456789),
('4arob', 1356894),
('4arob', 23096325),
('5arob', 122333),
('5arob', 456789),
('5arob', 1356894);

-- --------------------------------------------------------

--
-- Struttura della tabella `docentiinsegnanomaterie`
--

CREATE TABLE `docentiinsegnanomaterie` (
  `id_docente` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `docentiinsegnanomaterie`
--

INSERT INTO `docentiinsegnanomaterie` (`id_docente`, `id_materia`) VALUES
(122333, 3),
(122333, 6),
(456789, 2),
(1356894, 2),
(45698256, 7),
(666333666, 3),
(666333666, 4),
(666333666, 5),
(999999999, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `files`
--

CREATE TABLE `files` (
  `id_file` int(10) NOT NULL,
  `titolo_documento` varchar(30) NOT NULL,
  `voto` int(2) DEFAULT NULL,
  `id_alunno` int(10) NOT NULL,
  `id_verifica` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `files`
--

INSERT INTO `files` (`id_file`, `titolo_documento`, `voto`, `id_alunno`, `id_verifica`) VALUES
(7, '4444333_alu_aluA.pdf', 8, 4444333, 10),
(8, '4444333_alu_aluA.pdf', 10, 4444333, 11),
(9, '4444333_alu_aluA.pdf', 9, 4444333, 9),
(10, '4444333_alu_aluA.pdf', 10, 4444333, 7),
(11, '4578541_4578541_4578541.pdf', 6, 4578541, 11),
(12, '4578541_4578541_4578541.pdf', 6, 4578541, 10),
(13, '4578541_4578541_4578541.pdf', 10, 4578541, 9),
(14, '4578541_4578541_4578541.pdf', 7, 4578541, 7),
(15, '6523489_6523489_6523489.pdf', 4, 6523489, 11),
(16, '6523489_6523489_6523489.pdf', 10, 6523489, 10),
(17, '6523489_6523489_6523489.pdf', 5, 6523489, 9),
(18, '6523489_6523489_6523489.pdf', 5, 6523489, 7),
(19, '41256374_41256374_41256374.pdf', 9, 41256374, 11),
(20, '41256374_41256374_41256374.pdf', 9, 41256374, 10),
(21, '41256374_41256374_41256374.pdf', 10, 41256374, 9),
(22, '41256374_41256374_41256374.pdf', 8, 41256374, 7),
(23, '6958424_6958424_6958424.pdf', 9, 6958424, 11),
(24, '6958424_6958424_6958424.pdf', 8, 6958424, 10),
(25, '6958424_6958424_6958424.pdf', 8, 6958424, 9),
(26, '6958424_6958424_6958424.pdf', 9, 6958424, 7),
(27, '6958424_6958424_6958424.pdf', 6, 6958424, 13),
(28, '6958424_6958424_6958424.pdf', 10, 6958424, 12),
(29, '6523489_6523489_6523489.pdf', 7, 6523489, 13),
(30, '6523489_6523489_6523489.pdf', 9, 6523489, 12),
(31, '4444333_alu_aluA.pdf', 8, 4444333, 13),
(32, '4444333_alu_aluA.pdf', 8, 4444333, 12),
(33, '41256374_41256374_41256374.pdf', 9, 41256374, 13),
(34, '41256374_41256374_41256374.pdf', 7, 41256374, 12),
(35, '4578541_4578541_4578541.pdf', 10, 4578541, 13),
(36, '4578541_4578541_4578541.pdf', 6, 4578541, 12),
(37, '32569841_32569841_32569841.pdf', 6, 32569841, 16),
(38, '2541563_2541563_2541563.pdf', 4, 2541563, 16),
(39, '65541259_65541259_65541259.pdf', 7, 65541259, 17),
(40, '3259819_3259819_3259819.pdf', 7, 3259819, 17),
(41, '666333444_Francesco_Bruno.pdf', 8, 666333444, 18),
(42, '6542389_6542389_6542389.pdf', 7, 6542389, 18),
(43, '3215698_3215698_3215698.pdf', 7, 3215698, 18),
(44, '147852_147852_147852.pdf', 8, 147852, 18),
(45, '654823_654823_654823.pdf', 9, 654823, 18),
(46, '1569823_1569823_1569823.pdf', 10, 1569823, 14),
(47, '96315834_96315834_96315834.pdf', 10, 96315834, 14),
(48, '6958424_6958424_6958424.pdf', 10, 6958424, 15),
(49, '6523489_6523489_6523489.pdf', 9, 6523489, 15),
(50, '4444333_alu_aluA.pdf', 8, 4444333, 15),
(51, '41256374_41256374_41256374.pdf', 7, 41256374, 15),
(52, '4578541_4578541_4578541.pdf', 9, 4578541, 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `materie`
--

CREATE TABLE `materie` (
  `id_materia` int(10) NOT NULL,
  `nome_materia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `materie`
--

INSERT INTO `materie` (`id_materia`, `nome_materia`) VALUES
(1, 'Matematica'),
(2, 'Italiano'),
(3, 'Informatica'),
(4, 'Sistemi e Reti'),
(5, 'TPSIT'),
(6, 'Microrobotica'),
(7, 'GPOI');

-- --------------------------------------------------------

--
-- Struttura della tabella `verifiche`
--

CREATE TABLE `verifiche` (
  `id_verifica` int(10) NOT NULL,
  `titolo_documento` varchar(30) NOT NULL,
  `data_ora_scadenza` varchar(30) NOT NULL,
  `id_docente` int(10) NOT NULL,
  `id_materia` int(10) NOT NULL,
  `id_argomento` int(10) NOT NULL,
  `id_classe` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `verifiche`
--

INSERT INTO `verifiche` (`id_verifica`, `titolo_documento`, `data_ora_scadenza`, `id_docente`, `id_materia`, `id_argomento`, `id_classe`) VALUES
(7, 'provafolder.pdf', '2021-05-29-12-00', 122333, 3, 1, '5arob'),
(9, 'provapdf.pdf', '2021-05-27-10-00', 122333, 3, 2, '5arob'),
(10, 'test_presenza.pdf', '2021-05-31-10-00', 122333, 3, 4, '5arob'),
(11, 'provatutto.pdf', '2021-05-27-18-00', 122333, 3, 3, '5arob'),
(12, 'normalizzazione.pdf', '2021-05-31-10-00', 122333, 3, 5, '5arob'),
(13, 'mapping.pdf', '2021-05-31-10-00', 122333, 3, 6, '5arob'),
(14, 'parini_analisi.pdf', '2021-06-01-11-00', 456789, 2, 7, '4arob'),
(15, 'quasimodo_analisi.pdf', '2021-06-01-10-00', 456789, 2, 8, '5arob'),
(16, 'epica.pdf', '2021-06-12-08-00', 1356894, 2, 9, '1arob'),
(17, 'epica_analisi.pdf', '2021-06-11-08-00', 1356894, 2, 10, '2arob'),
(18, 'epica_ripasso.pdf', '2021-05-27-10-00', 1356894, 2, 11, '3arob');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `alunni`
--
ALTER TABLE `alunni`
  ADD PRIMARY KEY (`id_alunno`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Indici per le tabelle `argomenti`
--
ALTER TABLE `argomenti`
  ADD PRIMARY KEY (`id_argomento`);

--
-- Indici per le tabelle `classi`
--
ALTER TABLE `classi`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `id_docente_coord` (`id_docente_coord`);

--
-- Indici per le tabelle `dirigenza`
--
ALTER TABLE `dirigenza`
  ADD PRIMARY KEY (`id_dirigenza`);

--
-- Indici per le tabelle `docenti`
--
ALTER TABLE `docenti`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indici per le tabelle `docentidelleclassi`
--
ALTER TABLE `docentidelleclassi`
  ADD PRIMARY KEY (`id_classe`,`id_docente`),
  ADD KEY `id_docente` (`id_docente`);

--
-- Indici per le tabelle `docentiinsegnanomaterie`
--
ALTER TABLE `docentiinsegnanomaterie`
  ADD PRIMARY KEY (`id_docente`,`id_materia`),
  ADD KEY `id_materia` (`id_materia`);

--
-- Indici per le tabelle `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_alunno` (`id_alunno`),
  ADD KEY `id_verifica` (`id_verifica`);

--
-- Indici per le tabelle `materie`
--
ALTER TABLE `materie`
  ADD PRIMARY KEY (`id_materia`);

--
-- Indici per le tabelle `verifiche`
--
ALTER TABLE `verifiche`
  ADD PRIMARY KEY (`id_verifica`),
  ADD KEY `id_argomento` (`id_argomento`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `id_materia` (`id_materia`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `argomenti`
--
ALTER TABLE `argomenti`
  MODIFY `id_argomento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `files`
--
ALTER TABLE `files`
  MODIFY `id_file` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT per la tabella `materie`
--
ALTER TABLE `materie`
  MODIFY `id_materia` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `verifiche`
--
ALTER TABLE `verifiche`
  MODIFY `id_verifica` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `alunni`
--
ALTER TABLE `alunni`
  ADD CONSTRAINT `alunni_ibfk_1` FOREIGN KEY (`id_classe`) REFERENCES `classi` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `classi`
--
ALTER TABLE `classi`
  ADD CONSTRAINT `classi_ibfk_1` FOREIGN KEY (`id_docente_coord`) REFERENCES `docenti` (`id_docente`);

--
-- Limiti per la tabella `docentidelleclassi`
--
ALTER TABLE `docentidelleclassi`
  ADD CONSTRAINT `docentidelleclassi_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docenti` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `docentidelleclassi_ibfk_3` FOREIGN KEY (`id_classe`) REFERENCES `classi` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `docentiinsegnanomaterie`
--
ALTER TABLE `docentiinsegnanomaterie`
  ADD CONSTRAINT `docentiinsegnanomaterie_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materie` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `docentiinsegnanomaterie_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docenti` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`id_alunno`) REFERENCES `alunni` (`id_alunno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`id_verifica`) REFERENCES `verifiche` (`id_verifica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `verifiche`
--
ALTER TABLE `verifiche`
  ADD CONSTRAINT `verifiche_ibfk_1` FOREIGN KEY (`id_argomento`) REFERENCES `argomenti` (`id_argomento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `verifiche_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classi` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `verifiche_ibfk_3` FOREIGN KEY (`id_docente`) REFERENCES `docenti` (`id_docente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `verifiche_ibfk_4` FOREIGN KEY (`id_materia`) REFERENCES `materie` (`id_materia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
