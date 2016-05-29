-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.44-0ubuntu0.14.04.1 - (Ubuntu)
-- ОС Сервера:                   debian-linux-gnu
-- HeidiSQL Версия:              9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

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

-- Дамп данных таблицы hotel.additional_service: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `additional_service` DISABLE KEYS */;
INSERT INTO `additional_service` (`id`, `title`, `description`, `logo`, `isActive`, `orderBy`) VALUES
	(1, 'Доп. услуга 1', '<p>Услуга 1</p>\r\n', 'fc98aff52aaa82882ad883cc5c07ceb6.jpg', 1, 1),
	(2, 'Доп. услуга 2', '<p>ыавы</p>\r\n', 'ddfb4d6fda6bae0b56d07eb9c63b65ac.jpg', 1, 2);
/*!40000 ALTER TABLE `additional_service` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.groups: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `isActive`) VALUES
	(1, 'Администратор', 1),
	(6, 'Редактор', 1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.hotel
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `logo` varchar(100) DEFAULT NULL,
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.hotel: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `title`, `description`, `logo`, `orderBy`) VALUES
	(2, 'Адмирал', '<p>Мини-отель &laquo;Адмирал&raquo; &ndash; это современная, удобная и не дорогая мини-гостиница. Отель расположен в районе &laquo;Южное Бутово&raquo; на юге Москвы, возле станции метро &quot;Бунинская Аллея&quot;. В отеле имеются 8 номеров категорий &laquo;Эконом&raquo;, &laquo;Стандарт&raquo;, &laquo;Делюкс&raquo; и &laquo;Люкс&raquo;. Во на всей територии гостиницы бесплатно предоставляется доступ в Интернет через Wi-Fi, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'e74b13b58063521ffeec2f1806d6dfce.png', 2),
	(4, 'БТИ', '<p>Мини-отель &laquo;БТИ&raquo; - это комфортабельная и доступная мини-гостиница, расположенная в оживлённом районе на востоке Москвы, в 300 метрах от станции метро &laquo;Авиамоторная&raquo;.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 5 двухместных номеров &mdash; 1 категории &laquo;Эконом&raquo; и 4 категории &laquo;Стандарт&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'c853203053011160a4f28421c7c0bba9.gif', 3),
	(5, 'Дворики', '<p>Мини-отель &laquo;Дворики&raquo; &ndash; это современная, комфортабельная и вместе с тем очень доступная мини-гостиница. Отель расположен в экологически чистом районе &laquo;Южное Бутово&raquo; южной части Москвы.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 8 номеров категорий &laquo;Одноместный эконом&raquo;, &laquo;Одноместный стандарт&raquo;,&laquo;Двухместный эконом&raquo;, &laquo;Двухместный стандарт&raquo; и &laquo;Делюкс&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'e0b473de5f205f7b32e065cacc387b6b.jpg', 4),
	(6, 'Диана', '<p>Мини-отель &laquo;Диана&raquo; - это комфортабельная и при этом не дорогая мини-гостиница, расположенная в престижном районе Москвы не далеко от центра города, в 350 метрах от станции метро &quot;Академическая&quot;. В гостинице &quot;Диана&quot; вам всегда рады предложить комфорт, уют и заботу.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 3 двухместных номера &mdash; категорий &laquo;стандарт&raquo;, &laquo;делюкс&raquo; и &laquo;люкс&raquo;.&nbsp;<br />\r\n<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '57d5a635c51213cc10922c7ccf2016fc.jpg', 5);
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.hotel2room
CREATE TABLE IF NOT EXISTS `hotel2room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `cost_hour` int(11) NOT NULL,
  `cost_day` int(11) NOT NULL,
  `isActive` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__hotel` (`hid`),
  KEY `FK__rooms` (`rid`),
  CONSTRAINT `FK__hotel` FOREIGN KEY (`hid`) REFERENCES `hotel` (`id`),
  CONSTRAINT `FK__rooms` FOREIGN KEY (`rid`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Связь гостиниц с категориями номеров';

-- Дамп данных таблицы hotel.hotel2room: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `hotel2room` DISABLE KEYS */;
INSERT INTO `hotel2room` (`id`, `hid`, `rid`, `description`, `cost_hour`, `cost_day`, `isActive`) VALUES
	(1, 2, 2, '<p>Бла бла бла описание</p>\r\n', 400, 2500, 1),
	(2, 2, 3, '<p>2</p>\r\n', 1, 3, 0),
	(4, 4, 2, '<p>фаыв</p>\r\n', 500, 1100, 1),
	(5, 5, 2, '<p>123</p>\r\n', 123, 1111, 1),
	(6, 6, 4, '<p>qq</p>\r\n', 1500, 5000, 0),
	(7, 2, 1, '', 0, 0, 0),
	(11, 2, 4, '<p>Люкс</p>\r\n', 1500, 5000, 0);
