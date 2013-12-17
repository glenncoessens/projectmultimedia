-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 14 dec 2013 om 17:59
-- Serverversie: 5.6.12-log
-- PHP-versie: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `jrr`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) NOT NULL,
  `subject` longtext NOT NULL,
  `routedescription` longtext NOT NULL,
  `floorplan` varchar(256) NOT NULL,
  `sequence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `route`
--

INSERT INTO `route` (`id`, `name`, `subject`, `routedescription`, `floorplan`, `sequence`) VALUES
(1, 'Les Arts Exotiques', 'Hartelijk welkom in de gebouwen van de Brusselse Koninklijke Musea voor Kunst en Geschiedenis. Dit gebouw, beter bekend als het Jubelparkmuseum, werd aan het eind van de 19de eeuw gebouwd in opdracht van Leopold II. Het museum herbergt duizenden kunstwerken en historische objecten van alle tijden. Vandaag maken we samen met jou een boeiende reis doorheen die tijd en ruimte. We zullen in vogelvlucht proeven van een vleugje nationale archeologie vanaf de prehistorie tot en met de nieuwe tijden. Veel plezier!', 'Je bevindt je momenteel op het eerste niveau in de cirkelvormige zaal, nabij de ingang. Ga richting Grote Narthex, de centrale grote zaal van de Europese sierkunsten. Aan het einde van deze zaal bevindt zich een grote trappenhal. Neem de trap richting niveau 0. Hier gaat de rest van je nationaal avontuur verder!', 'gf1.png', 1),
(7, 'Vrijetijdsbesteding', 'We vragen het ons allemaal wel eens af op een vrije dag: wat ga ik doen? Tijdens deze\r\nrondleiding maak je kennis met hoe men omging met vrije tijd in het verleden.', 'Het eerste voorwerp van deze route kan je vinden op niveau +2 aan de balustrade voor zaal 97.\r\n', 'gf7.png', 7),
(8, 'Grafgiften', 'Vandaag nemen we je mee in de tijd en gaan we gebruiksvoorwerpen in graven\r\nonderzoeken. Ze geven ons veel informatie over het leven van de overledene en de\r\ngewoonten die men toen had. Wie waren deze mensen, waar leefden ze, wat was hun\r\nberoep, wat was hun status? Op al deze vragen zoeken we een antwoord tijdens deze route.', 'Het eerste voorwerp kan je vinden in zaal 1, kast 40. In deze kast kan je bij nummer 9 een\r\nurne vinden.', 'gf8.png', 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
