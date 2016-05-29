-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.47-0ubuntu0.14.04.1 - (Ubuntu)
-- ОС Сервера:                   debian-linux-gnu
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных hotel
CREATE DATABASE IF NOT EXISTS `hotel` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hotel`;


-- Дамп структуры для таблица hotel.additional_service
CREATE TABLE IF NOT EXISTS `additional_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  `logo` varchar(100) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `orderBy` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.additional_service: ~1 rows (приблизительно)
DELETE FROM `additional_service`;
/*!40000 ALTER TABLE `additional_service` DISABLE KEYS */;
INSERT INTO `additional_service` (`id`, `title`, `description`, `logo`, `isActive`, `orderBy`) VALUES
	(1, 'Доп. услуга 1', '<p>Услуга 1</p>\r\n', 'fc98aff52aaa82882ad883cc5c07ceb6.jpg', 1, 1),
	(2, 'Доп. услуга 2', '<p>ыавы</p>\r\n', 'ddfb4d6fda6bae0b56d07eb9c63b65ac.jpg', 1, 2);
/*!40000 ALTER TABLE `additional_service` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.hotel
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `logo` varchar(100) DEFAULT NULL,
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.hotel: ~5 rows (приблизительно)
DELETE FROM `hotel`;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `title`, `description`, `logo`, `orderBy`) VALUES
	(1, 'Категория 11', '<p>категория 123</p>\r\n', 'dde38786b3536adb1e3b2e8ea77440a4.png', 1),
	(2, 'Адмирал', '<p>Мини-отель &laquo;Адмирал&raquo; &ndash; это современная, удобная и не дорогая мини-гостиница. Отель расположен в районе &laquo;Южное Бутово&raquo; на юге Москвы, возле станции метро &quot;Бунинская Аллея&quot;. В отеле имеются 8 номеров категорий &laquo;Эконом&raquo;, &laquo;Стандарт&raquo;, &laquo;Делюкс&raquo; и &laquo;Люкс&raquo;. Во на всей територии гостиницы бесплатно предоставляется доступ в Интернет через Wi-Fi, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'e74b13b58063521ffeec2f1806d6dfce.png', 2),
	(4, 'БТИ', '<p>Мини-отель &laquo;БТИ&raquo; - это комфортабельная и доступная мини-гостиница, расположенная в оживлённом районе на востоке Москвы, в 300 метрах от станции метро &laquo;Авиамоторная&raquo;.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 5 двухместных номеров &mdash; 1 категории &laquo;Эконом&raquo; и 4 категории &laquo;Стандарт&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'c853203053011160a4f28421c7c0bba9.gif', 3),
	(5, 'Дворики', '<p>Мини-отель &laquo;Дворики&raquo; &ndash; это современная, комфортабельная и вместе с тем очень доступная мини-гостиница. Отель расположен в экологически чистом районе &laquo;Южное Бутово&raquo; южной части Москвы.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 8 номеров категорий &laquo;Одноместный эконом&raquo;, &laquo;Одноместный стандарт&raquo;,&laquo;Двухместный эконом&raquo;, &laquo;Двухместный стандарт&raquo; и &laquo;Делюкс&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'e0b473de5f205f7b32e065cacc387b6b.jpg', 4),
	(6, 'Диана', '<p>Мини-отель &laquo;Диана&raquo; - это комфортабельная и при этом не дорогая мини-гостиница, расположенная в престижном районе Москвы не далеко от центра города, в 350 метрах от станции метро &quot;Академическая&quot;. В гостинице &quot;Диана&quot; вам всегда рады предложить комфорт, уют и заботу.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 3 двухместных номера &mdash; категорий &laquo;стандарт&raquo;, &laquo;делюкс&raquo; и &laquo;люкс&raquo;.&nbsp;<br />\r\n<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '57d5a635c51213cc10922c7ccf2016fc.jpg', 5),
	(14, '123', '<p>123</p>\r\n', NULL, 6);
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.promo
CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `start_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stop_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.promo: ~0 rows (приблизительно)
DELETE FROM `promo`;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  `seats_count` int(11) DEFAULT '0',
  `isActive` tinyint(1) DEFAULT '0',
  `orderBy` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.rooms: ~2 rows (приблизительно)
DELETE FROM `rooms`;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `title`, `description`, `seats_count`, `isActive`, `orderBy`) VALUES
	(1, 'Категория 1', '<p>категория</p>\r\n', 2, 1, 1),
	(2, 'Категория 2', '<p>Категория 2</p>\r\n', 3, 1, 2),
	(3, 'Категория 3', '<p>123</p>\r\n', 5, 1, 3),
	(4, 'Категория 4', '<p>44</p>\r\n', 0, NULL, 4);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.Users
CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(7) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Activated` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Confirmation` char(40) NOT NULL DEFAULT '',
  `RegDate` int(11) unsigned NOT NULL,
  `LastLogin` int(11) unsigned NOT NULL DEFAULT '0',
  `GroupID` int(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.Users: ~1 rows (приблизительно)
DELETE FROM `Users`;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` (`ID`, `Username`, `Password`, `Email`, `Activated`, `Confirmation`, `RegDate`, `LastLogin`, `GroupID`) VALUES
	(1, 'Pembrock', '12345', 'pembrock@gmail.com', 1, '1', 0, 0, 1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.users_old
CREATE TABLE IF NOT EXISTS `users_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.users_old: ~4 rows (приблизительно)
DELETE FROM `users_old`;
/*!40000 ALTER TABLE `users_old` DISABLE KEYS */;
INSERT INTO `users_old` (`id`, `email`, `password`, `name`) VALUES
	(1, 'test@mail.ru', 'test', 'Pembrock'),
	(2, 'pembrock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Pembrock'),
	(3, 'pembrock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Pembrock'),
	(4, 'pembrock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Pembrock');
/*!40000 ALTER TABLE `users_old` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
