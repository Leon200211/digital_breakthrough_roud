-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Сен 09 2023 г., 19:23
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `digital-breakthrough-roud`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dates`
--

CREATE TABLE `dates` (
  `id` int NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dates`
--

INSERT INTO `dates` (`id`, `date`) VALUES
(1, '2023-09-09 12:53:20'),
(2, '2023-09-08 12:53:20'),
(9, '2023-09-09 17:12:23');

-- --------------------------------------------------------

--
-- Структура таблицы `defects`
--

CREATE TABLE `defects` (
  `id` int NOT NULL,
  `type` varchar(255) NOT NULL,
  `marker_coords_x` varchar(255) NOT NULL,
  `marker_coords_y` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `date_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `defects`
--

INSERT INTO `defects` (`id`, `type`, `marker_coords_x`, `marker_coords_y`, `note`, `date_id`) VALUES
(1, 'type_1', '55.88199', '37.42896', 'test', 1),
(2, 'type_2', '55.90512', '37.46367', 'tas]dasdas;dasd', 1),
(3, 'type_1', '55.92199', '37.50367', '123', 2),
(4, 'type_1', '55.94199', '37.48367', 'dfs', 2),
(9, 'type_1', '55.88199', '37.42896', 'Выбоина', 9),
(10, 'type_2', '55.90199', '37.42896', 'Аллигаторная трещина', 9),
(11, 'type_3', '55.86199', '37.42896', 'Поперечная трещина', 9),
(12, 'type_4', '55.84199', '37.42896', 'Продольная трещина', 9);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `defects`
--
ALTER TABLE `defects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dates`
--
ALTER TABLE `dates`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `defects`
--
ALTER TABLE `defects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
