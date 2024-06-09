-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 09, 2024 at 08:45 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksiegarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id_klienta` int(11) NOT NULL,
  `Nazwisko` varchar(30) NOT NULL,
  `Imie` varchar(15) NOT NULL,
  `Kod_pocztowy` text NOT NULL,
  `PESEL` int(11) NOT NULL,
  `Telefon` int(11) NOT NULL,
  `email` text NOT NULL,
  `adres` text DEFAULT NULL,
  `haslo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`id_klienta`, `Nazwisko`, `Imie`, `Kod_pocztowy`, `PESEL`, `Telefon`, `email`, `adres`, `haslo`) VALUES
(1, 'Jorek', 'Ewa', '33-100', 0, 451421512, 'ewa@02.pl', NULL, NULL),
(2, 'Kicior', 'Marek', '33-100', 0, 215121215, 'marek@poczta.pl', NULL, NULL),
(5, 'Nosalski', 'Egon', '25-124', 0, 542121212, 'kornik1@nowy.com', NULL, NULL),
(7, 'Kudła', ' Kacper', '33-100', 2147483647, 518401276, 'kacper.kudla.fifa22@gmail.com', 'Tarnów Podmiejska 25a', 'haslo1234'),
(8, 'Kowalski', 'Janusz', '33-100', 2147483647, 123123123, 'janusz@kow', 'Pomidorowa 20 Warszawa ', 'haslo123'),
(10, 'Kowal', 'Julia', '12-120', 2147483647, 123123123, 'j@k', 'hahahaowska', '123'),
(11, 'Adminowska', 'Halina', '12-123', 2147483647, 123123123, 'ha@ad', 'Jeżowa 47', '1234');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `id_ksiazki` int(11) NOT NULL,
  `tytul` varchar(40) DEFAULT NULL,
  `autor` varchar(80) DEFAULT NULL,
  `cena` float DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ksiazki`
--

INSERT INTO `ksiazki` (`id_ksiazki`, `tytul`, `autor`, `cena`, `ilosc`) VALUES
(6, 'Lalka', 'Bolesław Prus', 89.99, 6),
(8, 'W pustyni i w puszczy', 'Henryk Sienkiewicz', 29.99, 9),
(10, 'Bogaty ojciec biedny ojciec', 'Robert Kiyosaki', 59.99, 5),
(16, '48 praw władzy', 'Nie wiem', 15.99, 16),
(20, 'Pan Tadeusz', 'Adam Mickiewicz', 49.99, 18);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_zamowienia` int(11) NOT NULL,
  `id_klienta` int(11) DEFAULT NULL,
  `id_ksiazki` int(11) DEFAULT NULL,
  `data_zamowienia` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id_zamowienia`, `id_klienta`, `id_ksiazki`, `data_zamowienia`) VALUES
(45, 10, 8, '2024-06-05 23:04:39'),
(46, 10, 8, '2024-06-05 23:06:18'),
(47, 10, 10, '2024-06-05 23:07:36'),
(48, 10, 10, '2024-06-05 23:07:51'),
(49, 10, 10, '2024-06-05 23:08:19'),
(50, 10, 8, '2024-06-05 23:28:17'),
(51, 10, 10, '2024-06-05 23:28:34'),
(52, 10, 8, '2024-06-05 23:28:52'),
(53, 10, 10, '2024-06-05 23:33:46'),
(54, 10, 20, '2024-06-07 18:51:43'),
(55, 10, 10, '2024-06-07 18:53:50'),
(56, 11, 8, '2024-06-07 18:55:17');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klienta`);

--
-- Indeksy dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`id_ksiazki`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id_zamowienia`),
  ADD KEY `ksiazki_fk` (`id_ksiazki`),
  ADD KEY `klient_fk` (`id_klienta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `id_ksiazki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `klient_fk` FOREIGN KEY (`id_klienta`) REFERENCES `klient` (`Id_klienta`),
  ADD CONSTRAINT `ksiazki_fk` FOREIGN KEY (`id_ksiazki`) REFERENCES `ksiazki` (`id_ksiazki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
