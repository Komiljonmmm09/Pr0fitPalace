-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2023 г., 17:22
-- Версия сервера: 10.7.5-MariaDB-log
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ProfitPalace.ru`
--
CREATE DATABASE IF NOT EXISTS `ProfitPalace.ru` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ProfitPalace.ru`;

-- --------------------------------------------------------

--
-- Структура таблицы `bonuses`
--

DROP TABLE IF EXISTS `bonuses`;
CREATE TABLE IF NOT EXISTS `bonuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_account_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL,
  `Bonus` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bonuses`
--

INSERT DELAYED IGNORE INTO `bonuses` (`id`, `login_account_id`, `time`, `Bonus`) VALUES
(1, 'Romaaa', '2023-12-23 13:30:24', 2),
(2, 'Romaaa122232', '2023-12-23 13:37:50', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_DCity`
--

DROP TABLE IF EXISTS `transactions_DCity`;
CREATE TABLE IF NOT EXISTS `transactions_DCity` (
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transactions_DCity`
--

INSERT DELAYED IGNORE INTO `transactions_DCity` (`phone_number`, `card_number`, `amount`, `login`) VALUES
('+123 (123) 123 23', '2522 5252 5252 5252', '50.00', 'Romaaa'),
('+893 (233) 828 77', '2020 2222 2231 3213', '1212.00', 'Romaaa');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_payeer`
--

DROP TABLE IF EXISTS `transactions_payeer`;
CREATE TABLE IF NOT EXISTS `transactions_payeer` (
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Receivers_wallet` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transactions_payeer`
--

INSERT DELAYED IGNORE INTO `transactions_payeer` (`phone_number`, `Receivers_wallet`, `amount`, `login`) VALUES
('+132 (132) 132 1212', '', '123.00', 'Romaaa'),
('+132 (132) 132 1212', '', '123.00', 'Romaaa'),
('+132 (132) 132 1212', '', '123.00', 'Romaaa'),
('+132 (132) 132 1212', '', '123.00', 'Romaaa'),
('+893 (233) 828 77', '', '1022.00', 'Romaaa');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_qiwi`
--

DROP TABLE IF EXISTS `transactions_qiwi`;
CREATE TABLE IF NOT EXISTS `transactions_qiwi` (
  `phone_number` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kiwi_wallet_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transactions_qiwi`
--

INSERT DELAYED IGNORE INTO `transactions_qiwi` (`phone_number`, `kiwi_wallet_number`, `amount`, `login`) VALUES
('+651 (651) 651 6565', '2342343242342', '56.00', 'Romaaa'),
('+893 (233) 828 77', '1231231232131', '100.00', 'Romaaa');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions_sberbank`
--

DROP TABLE IF EXISTS `transactions_sberbank`;
CREATE TABLE IF NOT EXISTS `transactions_sberbank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transactions_sberbank`
--

INSERT DELAYED IGNORE INTO `transactions_sberbank` (`id`, `phone_number`, `card_number`, `amount`, `login`) VALUES
(1, '', '2020 2222 2231 3213', '200.00', 'Romaaa'),
(2, '', '2020 2222 2231 3213', '2000.00', 'Romaaa'),
(3, '', '2020 2222 2231 3213', '200.00', 'Romaaa');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` decimal(40,20) NOT NULL,
  `registration_time` datetime DEFAULT NULL,
  `referral_code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percent` float DEFAULT NULL,
  `currentTime` time DEFAULT NULL,
  `online` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT DELAYED IGNORE INTO `users` (`id`, `login`, `password`, `email`, `account`, `registration_time`, `referral_code`, `percent`, `currentTime`, `online`) VALUES
(1, 'Romaaa', 'roma', 'ROMISH@gmail.com', '9479.54655201765900000000', '2023-12-16 21:48:11', 'Romaaa1391', 1, '00:00:00', 0),
(3, 'Romaaa1', 'roma', 'abduvohidov@gmai.com', '35.24915000022071000000', '2023-12-17 12:05:48', 'Romaaa11351', 2, '00:00:00', 0),
(4, 'Romaaa12', 'roma', 'abduvohidovromis@gmail.com', '15.02880555556265200000', '2023-12-17 12:25:33', 'Romaaa121136', 16, '00:00:00', 0),
(5, 'Romaaa1111', 'roma', 'ra-officail@mail.ru', '35.01861388889347500000', '2023-12-17 12:47:04', 'Romaaa11115298', 1, '00:00:00', 0),
(6, 'admin@mail.ru', 'roma', 'admin@mail.com', '15.00000000000000000000', '2023-12-17 21:53:14', 'admin@mail.ru1395', NULL, '00:00:00', 0),
(7, 'Taj_Gram_admin', 'roma', 'dfjkvnlkvfweskijdcvnmdkajn@mail.ru', '15.00000000000000000000', '2023-12-17 21:56:04', 'Taj_Gram_admin6393', NULL, '00:00:00', 0),
(8, 'Taj_Gram_adminw', 'roma', 'wefwefef@gmail.c', '15.00000000000000000000', '2023-12-17 21:59:29', 'Taj_Gram_adminw5814', NULL, '00:00:00', 0),
(9, 'Taj_Gram_admin2', 'roma', 'abfdvjinfevhu@gmail.con', '15.04086944445451300000', '2023-12-17 22:04:40', 'Taj_Gram_admin21078', NULL, '00:00:00', 0),
(10, 'Romaaa222', 'roma', 'abdlcdsdjcnk@gmail.com', '18.19988148148314600000', '2023-12-18 17:27:00', 'Romaaa2225866', NULL, '00:00:00', 0),
(11, 'Romaaa122', 'Roma160506', 'bdshjcbdjhfkcbjsfhcc@gmial.com', '61.27854884250893000000', '2023-12-18 19:19:01', 'Romaaa1224065', NULL, '00:00:00', 0),
(12, 'Romaaa1222', 'Roma160506', 'rtgrtg@gfmail.coi', '0.34195162037037186000', '2023-12-19 16:10:59', 'Romaaa12224245', 1, '00:00:00', 0),
(13, 'Romaaa12223', 'Roma160506', 'gfbfgb@gmail.com', '27.01864212963623000000', '2023-12-19 16:12:30', 'Romaaa122239345', 1, '00:00:01', 0),
(14, 'Romaaa122232', 'Roma160506', 'fdsvfdfvdvhj@gmail.com', '89.21833449071451000000', '2023-12-19 20:29:11', 'Romaaa1222323150', 1, '00:00:00', 0),
(15, 'Romaaa2', 'romasdfsdfsdfsdfdfvWcxcx2', 'dvfvdfvdv@ffv.re', '15.34820138888859400000', '2023-12-20 17:21:38', 'Romaaa28672', 1, '00:00:00', 0),
(16, 'Romaaa22', 'romafdvhbjSCDhjbdf3', 'refundskfvbejrbvfje@gdf.ru', '0.14820879629629655000', '2023-12-23 05:08:21', 'Romaaa225296', 1, '00:00:00', 0),
(17, 'Romaaa2212', 'romafdvhbjSCDhjbdf3', 'ghvjhbbjhjhkl@gmail.com', '2.50972847222221240000', '2023-12-23 13:55:55', 'Romaaa22125645', 1, '00:00:00', 0),
(18, 'Romaaa2223232e', 'romadfvdsvf@W@32', 'ra-dfvjkndlfvnjk@fdj.dfvn', '12.54276296296298900000', '2023-12-23 14:23:38', 'Romaaa2223232e2709', 1, '00:00:00', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
