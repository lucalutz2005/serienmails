
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00"; 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */; 
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */; 
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */; 
/*!40101 SET NAMES utf8mb4 */; 
-- 
-- Datenbank: `serienmails` 
-- 

-- -------------------------------------------------------- 

-- 
-- Tabellenstruktur für Tabelle `einladungen` 
-- 

CREATE TABLE `einladungen` (
  `user_email` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `antwort` int(100) DEFAULT NULL,
  `IP` varchar(100) DEFAULT NULL,
  `Uhrzeit` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `hash` varchar(100) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; 
  
-- -------------------------------------------------------- 
 
-- 
-- Tabellenstruktur für Tabelle `events`
-- 

  CREATE TABLE `events` (
  `name` varchar(59) NOT NULL,
  `inhalt_pfad` varchar(59) NOT NULL,
  `anhang_pfad` varchar(59) DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1; 
  
-- -------------------------------------------------------- 
-- 
-- Tabellenstruktur für Tabelle `users`
-- 

CREATE TABLE `users` (
  `name` char(59) NOT NULL,
  `IP` tinytext NOT NULL,
  `email` tinytext NOT NULL ) ENGINE=MyISAM DEFAULT CHARSET=latin1; -- -- Daten für Tabelle `users` -- 

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`name`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
