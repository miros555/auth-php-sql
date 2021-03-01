-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 01 2021 г., 15:25
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `miro_products`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `parent_id`) VALUES
(1, 'Одежда', NULL, NULL),
(2, 'Верхняя одежда', NULL, 1),
(3, 'Рубашки', NULL, 2),
(4, 'Белые рубашки', NULL, 3),
(5, 'Цветные рубашки', NULL, 3),
(6, 'Спортивная одежда', NULL, 1),
(7, 'Спортивные футболки', NULL, 6),
(8, 'Праздничные белые рубашки', NULL, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `category_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`) VALUES
(1, 'Белая рубашка W1', 'description', 4, 250),
(2, 'Бордовая рубашка B4', 'description', 5, 420),
(3, 'Спортивная футболка S1', 'description', 7, 180),
(4, 'Свадебная белая рубашка', 'description', 8, 1050),
(5, 'Сиреневая рубашка', 'description', 5, 355),
(6, 'Спортивное трико', 'description', 6, 1850),
(7, 'Пиджак бизнес-класса', 'description', 2, 4500),
(8, 'Синяя рубашка B3', 'description', 5, 250),
(9, 'Спортивные штаны', 'description', 6, 1500);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
