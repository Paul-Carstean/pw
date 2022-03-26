-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: feb. 17, 2022 la 12:27 PM
-- Versiune server: 10.4.21-MariaDB
-- Versiune PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `sports`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `baseball`
--

CREATE TABLE `baseball` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT 'q',
  `team1` varchar(255) NOT NULL,
  `logo1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `baseball`
--

INSERT INTO `baseball` (`id`, `tag`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `price`) VALUES
(1, 'q', 'Red Sox', './logos/baseball/redSox.png', 'Houston Astros', './logos/baseball/houstonAstros.png', 'Fenway Park ,Massachusetts, Boston', '17/12/2021 16:00', 159),
(3, 'q', 'Cienfuegos', './logos/baseball/cienfuegos.png', 'Pinar del Rio', './logos/baseball/pinarDelRio.png', 'Cinco de Septiembre,  Cienfuegos, Cuba', '20/02/2022', 121);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `basketball`
--

CREATE TABLE `basketball` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT 'b',
  `team1` varchar(255) NOT NULL,
  `logo1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `basketball`
--

INSERT INTO `basketball` (`id`, `tag`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `price`) VALUES
(1, 'b', 'Lakers', './logos/basketball/lakers.png', 'Bulls', './logos/basketball/bulls.png', 'United Center, Chicago, Illinois, United States', '15/12/2021 20:00', 161),
(9, 'b', 'Dallas Mavericks', './logos/basketball/dallasMavericks.png', 'Detroi Pistons', './logos/basketball/detroitPistons.png', 'American Airlines Center, Dallas, Texas', '14/05/2022', 175);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `football`
--

CREATE TABLE `football` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT 'f',
  `team1` varchar(255) NOT NULL,
  `logo1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `football`
--

INSERT INTO `football` (`id`, `tag`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `price`) VALUES
(1, 'f', 'Liverpool', './logos/football/liverpool.png', 'Manchester United', './logos/football/manUnt.png', 'Anfield, Liverpool, Merseyside, England', '18/02/2022 21:00', 161),
(2, 'f', 'Manchester City', './logos/football/manCity.png', 'Arsenal', './logos/football/arsenal.png', 'Eithad, Manchester, England', '04/12/2021 22:00', 116),
(3, 'f', 'Barcelona', './logos/football/barcelona.png', 'Real Madrid', './logos/football/realMadrid.png', 'Barcelona, Catalonia, Spain', '02/12/2021 21:00', 190),
(12, 'f', 'PSG', './logos/football/psg.png', 'Rennes', './logos/football/rennes.png', 'Parc des Princes, Paris, France', '23/03/2022 22:00', 243);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `tennis`
--

CREATE TABLE `tennis` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL DEFAULT 't',
  `team1` varchar(255) NOT NULL,
  `logo1` varchar(255) NOT NULL,
  `team2` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `tennis`
--

INSERT INTO `tennis` (`id`, `tag`, `team1`, `logo1`, `team2`, `logo2`, `location`, `date`, `price`) VALUES
(1, 't', 'Novak Đoković', './logos/tennis/serbia.png', 'Roger Federer', './logos/tennis/elvetia.png', 'Arthur Ashe Stadium,New York City,United States', '16/12/2021 18:00', 249),
(2, 't', 'Rafael Nadal', './logos/tennis/spain.png', 'Andy Murray', './logos/tennis/regatulUnit.png', 'O2 Arena,London,United Kingdom', '22/12/2021 23:00', 210),
(5, 't', 'Serena Williams', './logos/tennis/usa.png', 'Simona Halep', './logos/tennis/romania.png', 'Plough Lane, Wimbledon', '16/03/2022', 199);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `baseball`
--
ALTER TABLE `baseball`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `basketball`
--
ALTER TABLE `basketball`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `football`
--
ALTER TABLE `football`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `tennis`
--
ALTER TABLE `tennis`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `baseball`
--
ALTER TABLE `baseball`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `basketball`
--
ALTER TABLE `basketball`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pentru tabele `football`
--
ALTER TABLE `football`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pentru tabele `tennis`
--
ALTER TABLE `tennis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
