-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 13, 2026 at 01:33 PM
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
-- Database: `magazyn`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `kategoria` varchar(100) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `kategoria`, `ilosc`, `cena`) VALUES
(1, 'Dysk SSD Kingstone 1TB', 'Podzespoły', 0, 250.00),
(2, 'Pamięć RAM DDR4 16GB', 'Podzespoły', 5, 100.00),
(3, 'Kabel HDMI 2.0 2m', 'Akcesoria', 2, 25.00),
(4, 'Karta graficzna RTX 4060', 'Podzespoły', 15, 1450.00),
(5, 'Procesor AMD Ryzen 5 5600', 'Podzespoły', 8, 520.00),
(6, 'Pamięć RAM DDR4 16GB', 'Podzespoły', 25, 180.00),
(7, 'Monitor 24 cale IPS', 'Monitory', 1, 499.99),
(8, 'Myszka bezprzewodowa Logitech', 'Akcesoria', 30, 120.00),
(9, 'Klawiatura mechaniczna RGB', 'Akcesoria', 4, 250.00),
(10, 'Dysk SSD NVMe 1TB', 'Podzespoły', 12, 310.00),
(11, 'Zasilacz modularny 750W', 'Podzespoły', 0, 399.00),
(12, 'Słuchawki gamingowe z mikrofonem', 'Akcesoria', 19, 150.00),
(13, 'Podkładka pod mysz XL', 'Akcesoria', 3, 45.00);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