/*!40000 ALTER TABLE `hotel2room` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.promo
CREATE TABLE IF NOT EXISTS `promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `start_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stop_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.promo: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` (`id`, `title`, `description`, `start_ts`, `stop_ts`, `isActive`, `orderBy`) VALUES
	(1, 'Промо акция', '<p>Описание спец. предложения</p>\r\n', '2016-03-11 00:00:00', '2016-03-19 23:59:59', 1, 1);
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rates
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `isDefault` tinyint(1) DEFAULT '0',
  `isActive` tinyint(1) DEFAULT '0',
  `start_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stop_ts` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - проживание; 1 - доп. услуги',
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы hotel.rates: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id`, `title`, `description`, `isDefault`, `isActive`, `start_ts`, `stop_ts`, `type`, `orderBy`) VALUES
	(1, 'Будни', '<p>Описание тарифа будни</p>\r\n', 1, 1, NULL, NULL, 0, 1),
	(2, 'Майские праздники 1', '<p>майские праздники 1</p>\r\n', NULL, 1, '2016-05-01 00:00:00', '2016-05-03 23:59:59', 0, 2),
	(3, 'Майские праздники 2', '<p>Майские праздники 2</p>\r\n', NULL, 1, '2016-05-07 00:00:00', '2016-05-09 23:59:59', 0, 3);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rates2room
CREATE TABLE IF NOT EXISTS `rates2room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `seats_count` int(11) DEFAULT '0',
  `cost_hour` int(11) DEFAULT '0',
  `cost_day` int(11) DEFAULT '0',
  `isActive` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__hotel` (`hid`),
  KEY `FK__rooms` (`rid`),
  KEY `FK_rates2room_rates` (`tid`),
  CONSTRAINT `FK_rates2room_rates` FOREIGN KEY (`tid`) REFERENCES `rates` (`id`),
  CONSTRAINT `rates2room_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hotel` (`id`),
  CONSTRAINT `rates2room_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Связь гостиниц с категориями номеров';

-- Дамп данных таблицы hotel.rates2room: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `rates2room` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates2room` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы hotel.review: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` (`id`, `hid`, `text`, `name`, `email`, `date`, `isActive`, `orderBy`) VALUES
	(1, 2, '<p>Не конфликтный, не искал придирок. В общем отдых удался<br>\r\nЗаселили быстро, в СТАНДАРТ (а не в СПА), начитался и решили не экономить.<br>\r\n<br>\r\nС интернетом беда, 5 евро в сутки. Бесплатного нет. Или переходите уличу в водафон и покупаете симку.<br>\r\nС едой тоже нет проблем, что бы не писали.<br>\r\nТерритория чистая, нормальная, БОЛЬШАЯ. До моря прилично идти из главного корпуса.<br>\r\n<br>\r\nСразу к недостаткам:<br>\r\n- номера ужасно "ушатаны", смотрите фото<br>\r\n- нет нормальных розеток, даже что бы подзарядить телефон, см фото<br>\r\n- мини бар: это 2 бутылки простой воды по 0.6. Смешно.....<br>\r\n- нет розеток в ванной для эл.бритвы и фена для женщин (чем думали, не понятно. Первый раз такое вижу)<br>\r\n- внешне корпуса уставшие<br>\r\n- номера которые идут с выходом в бассейн, грязные от листьев и обшарпанные. см фото, в принципе как и основной бассейн.<br>\r\n<br>\r\nА так в целом ничего особенного. Вывод один: смотрите другой отель.<br>\r\nВ прошлом году был в соседнем Ориентале, там на порядок лучше со всем.<br>\r\n<br>\r\nЗаметка для дайверов: <br>\r\nна территории отеля есть дайв центр. если хотите нормального русскоговорящего инструктора, спрашивайте Мохамеда (Он темненький). Есть Хенни, этот только работает что бы бабло срубить.<br>\r\nИ ни при каких условиях не соглашайтесь на дайвинг возле отеля на катамаране. Только на моторной лодке!!!!! Ибо будете 2 часа сами крутить пидали.<br>\r\nРекомендую погрузиться не далеко от отеля есть затонувший корабль. Очень понравилось<br>\r\n<br>\r\n<br>\r\n<br>\r\nВывод: отель того не стоит, что за него просят. Как бы вам это не предносили тур операторы....</p>', 'Вася иванов', 'memail@mail.ru', '2016-03-04 22:31:20', 0, 1);
/*!40000 ALTER TABLE `review` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `descr` text,
  `is_enabled` tinyint(1) DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `sys` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.role: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `descr`, `is_enabled`, `is_deleted`, `sys`) VALUES
	(1, 'Гостиницы::Просмотр', '', 1, NULL, 'hotels'),
	(2, 'Категории номеров::Просмотр', '<p>Просмотр списка категорий номеров</p>\r\n', 1, 0, 'rooms_show');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.role2group
CREATE TABLE IF NOT EXISTS `role2group` (
  `gid` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  KEY `FK_role2group_groups` (`gid`),
  KEY `FK_role2group_role` (`rid`),
  CONSTRAINT `FK_role2group_groups` FOREIGN KEY (`gid`) REFERENCES `groups` (`id`),
  CONSTRAINT `FK_role2group_role` FOREIGN KEY (`rid`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.role2group: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `role2group` DISABLE KEYS */;
