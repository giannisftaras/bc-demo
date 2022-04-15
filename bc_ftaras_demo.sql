-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 15 Απρ 2022 στις 10:55:37
-- Έκδοση διακομιστή: 10.4.20-MariaDB
-- Έκδοση PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `bc_ftaras_demo`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `casino_cards`
--

CREATE TABLE `casino_cards` (
  `id` int(11) NOT NULL,
  `casino_name` varchar(100) NOT NULL,
  `plan_id` varchar(50) NOT NULL,
  `plan_rating` float(2,1) NOT NULL,
  `plan_price` int(3) NOT NULL,
  `plan_currency` int(1) NOT NULL DEFAULT 0,
  `terms_text` varchar(100) NOT NULL,
  `plan_description` varchar(250) NOT NULL,
  `cta_text` varchar(50) NOT NULL,
  `cta_url` varchar(250) DEFAULT NULL,
  `review_btn_text` varchar(50) NOT NULL,
  `review_btn_url` varchar(250) DEFAULT NULL,
  `card_order` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `casino_cards`
--

INSERT INTO `casino_cards` (`id`, `casino_name`, `plan_id`, `plan_rating`, `plan_price`, `plan_currency`, `terms_text`, `plan_description`, `cta_text`, `cta_url`, `review_btn_text`, `review_btn_url`, `card_order`) VALUES
(1, 'Unibet Casino', 'L1160657W000330', 4.9, 500, 0, 'T&C', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Activeaza Bonusul', NULL, 'Read Review', NULL, 1),
(2, 'Paddypower Casino', 'L1160657W000330', 4.9, 500, 0, 'T&C', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum imperdiet, odio at', 'Activeaza Bonusul', NULL, 'Read Review', NULL, 0),
(3, 'Betano Casino', 'L1160657W000330', 4.9, 500, 0, 'T&C', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Activeaza Bonusul', NULL, 'Read Review', NULL, 2);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `header_menu`
--

CREATE TABLE `header_menu` (
  `id` int(11) NOT NULL,
  `menu_text` varchar(50) NOT NULL,
  `menu_url` varchar(150) DEFAULT NULL,
  `menu_parent` int(11) DEFAULT NULL,
  `menu_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `header_menu`
--

INSERT INTO `header_menu` (`id`, `menu_text`, `menu_url`, `menu_parent`, `menu_order`) VALUES
(1, 'Online Casinos', '#', NULL, 0),
(2, 'Unibet Casino', '#', 1, 0),
(3, 'Paddypower Casino', '#', 1, 1),
(4, 'Betano Casino', '#', 1, 2),
(5, 'Slots', '#', NULL, 1),
(6, 'Software', '#', NULL, 2),
(7, 'Bonuses', '#', NULL, 3),
(8, 'News', '#', NULL, 4),
(9, 'Blackjack', '#', NULL, 5),
(10, 'Roulette', '#', NULL, 6),
(11, 'Live Casino', '#', NULL, 7),
(12, 'Poker', '#', NULL, 8),
(13, 'Extra', '#', NULL, 9);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `casino_cards`
--
ALTER TABLE `casino_cards`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `header_menu`
--
ALTER TABLE `header_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `casino_cards`
--
ALTER TABLE `casino_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `header_menu`
--
ALTER TABLE `header_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
