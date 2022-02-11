 -- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Dic 01, 2021 alle 21:05
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dopo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `accounts`
--

CREATE TABLE `accounts` (
  `id_account` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `accounts`
--

INSERT INTO `accounts` (`id_account`, `username`, `password`) VALUES
(70, 'vladpostu_', '$2y$10$f.6r/5YB1TfaAhOVleS.3ewc8NlEl.HVkc8OATjxFOzxTFRypznMm'),
(71, 'User1', '$2y$10$5XtqbQ.OLE4qbvRKE5xn2.hYm055sINW3VRq3eBVwTeNeWPDm7B/C');

-- --------------------------------------------------------

--
-- Struttura della tabella `ads`
--

CREATE TABLE `ads` (
  `id_ad` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ads`
--

INSERT INTO `ads` (`id_ad`, `name`, `price`, `image`, `category`) VALUES
(33, 'Helter Skelter', 25, 'https://www.ibs.it/images/9788804714699_0_536_0_75.jpg', 3),
(36, 'Fantastica pianta decorativa', 9, 'https://saleor-yougardener.s3.amazonaws.com/media/products/Kenzia.png', 4),
(37, 'AirPods v2', 99, 'https://m.media-amazon.com/images/I/71NTi82uBEL._AC_SL1500_.jpg', 1),
(38, 'Capotasto chittara', 9, 'https://media.musyance.com/posts/2020/29/o_9d7f26fbc7e014a8df612d5ef1744596-15feb0f8c2ec1e.jpg', 5),
(39, 'Lampada', 29, 'https://static.westwingnow.de/image/upload/seo/simple/37/959/1215170/Lampada-da-scrivania-blu-Study.jpg', 2),
(40, 'Maglietta', 19, 'https://m.media-amazon.com/images/I/61qwZ8rlE3L._AC_UL1024_.jpg', 5),
(41, 'Disco ', 15, 'https://www.rockbywild.it/wp-content/uploads/2020/08/iron_maiden_iron_maiden.jpg', 5),
(42, 'Stampante', 59, 'https://www.enelxstore.com/content/dam/enel-x-store-it/prodotti_catalogo/elettrodomestici-e-tecnologia/tecnologia/stampanti-multifunzione/Multifunzione-laser-Xerox---B205v-ni---stampante-multifunzione---b-n-b205v_ni.png.resize.612.380.center.center.png', 1),
(43, 'Dino', 30, 'https://m.media-amazon.com/images/I/41dFi6aTHJL._AC_.jpg', 5);

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id_category`, `name`) VALUES
(1, 'Elettronica'),
(2, 'Casa'),
(3, 'Libri'),
(4, 'Piante'),
(5, 'Altro');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `cellphone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `surname`, `city`, `cellphone`) VALUES
(70, 'Vlad', 'Postu', 'Spinea', 2147483647),
(71, 'User1', 'Surname1', 'Spinea', 12312332);

-- --------------------------------------------------------

--
-- Struttura della tabella `users_ad`
--

CREATE TABLE `users_ad` (
  `id_user_ad` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_ad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `users_ad`
--

INSERT INTO `users_ad` (`id_user_ad`, `id_user`, `id_ad`) VALUES
(13, 70, 33),
(16, 71, 36),
(17, 70, 37),
(18, 70, 38),
(19, 70, 39),
(20, 70, 40),
(21, 71, 41),
(22, 71, 42),
(23, 71, 43);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `accounts`
--
ALTER TABLE `accounts`
  ADD KEY `id_account` (`id_account`);

--
-- Indici per le tabelle `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id_ad`),
  ADD KEY `category` (`category`);

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indici per le tabelle `users_ad`
--
ALTER TABLE `users_ad`
  ADD PRIMARY KEY (`id_user_ad`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_ad` (`id_ad`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ads`
--
ALTER TABLE `ads`
  MODIFY `id_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT per la tabella `users_ad`
--
ALTER TABLE `users_ad`
  MODIFY `id_user_ad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `users` (`id_user`);

--
-- Limiti per la tabella `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id_category`);

--
-- Limiti per la tabella `users_ad`
--
ALTER TABLE `users_ad`
  ADD CONSTRAINT `users_ad_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `users_ad_ibfk_2` FOREIGN KEY (`id_ad`) REFERENCES `ads` (`id_ad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
