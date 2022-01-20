-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 20, 2022 alle 10:57
-- Versione del server: 10.4.21-MariaDB
-- Versione PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UniboVinyl`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `album`
--

CREATE TABLE `album` (
  `idAlbum` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `idAuthor` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `album_genre`
--

CREATE TABLE `album_genre` (
  `album` int(11) NOT NULL,
  `genre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `author`
--

CREATE TABLE `author` (
  `idAuthor` int(11) NOT NULL,
  `artName` char(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `cartEntry`
--

CREATE TABLE `cartEntry` (
  `idProduct` int(11) NOT NULL,
  `idCustomer` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `creditCard`
--

CREATE TABLE `creditCard` (
  `idCard` int(11) NOT NULL,
  `cardNumber` varchar(16) NOT NULL,
  `circuit` varchar(10) NOT NULL,
  `expiryDate` date NOT NULL,
  `isDeleted` tinyint(4) NOT NULL,
  `idCustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `creditCard`
--

INSERT INTO `creditCard` (`idCard`, `cardNumber`, `circuit`, `expiryDate`, `isDeleted`, `idCustomer`) VALUES
(70, 'eeee', 'eeee', '2021-12-02', 0, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `customer`
--

CREATE TABLE `customer` (
  `idCustomer` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(150) NOT NULL,
  `idCard` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `customer`
--

INSERT INTO `customer` (`idCustomer`, `name`, `surname`, `email`, `username`, `password`, `idCard`) VALUES
(1, 'q', 'q', 'q@q.com', 'q', '$2y$10$EkVeoRSbdh5IY.uliMdeQO7qQKojPUbYwq2PabgqUi7m8w3Eww0bK', NULL),
(4, 'Gi', 'Gi', 'Gi@Gi.Gi', 'Gi', '$2y$10$35F2oD/Mk9l.FZEh0KTjLexYL4KykZ7ebuIWEpeeOV6GFs6ckOwl2', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `customerOrder`
--

CREATE TABLE `customerOrder` (
  `idOrder` int(11) NOT NULL,
  `state` tinyint(11) NOT NULL,
  `orderDate` date NOT NULL,
  `shippingDate` date NOT NULL,
  `deliveryDate` date NOT NULL,
  `idCustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `featuring`
--

CREATE TABLE `featuring` (
  `idAuthor` int(11) NOT NULL,
  `idAlbum` int(11) NOT NULL,
  `song` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `genre`
--

CREATE TABLE `genre` (
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(280) NOT NULL,
  `notificationDate` date NOT NULL,
  `isRead` char(1) NOT NULL,
  `isDeleted` char(1) NOT NULL,
  `idCustomer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `orderDetail`
--

CREATE TABLE `orderDetail` (
  `idProduct` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subprice` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `product`
--

CREATE TABLE `product` (
  `idProduct` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `description` varchar(280) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `idAuthor` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `idAlbum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `song`
--

CREATE TABLE `song` (
  `idAlbum` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `transaction`
--

CREATE TABLE `transaction` (
  `idTransaction` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  `idCard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `vendor`
--

CREATE TABLE `vendor` (
  `idVendor` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idAlbum`),
  ADD UNIQUE KEY `IDalbum_1` (`idAuthor`,`name`);

--
-- Indici per le tabelle `album_genre`
--
ALTER TABLE `album_genre`
  ADD PRIMARY KEY (`genre`,`album`),
  ADD KEY `FKalbum` (`album`);

--
-- Indici per le tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`idAuthor`);

--
-- Indici per le tabelle `cartEntry`
--
ALTER TABLE `cartEntry`
  ADD PRIMARY KEY (`idCustomer`,`idProduct`),
  ADD KEY `FKrelativeTo` (`idProduct`);

--
-- Indici per le tabelle `creditCard`
--
ALTER TABLE `creditCard`
  ADD PRIMARY KEY (`idCard`),
  ADD UNIQUE KEY `IDcreditCard_1` (`cardNumber`),
  ADD KEY `FKhas` (`idCustomer`);

--
-- Indici per le tabelle `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idCustomer`),
  ADD KEY `FKprefers` (`idCard`);

--
-- Indici per le tabelle `customerOrder`
--
ALTER TABLE `customerOrder`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `FKorders` (`idCustomer`);

--
-- Indici per le tabelle `featuring`
--
ALTER TABLE `featuring`
  ADD PRIMARY KEY (`idAuthor`,`idAlbum`,`song`),
  ADD KEY `FKsong` (`idAlbum`,`song`);

--
-- Indici per le tabelle `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`name`);

--
-- Indici per le tabelle `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `FKto` (`idCustomer`);

--
-- Indici per le tabelle `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD PRIMARY KEY (`idOrder`,`idProduct`),
  ADD KEY `FKof` (`idProduct`);

--
-- Indici per le tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `FKplays` (`idAlbum`);

--
-- Indici per le tabelle `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`idAlbum`,`name`);

--
-- Indici per le tabelle `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idTransaction`),
  ADD UNIQUE KEY `FKpayment_ID` (`idOrder`),
  ADD KEY `FKwith` (`idCard`);

--
-- Indici per le tabelle `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`idVendor`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `album`
--
ALTER TABLE `album`
  MODIFY `idAlbum` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `author`
--
ALTER TABLE `author`
  MODIFY `idAuthor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `creditCard`
--
ALTER TABLE `creditCard`
  MODIFY `idCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT per la tabella `customer`
--
ALTER TABLE `customer`
  MODIFY `idCustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `product`
--
ALTER TABLE `product`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `vendor`
--
ALTER TABLE `vendor`
  MODIFY `idVendor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FKwrittenBy` FOREIGN KEY (`idAuthor`) REFERENCES `author` (`idAuthor`);

--
-- Limiti per la tabella `album_genre`
--
ALTER TABLE `album_genre`
  ADD CONSTRAINT `FKalbum` FOREIGN KEY (`album`) REFERENCES `album` (`idAlbum`),
  ADD CONSTRAINT `FKgenre` FOREIGN KEY (`genre`) REFERENCES `genre` (`name`);

--
-- Limiti per la tabella `cartEntry`
--
ALTER TABLE `cartEntry`
  ADD CONSTRAINT `FKfilledBy` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`),
  ADD CONSTRAINT `FKrelativeTo` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);

--
-- Limiti per la tabella `creditCard`
--
ALTER TABLE `creditCard`
  ADD CONSTRAINT `FKhas` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`);

--
-- Limiti per la tabella `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FKprefers` FOREIGN KEY (`idCard`) REFERENCES `creditCard` (`idCard`);

--
-- Limiti per la tabella `customerOrder`
--
ALTER TABLE `customerOrder`
  ADD CONSTRAINT `FKorders` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`);

--
-- Limiti per la tabella `featuring`
--
ALTER TABLE `featuring`
  ADD CONSTRAINT `FKauthor` FOREIGN KEY (`idAuthor`) REFERENCES `author` (`idAuthor`),
  ADD CONSTRAINT `FKsong` FOREIGN KEY (`idAlbum`,`song`) REFERENCES `song` (`idAlbum`, `name`);

--
-- Limiti per la tabella `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FKto` FOREIGN KEY (`idCustomer`) REFERENCES `customer` (`idCustomer`);

--
-- Limiti per la tabella `orderDetail`
--
ALTER TABLE `orderDetail`
  ADD CONSTRAINT `FKdetail` FOREIGN KEY (`idOrder`) REFERENCES `customerOrder` (`idOrder`),
  ADD CONSTRAINT `FKof` FOREIGN KEY (`idProduct`) REFERENCES `product` (`idProduct`);

--
-- Limiti per la tabella `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FKplays` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`);

--
-- Limiti per la tabella `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `FKplaylist` FOREIGN KEY (`idAlbum`) REFERENCES `album` (`idAlbum`);

--
-- Limiti per la tabella `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FKpayment_FK` FOREIGN KEY (`idOrder`) REFERENCES `customerOrder` (`idOrder`),
  ADD CONSTRAINT `FKwith` FOREIGN KEY (`idCard`) REFERENCES `creditCard` (`idCard`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
