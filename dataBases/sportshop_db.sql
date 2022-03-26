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
-- Bază de date: `sportshop_db`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `cart`
--

CREATE TABLE `cart` (
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `tagTicket` varchar(255) NOT NULL,
  `number` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `favorite`
--

CREATE TABLE `favorite` (
  `idUser` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL,
  `tagTicket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `favorite`
--

INSERT INTO `favorite` (`idUser`, `idTicket`, `tagTicket`) VALUES
(5, 3, 'q'),
(5, 1, 'f');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `command` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `email`, `address`, `city`, `state`, `zip`, `total`, `command`) VALUES
(24, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '1449', '1f2 3f2 1t3'),
(25, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '1741', '1f3 3f4 1t2'),
(26, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '322', '1f1'),
(27, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '760', '3f4'),
(28, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '554', '1f1 3f1 2t1 2f1'),
(29, 'Cârstean Paul', 'carstean.paul@gmail.com', 'Str Florilor Nr 11 Buziaș', 'Buzias', 'Romania', '305100', '799', '1f2 1q3'),
(30, 'Oltean Edi', 'oltean.edi@yahoo.com', 'Str. Viorelelor nr. 20', 'Buzias', 'Romania', '305100', '731', '1f1 3f3'),
(32, 'Oltean Edi', 'oltean.edi@yahoo.com', 'Str. Viorelelor nr. 20', 'Buzias', 'Romania', '305100', '713', '9b2 3q3');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`) VALUES
(5, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test'),
(6, 'edi', '8457dff5491b024de6b03e30b609f7e8', 'edi');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
