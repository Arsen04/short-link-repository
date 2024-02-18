-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 18 2024 г., 19:12
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `short_link`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231125220445', '2023-11-25 23:05:21', 203);

-- --------------------------------------------------------

--
-- Структура таблицы `short_link`
--

CREATE TABLE `short_link` (
  `id` int(11) NOT NULL,
  `base_url` longtext NOT NULL,
  `short_url` varchar(255) NOT NULL,
  `redirect_count` int(11) DEFAULT NULL,
  `website_host` varchar(255) NOT NULL,
  `life_time` double NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `deleted_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `url_path` varchar(255) NOT NULL,
  `qr_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `short_link`
--

INSERT INTO `short_link` (`id`, `base_url`, `short_url`, `redirect_count`, `website_host`, `life_time`, `created_at`, `updated_at`, `deleted_at`, `url_path`, `qr_code`) VALUES
(21, 'https://www.example.com/path/to/resource', 'sfsfdf', 0, 'www.example.com\r\n', 1728000, '2023-11-26 15:47:12', NULL, NULL, '/path/to/resource\r\n', ''),
(22, 'https://ru.wikipedia.org/wiki/%D0%9F%D1%80%D0%BE%D0%B8%D1%81%D1%85%D0%BE%D0%B6%D0%B4%D0%B5%D0%BD%D0%B8%D0%B5_%D1%81%D0%B5%D0%BC%D1%8C%D0%B8,_%D1%87%D0%B0%D1%81%D1%82%D0%BD%D0%BE%D0%B9_%D1%81%D0%BE%D0%B1%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D0%BE%D1%81%D1%82%D0%B8_%D0%B8_%D0%B3%D0%BE%D1%81%D1%83%D0%B4%D0%B0%D1%80%D1%81%D1%82%D0%B2%D0%B0', 'dsfsfsf', 2, 'ru.wikipedia.org\r\n', 1728000, '2023-11-26 16:35:03', '2024-02-16 20:36:17', NULL, '/wiki/%D0%9F%D1%80%D0%BE%D0%B8%D1%81%D1%85%D0%BE%D0%B6%D0%B4%D0%B5%D0%BD%D0%B8%D0%B5_%D1%81%D0%B5%D0%BC%D1%8C%D0%B8,_%D1%87%D0%B0%D1%81%D1%82%D0%BD%D0%BE%D0%B9_%D1%81%D0%BE%D0%B1%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D0%BE%D1%81%D1%82%D0%B8_%D0%B8_%D0%B3%D0', ''),
(23, 'https://ru.wikipedia.org/wiki/%D0%9C%D0%B8%D0%BA%D0%BE%D1%8F%D0%BD,_%D0%90%D0%BD%D0%B0%D1%81%D1%82%D0%B0%D1%81_%D0%98%D0%B2%D0%B0%D0%BD%D0%BE%D0%B2%D0%B8%D1%87', '73764c0e', 2, 'ru.wikipedia.org\r\n', 1728000, '2024-02-16 20:39:52', '2024-02-17 01:15:02', NULL, '/wiki/%D0%9C%D0%B8%D0%BA%D0%BE%D1%8F%D0%BD,_%D0%90%D0%BD%D0%B0%D1%81%D1%82%D0%B0%D1%81_%D0%98%D0%B2%D0%B0%D0%BD%D0%BE%D0%B2%D0%B8%D1%87\r\n', ''),
(24, 'https://ru.wikipedia.org/wiki/%D0%9C7', 'adsdsds', 10, 'ru.wikipedia.org\r\n', 1728000, '2024-02-17 01:15:14', '2024-02-17 01:18:04', NULL, '/wiki/%D0%9C7\r\n', ''),
(25, 'https://ru.wikipedia.org/wiki/%D0%sdsdsd9C7', 'af168dd1', 0, 'ru.wikipedia.org\r\n', 1728000, '2024-02-17 01:18:08', '2024-02-17 09:21:56', NULL, '/wiki/%D0%sdsdsd9C7\r\n', ''),
(26, 'http://llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch.co.uk/%22%20%5Ct%20%22_blank', '48deec17', 1, 'llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch.co.uk\r\n', 1728000, '2024-02-17 10:00:38', NULL, NULL, '/%22%20%5Ct%20%22_blank\r\n', ''),
(27, 'https://www.facebook.com/search/top/?q=%D0%90%D0%BD%D0%B4%D1%80%D0%B5%D0%B9%20%D0%90%D0%BD%D0%B4%D1%80%D0%B5%D0%B9', '4f0ab15e', 0, 'www.facebook.com\r\n', 1728000, '2024-02-17 10:46:01', NULL, NULL, '/search/top/\r\n', ''),
(28, 'https://www.google.com/search?q=%D0%BD%D1%89%D0%B3%D0%B5%D0%B3%D0%B8%D1%83&oq=%D0%BD%D1%89%D0%B3%D0%B5%D0%B3%D0%B8&aqs=chrome.0.35i39i512i650j46i199i465i512j69i57j0i512l3j0i10i512j0i512j0i10i512j0i512.1368j0j7&sourceid=chrome&ie=UTF-8', '338f0b62', 2, 'www.google.com\r\n', 1728000, '2024-02-17 11:04:19', NULL, NULL, '/search\r\n', 'QR-0afb3ad11011c96e.png'),
(29, 'https://www.youtube.com/watch?v=4W7QP0td_eM&ab_channel=ClassicMusic', '80973397', 2, 'www.youtube.com\r\n', 1728000, '2024-02-17 11:32:52', '2024-02-18 18:57:45', NULL, '/watch\r\n', 'QR-1bb6f2f88a576342.png'),
(30, 'https://www.youtube.com/asdatch?v=4W7QP0td_eM&ab_channel=ClassicMusic', '2bd2b25e', 0, 'www.youtube.com\r\n', 1728000, '2024-02-18 18:58:05', NULL, NULL, '/asdatch\r\n', 'QR-28b0b85cccbf2bf9.png'),
(32, 'https://ru.wikipedia.org/wiki/%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%BE-%D0%BF%D0%B5%D1%80%D1%81%D0%B8%D0%B4%D1%81%D0%BA%D0%B0%D1%8F_%D0%B2%D0%BE%D0%B9%D0%BD%D0%B0_(1826%E2%80%941828)#:~:text=%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%BE%2D%D0%BF%D0%B5%D1%80%D1%81%D0%B8%D0%B4%D1%81%D0%BA%D0%B0%D1%8F%20%D0%B2%D0%BE%D0%B9%D0%BD%D0%B0%201826%E2%80%941828,(%D0%AD%D1%80%D0%B8%D0%B2%D0%B0%D0%BD%D1%81%D0%BA%D0%BE%D0%B5%20%D0%B8%20%D0%9D%D0%B0%D1%85%D0%B8%D1%87%D0%B5%D0%B2%D0%B0%D0%BD%D1%81%D0%BA%D0%BE%D0%B5%20%D1%85%D0%B0%D0%BD%D1%81%D1%82%D0%B2%D0%B0)', '97f29b3d', 2, 'ru.wikipedia.org\r\n', 1728000, '2024-02-18 19:05:41', NULL, NULL, '/wiki/%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%BE-%D0%BF%D0%B5%D1%80%D1%81%D0%B8%D0%B4%D1%81%D0%BA%D0%B0%D1%8F_%D0%B2%D0%BE%D0%B9%D0%BD%D0%B0_(1826%E2%80%941828)\r\n', 'QR-880ab7bf740d44e4.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `short_link`
--
ALTER TABLE `short_link`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `base_url` (`base_url`,`short_url`,`qr_code`) USING HASH;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `short_link`
--
ALTER TABLE `short_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
