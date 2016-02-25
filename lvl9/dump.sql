-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 24 2016 г., 20:20
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ads id',
  `forma` int(11) NOT NULL DEFAULT '0' COMMENT 'forma type',
  `seller_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email',
  `newsletter` int(11) NOT NULL DEFAULT '0' COMMENT 'sunscribe',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location_id` int(11) NOT NULL COMMENT 'city',
  `category_id` int(11) NOT NULL COMMENT 'category',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ads title',
  `description` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'text of ads',
  `price` int(11) NOT NULL COMMENT 'prece of ads',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Объявления' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  UNIQUE KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='categories for filling form' AUTO_INCREMENT=64 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `parent`) VALUES
(1, 'Транспорт', NULL),
(2, 'Недвижимость', NULL),
(3, 'Работа', NULL),
(4, 'Услуги', NULL),
(5, 'Личные вещи', NULL),
(6, 'Для дома и дачи', NULL),
(7, 'Бытовая электроника', NULL),
(8, 'Хобби и отдых', NULL),
(9, 'Животные', NULL),
(10, 'Для бизнеса', NULL),
(11, 'Автомобили с пробегом', 1),
(12, 'Новые автомобили', 1),
(13, 'Мотоциклы и мототехника', 1),
(14, 'Грузовики и спецтехника', 1),
(15, 'Водный транспорт', 1),
(16, 'Запчасти и аксессуары', 1),
(17, 'Квартиры', 2),
(18, 'Комнаты', 2),
(19, 'Дома, дачи, коттеджи', 2),
(20, 'Земельные участки', 2),
(21, 'Гаражи и машиноместа', 2),
(22, 'Коммерческая недвижимость', 2),
(23, 'Недвижимость за рубежом', 2),
(24, 'Вакансии (поиск сотрудников)', 3),
(25, 'Резюме (поиск работы)', 3),
(26, 'Предложения услуг', 4),
(27, 'Запросы на услуги', 4),
(28, 'Одежда, обувь, аксессуары', 5),
(29, 'Детская одежда и обувь', 5),
(30, 'Товары для детей и игрушки', 5),
(31, 'Часы и украшения', 5),
(32, 'Красота и здоровье', 5),
(33, 'Бытовая техника', 6),
(34, 'Мебель и интерьер', 6),
(35, 'Посуда и товары для кухн', 6),
(36, 'Продукты питания', 6),
(37, 'Ремонт и строительство', 6),
(38, 'Растения', 6),
(39, 'Аудио и видео', 7),
(40, 'Игры, приставки и программы', 7),
(41, 'Настольные компьютеры', 7),
(42, 'Ноутбуки', 7),
(43, 'Оргтехника и расходники', 7),
(44, 'Планшеты и электронные книги', 7),
(45, 'Телефоны', 7),
(46, 'Товары для компьютера', 7),
(47, 'Фототехника', 7),
(48, 'Билеты и путешествия', 8),
(49, 'Велосипеды', 8),
(50, 'Книги и журналы', 8),
(51, 'Коллекционирование', 8),
(52, 'Музыкальные инструменты', 8),
(53, 'Охота и рыбалка', 8),
(54, 'Спорт и отдых', 8),
(55, 'Знакомства', 8),
(56, 'Собаки', 9),
(57, 'Кошки', 9),
(58, 'Птицы', 9),
(59, 'Аквариум', 9),
(60, 'Другие животные', 9),
(61, 'Товары для животных', 9),
(62, 'Готовый бизнес', 10),
(63, 'Оборудование для бизнеса', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL COMMENT 'code of cities',
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'city name',
  UNIQUE KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='table for filling form';

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`city_id`, `city`) VALUES
(641490, 'Барабинск'),
(641510, 'Бердск'),
(641600, 'Искитим'),
(641630, 'Колывань'),
(641680, 'Краснообск'),
(641710, 'Куйбышев'),
(641760, 'Мошково'),
(641780, 'Новосибирск'),
(641790, 'Обь'),
(641800, 'Ордынское'),
(641970, 'Черепаново');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