INSERT INTO `role2group` (`gid`, `rid`) VALUES
	(1, 1),
	(1, 2),
	(6, 1);
/*!40000 ALTER TABLE `role2group` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  `isActive` tinyint(1) DEFAULT '0',
  `orderBy` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.rooms: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `title`, `description`, `isActive`, `orderBy`) VALUES
	(1, '1 местный', '<p>категория</p>\r\n', 1, 1),
	(2, '2 местный', '<p>Категория 2</p>\r\n', 1, 2),
	(3, 'Премиум', '<p>123</p>\r\n', 1, 3),
	(4, 'Люкс', '<p>44</p>\r\n', 1, 4);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '0',
  `sysname` varchar(70) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.settings: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `title`, `value`, `sysname`) VALUES
	(1, 'Основной номер телефона', '8 (499) 500-15-15', 'phone_base'),
	(2, 'E-mail', 'info@hotel-hol.ru', 'email'),
	(3, 'Группа Вконтакте', 'http://vk.com', 'vk_link');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.user2group
CREATE TABLE IF NOT EXISTS `user2group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(7) unsigned NOT NULL,
  `gid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_user2group_Users` (`uid`),
  KEY `FK_user2group_groups` (`gid`),
  CONSTRAINT `FK_user2group_groups` FOREIGN KEY (`gid`) REFERENCES `groups` (`id`),
  CONSTRAINT `FK_user2group_Users` FOREIGN KEY (`uid`) REFERENCES `Users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.user2group: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user2group` DISABLE KEYS */;
/*!40000 ALTER TABLE `user2group` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.users: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
	(1, 'test@mail.ru', 'test1', 'TestName'),
	(2, 'newlogin', '8cb2237d0679ca88db6464eac60da96345513964', 'newName'),
	(3, 'pembrock@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Pembrock');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.Users: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` (`ID`, `Username`, `Password`, `Email`, `Activated`, `Confirmation`, `RegDate`, `LastLogin`, `GroupID`) VALUES
	(1, 'Pembrock', '827ccb0eea8a706c4c34a16891f84e7b', 'pembrock@gmail.com', 1, '1', 0, 0, 1),
	(2, 'Pembrock', '827ccb0eea8a706c4c34a16891f84e7b', 'shitanger@mail.ru', 1, '', 0, 0, 1),
	(5, 'Editor', '', 'pembrock1@gmail.com', 1, '', 0, 0, 6);
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
