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
DELETE FROM `additional_service`;
/*!40000 ALTER TABLE `additional_service` DISABLE KEYS */;
INSERT INTO `additional_service` (`id`, `title`, `description`, `logo`, `isActive`, `orderBy`) VALUES
	(1, 'Доп. услуга 1', '<p>Услуга 1</p>\r\n', 'fc98aff52aaa82882ad883cc5c07ceb6.jpg', 1, 1),
	(2, 'Доп. услуга 2', '<p>ыавы</p>\r\n', 'ddfb4d6fda6bae0b56d07eb9c63b65ac.jpg', 1, 2);
/*!40000 ALTER TABLE `additional_service` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.blocks
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `text` text,
  `isActive` tinyint(1) DEFAULT '0',
  `system` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.blocks: ~10 rows (приблизительно)
DELETE FROM `blocks`;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` (`id`, `title`, `text`, `isActive`, `system`) VALUES
	(3, 'Мини отели в шаговой доступности от метро', '<p>Ищете доступное и комфортабельное жильё в Москве? Не хотите переплачивать за пафосные гостиницы? Боитесь мошенников, которые сдают чужие квартиры? Тогда у нас есть отличная альтернатива: это мини-отель, расположенный возле метро: именно здесь можно отлично провести время, переночевать или отдохнуть с друзьями. Мы сохранили домашний комфорт и уют, обеспечив привлекательные цены на ночёвку.</p>\r\n', 1, 'welcome'),
	(4, 'Как забронировать номер?', '<p>Если Вы уже знаете дату своего прибытия в Москву, то сделайте звонок менеджеру прямо сейчас или отправьте заявку вписав ваш номер телефона ниже. Мы постараемся подобрать для Вас оптимальную альтернативу, чтобы решить любую возможную проблему клиента.</p>\r\n', 1, 'howto'),
	(5, 'Правила бронирования', '<ol>\r\n	<li>Заявка на бронирование и на размещение в отеле осуществляется круглосуточно по телефону: <a href="tel: +74995001515">+7 (499) 500-15-15</a></li>\r\n	<li>При наличии свободных номеров заявка на бронирование и на размещение в отеле &laquo;на час&raquo; или &laquo;на сутки&raquo; осуществляется не менее, чем за 30 мин до приезда</li>\r\n	<li>Бронирование аннулируется автоматически, если клиент не прибыл в согласованное с администрацией время</li>\r\n</ol>\r\n', 1, 'rules'),
	(6, 'Условия заселения в отель', '<ol>\r\n	<li>Для заселения в отель необходим одно из следующих документов:\r\n	<ul type="disc">\r\n		<li>паспорт</li>\r\n		<li>водительское удостоверение</li>\r\n		<li>военный билет для действующих офицеров</li>\r\n	</ul>\r\n	</li>\r\n	<li>Дети до 3 лет при заселении без отдельного места проживают бесплатно</li>\r\n	<li>При наличии свободных мест, заселение в отель может быть осуществлено в любое время</li>\r\n	<li>Выезд из отеля осуществляется в 12:00. При позднем выезде взымается почасовая оплата</li>\r\n	<li>Расчёт производится в рублях как наличным, так и безналичным расчетом</li>\r\n</ol>\r\n', 1, 'checkin'),
	(7, 'В любом отеле нашей сети всегда к Вашим услугам', '<ol>\r\n	<li>Бесплатный интернет WI-FI</li>\r\n	<li>Круглосуточное обслуживание</li>\r\n	<li>Круглосуточная охрана</li>\r\n	<li>Услуга &laquo;Будильник&raquo;</li>\r\n	<li>Вызов такси в любое время суток</li>\r\n	<li>Микроволновая печь</li>\r\n	<li>Электрический чайник</li>\r\n	<li>Во всех категориях номеров имеется: набор посуды (чайная пара, сахарница, бокалы, рюмки, пепельница, штопор), комплект полотенец (банные, лицевые), комплект халатов.</li>\r\n</ol>\r\n', 1, 'services'),
	(8, 'Номера и цены', '<p>В наших отелях Вы можете найти номера разных категорий — от дешёвых и уютных до просторных и комфортабельных. В стоимость проживания номеров всех категорий входит.</p>\r\n							<p>Уважаемые гости, минимальное время проживания в наших отелях — 3 часа. Вы можете оплатить номер от 3 часов и более, либо оплачивать номер посуточно. </p>\r\n							<h3>В стоимость проживания входит:</h3>\r\n							<p>\r\n								<ul>\r\n									<li>Континентальный завтрак</li>\r\n									<li>Комплект туалетных принадлежностей (шампунь, мыло, гель для душа, фен, набор для чистки зубов)</li>\r\n									<li>Одноразовые тапочки</li>\r\n								</ul>\r\n							</p>', 1, 'prices'),
	(9, 'Наши отели', '<p>&laquo;Hotel-hol&raquo; - это сеть современных миниотелей, расположенных в различных округах Москвы. Вы можете выбрать наиболее удобно расположенный отель, и в любое время суток найти в нём тёплый приём, домашний уют, высокое качество обслуживания, и всё это &ndash; по очень доступным ценам.</p>\r\n', 1, 'hotels'),
	(10, 'Что такое мини-гостиница?', '                <p>Предлагаемый формат <strong>выгодно отличается</strong> от всех известных вариантов размещения:\r\n                <ul>\r\n                    <li><span class="price">От квартиры</span> – привлекательной ценой, отсутствием залога и наличие администратора. Вам доступно значительно больше сервисов, чем при аренде обычной двушки или трёшки в столице.</li>\r\n                    <li><span class="price">От хостела</span> – великолепным качеством номеров и количеством посетителей. Здесь можно отдохнуть в тишине, не боясь оказаться в компании растаманов или профессиональных путешественников. Соответственно, требования к содержанию номеров значительно выше, и Вы это ощутите на себе.</li>\r\n                    <li><span class="price">От традиционного отеля</span> – доступной ценой и домашней атмосферой. Забудьте о высоких ценах на каждое действие: Вы сможете сэкономить приличные деньги. Кроме того, мини-отель обладает небольшим количеством номеров, поэтому здесь никогда нет суеты и нездорового оживления.</li>\r\n                </ul></p>\r\n                <p>\r\n                    Наши мини-гостиницы расположены по всей москве - вы можете выбрать наиболее удобное для Вас расположение. Администраторы будут рады помочь Вам в решении любой проблемы, с которой только может столкнуться постоялец. Приезжайте к нам в любое время дня и ночи, ведь Москва никогда не спит! Вам доступны различные сервисы сторонних компаний, начиная от вызова такси и заканчивая доставкой еды.\r\n                </p>', 1, 'whatismini'),
	(11, 'Преимущества нашего заведения', '<div class="row">\r\n<div class="col-md-4">\r\n<div class="row">\r\n<div class="col-xs-3"><i class="fa fa-clock-o fa-5x"></i></div>\r\n\r\n<div class="col-xs-9">\r\n<h3>Заселение &ndash; 24 часа в сутки</h3>\r\n</div>\r\n</div>\r\n\r\n<hr />\r\n<p>Независимо от того, когда Вы собираетесь прибыть в наш мини-отель, мы встретим Вас и проводим в номер. Администраторы всегда на месте, поэтому никто не останется ночевать на улице.</p>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="row">\r\n<div class="col-xs-3"><i class="fa fa-file-text-o fa-5x"></i></div>\r\n\r\n<div class="col-xs-9">\r\n<h3>Минимум документов для бронирования</h3>\r\n</div>\r\n</div>\r\n\r\n<hr />\r\n<p>Вам не придётся оставлять в залог свой паспорт или удостоверение личности: регистрация проходит как в обычных гостиницах.</p>\r\n</div>\r\n\r\n<div class="col-md-4">\r\n<div class="row">\r\n<div class="col-xs-3"><i class="fa fa-money fa-5x"></i></div>\r\n\r\n<div class="col-xs-9">\r\n<h3>Доступная цена номера</h3>\r\n</div>\r\n</div>\r\n\r\n<hr />\r\n<p>Стоимость значительно ниже как московских квартир, так и дорогих отелей: убедитесь в этом сами.</p>\r\n</div>\r\n</div>\r\n\r\n<div class="row">\r\n<div class="col-md-12">\r\n<hr />\r\n<p>Великолепное качество комнат. Мы гарантируем чистоту, порядок, прекрасное состояние мебели и кроватей.</p>\r\n\r\n<p>Наши мини-гостиницы расположены по всей москве - вы можете выбрать наиболее удобное для Вас расположение. Администраторы будут рады помочь Вам в решении любой проблемы, с которой только может столкнуться постоялец. Приезжайте к нам в любое время дня и ночи, ведь Москва никогда не спит! Вам доступны различные сервисы сторонних компаний, начиная от вызова такси и заканчивая доставкой еды.</p>\r\n</div>\r\n</div>\r\n', 1, 'advantages'),
	(12, 'Во всех категориях номеров имеются:', '<ul>\r\n	<li>Набор посуды: чайная пара, сахарница, бокалы, рюмки, пепельница, штопор</li>\r\n	<li>Комплект полотенец (банные, лицевые)</li>\r\n	<li>Комплект халатов</li>\r\n	<li>Континентальный завтрак</li>\r\n	<li>Комплект туалетных принадлежностей (шампунь, мыло, гель для душа, фен, набор для чистки зубов)</li>\r\n	<li>Одноразовые тапочки</li>\r\n</ul>\r\n', 1, 'roomshas');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.groups: ~2 rows (приблизительно)
DELETE FROM `groups`;
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
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `subway` varchar(200) DEFAULT NULL,
  `maps_link` varchar(500) DEFAULT NULL,
  `address_description` text,
  `orderBy` smallint(6) NOT NULL,
  `guests_count` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.hotel: ~7 rows (приблизительно)
DELETE FROM `hotel`;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
INSERT INTO `hotel` (`id`, `title`, `description`, `logo`, `phone`, `email`, `address`, `subway`, `maps_link`, `address_description`, `orderBy`, `guests_count`) VALUES
	(2, 'Авиатор', '<p>Мини-отель &laquo;Дворики&raquo; &ndash; это современная, комфортабельная и вместе с тем очень доступная мини-гостиница. Отель расположен в экологически чистом районе &laquo;Южное Бутово&raquo; южной части Москвы. В отеле имеются 8 номеров.</p>\r\n\r\n<h3>Категории номеров:</h3>\r\n\r\n<ul>\r\n	<li>Одноместный эконом</li>\r\n	<li>Одноместный стандарт</li>\r\n	<li>Двухместный эконом</li>\r\n	<li>Двухместный стандарт</li>\r\n	<li>Делюкс</li>\r\n	<li>Люкс</li>\r\n	<li>Хуюкс</li>\r\n</ul>\r\n\r\n<p>Во всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '127375c523e5c81851abff04a3964e9e.jpg', '+7 495 955-92-97', 'aviator@hotel-hol.ru', 'Москва, улица Авиаконструктора Миля, д. 26', 'Котельники', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=dyaZsESeHiuWug9Svlcr5bTzbz6P-5WJ&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: станция метро &laquo;Котельники&raquo;, выход из последнего вагона налево.</p>\r\n', 2, 0),
	(4, 'Адмирал', '<p>Мини-отель &laquo;Адмирал&raquo; &ndash; это современная, удобная и не дорогая мини-гостиница. Отель расположен в районе &laquo;Южное Бутово&raquo; на юге Москвы, возле станции метро &quot;Бунинская Аллея&quot;.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 8 номеров категорий &laquo;Эконом&raquo;, &laquo;Стандарт&raquo; и &laquo;Делюкс&raquo;.<br />\r\nВо на всей територии гостиницы бесплатно предоставляется доступ в Интернет через Wi-Fi, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'a558d4b2686c6e0f4f7cb00de2dd7a3d.jpg', '+7 495 955-91-39', 'admiral@hotel-hol.ru', 'Москва, улица Адмирала Лазарева, д. 47 корп. 1', 'Бунинская аллея', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=6McNNVz3bMPmiM-cJKuDjUoeHvjBZipj&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: станция метро &laquo;Бунинская аллея&raquo;, выход из первого вагона направо. Далее обойти слева дом 18 по улице &quot;Адмирала Руднева&quot; и пройти до конца дома 47 корп.1.</p>\r\n', 3, 0),
	(5, 'БТИ', '<p>Мини-отель &laquo;БТИ&raquo; - это комфортабельная и доступная мини-гостиница, расположенная в оживлённом районе на востоке Москвы, в 300 метрах от станции метро &laquo;Авиамоторная&raquo;.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 5 двухместных номеров &mdash; 1 категории &laquo;Эконом&raquo; и 4 категории &laquo;Стандарт&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '3050b0d1793059fd3dfe502bfc7f5818.jpg', '+7 916 288-88-11', 'bti@hotel-hol.ru', 'Москва, 1-я улица Энтузиастов, д. 12А', 'Авиамоторная', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=FaFV87VQKxkFNFZxiXlyR9mop43ts7H3&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: станция метро &laquo;Авиамоторная&raquo; (первый выход из метро налево), далее пройти под эстакадой &quot;шоссе Энтузиастов&quot;, идти вдоль железнодорожной платформы &quot;Новая&quot;. В конце платформы перейти по пешеходному мосту через железнодорожные пути, прямо до 1-й улицы Энтузиастов и направо 100 метров до дома 12А.</p>\r\n', 4, 0),
	(6, 'Дворики', '<p>Мини-отель &laquo;Дворики&raquo; &ndash; это современная, комфортабельная и вместе с тем очень доступная мини-гостиница. Отель расположен в экологически чистом районе &laquo;Южное Бутово&raquo; южной части Москвы.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 8 номеров категорий &laquo;Одноместный эконом&raquo;, &laquo;Одноместный стандарт&raquo;,&laquo;Двухместный эконом&raquo;, &laquo;Двухместный стандарт&raquo; и &laquo;Делюкс&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '8835e260af9f937bcba4863acfbe1903.jpg', '+7 916 288-88-33', 'dvoriki@hotel-hol.ru', 'Москва, улица Захарьинские дворики, д. 3', 'Бульвар Дмитрия Донского', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=itiCTJ65g59sg77_nX-AViheoj3yEBYj&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: от станции метро &laquo;Бульвар Дмитрия Донского&raquo; автобусом 858, до остановки &laquo;Захарьино&raquo; (6-я остановка).</p>\r\n', 5, 0),
	(7, 'Диана', '<p>Мини-отель &laquo;Диана&raquo; - это комфортабельная и при этом не дорогая мини-гостиница, расположенная в престижном районе Москвы не далеко от центра города, в 350 метрах от станции метро &quot;Академическая&quot;. В гостинице &quot;Диана&quot; вам всегда рады предложить комфорт, уют и заботу.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 3 двухместных номера &mdash; категорий &laquo;стандарт&raquo;, &laquo;делюкс&raquo; и &laquo;люкс&raquo;.&nbsp;<br />\r\n<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '4cb350ec18b1a38157172305da6d0b2e.jpg', '+7 925 111-11-02', 'diana@hotel-hol.ru', 'Москва, улица Гримау, д. 9 к.1', 'Академическая', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=aFgPfErSUNxyR_t-zqemfuJhDy-KEfef&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: от станции метро &laquo;Академическая&raquo; (последний вагон из центра направо) пешком через двор с фонтаном до улицы Гримау. Через улицу - дом 9 корпус 1 (третий вход с правой стороны здания).</p>\r\n', 6, 0),
	(8, 'Домодедово', '<p>Мини-отель &laquo;Домодедово&raquo; &ndash; это удобная, современная и доступная мини-гостиница. Отель расположен в тихом районе южной части Москвы, в 5 минутах пешком от метро &laquo;Домодедовская&raquo;. Из нашего отеля особенно удобно добираться до аэропорта &quot;Домодедово&quot;, что может быть полезно, если Вы пребываете в Москве проездом.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 3 двухместных номера &mdash; категорий &laquo;Эконом&raquo;, &laquo;Стандарт&raquo; и &laquo;Делюкс&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', 'd323f7bd2a69f5f1bbbb1e1c3f6179f3.jpg', '+7 (925) 421-20-55', 'domodedovo@hotel-hol.ru', 'Адрес: ул. Борисовский проезд,  д.44, к.3, под.10', 'Домодедовская', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=7bxYEyWdt_Ytpi0VSkKX1qPIx9aAwc_q&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p><em class="ab4" style="margin: 0px; color: rgb(57, 55, 58); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 13px; background-color: rgb(248, 246, 247);">проезд на общественном транспорте:</em><br style="margin: 0px; color: rgb(68, 68, 68); font-family: Tahoma; font-size: 13px; background-color: rgb(248, 246, 247);" />\r\n<span style="color: rgb(57, 55, 58); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 13px; background-color: rgb(248, 246, 247);">от станции метро &laquo;Домодедовская&raquo; (выход в сторону первого вагона из центра налево) пешком 300 метров пешком вверх по улице генерала Белова, далее по Борисовскому проезду до дома 44 корпус 3 (10 подъезд). У входа в подъезд позвонить в отдельный звонок.&nbsp;</span><br style="margin: 0px; color: rgb(68, 68, 68); font-family: Tahoma; font-size: 13px; background-color: rgb(248, 246, 247);" />\r\n<br style="margin: 0px; color: rgb(68, 68, 68); font-family: Tahoma; font-size: 13px; background-color: rgb(248, 246, 247);" />\r\n<em class="ab4" style="margin: 0px; color: rgb(57, 55, 58); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 13px; background-color: rgb(248, 246, 247);">проезд от аэропорта &laquo;Домодедово&raquo;:</em><br style="margin: 0px; color: rgb(68, 68, 68); font-family: Tahoma; font-size: 13px; background-color: rgb(248, 246, 247);" />\r\n<span style="color: rgb(57, 55, 58); font-family: Georgia, \'Times New Roman\', Times, serif; font-size: 13px; background-color: rgb(248, 246, 247);">маршрутное такси или автобус № 308 до остановки &laquo;Станция метро Домодедовская&raquo; (конечная).&nbsp;</span></p>\r\n', 7, 0),
	(9, 'Маршал', '<p>Мини-отель &laquo;Маршал&raquo; &ndash; это современная, комфортабельная и вместе с тем не дорогая гостиница. Отель расположен в Юго-Восточном округе Москвы, не далеко от метро &quot;Люблино&quot; и в непосредственной близости от торгового центра &quot;Москва&quot;.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 5 номеров категорий &laquo;Стандарт&raquo;, &laquo;Делюкс&raquo; и &laquo;Люкс&raquo;.<br />\r\nВо всех номерах работает бесплатный Wi-Fi Интернет, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью. В любое время гости могут приобрести напитки.</p>\r\n', 'd19f4aa39934b8637016b0dea898bf9c.jpg', '+7 926 581-55-15', 'marshal@hotel-hol.ru', 'Москва, улица Маршала Багромяна, д. 8', 'Люблино', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=2nVBJWtu5PnbLifQ-UpyHxVtX-y27Xul&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: станция метро &laquo;Люблино&raquo; (последний вагон из центра), автобусом №201 до остановки &quot;Улица Марьинский Парк, 39&quot; (четвёртая остановка).</p>\r\n', 8, 0),
	(10, 'Удача', '<p>Мини-отель &laquo;Удача&raquo; &ndash; это современная, удобная и не дорогая гостиница. Отель расположен в непосредственной близости от центра Москвы, рядом с белорусским вокзалом.&nbsp;<br />\r\n<br />\r\nВ отеле имеются 12 номеров категорий &laquo;Стандарт&raquo;, &laquo;Делюкс&raquo; и &laquo;Люкс&raquo;.<br />\r\nВо на всей територии гостиницы бесплатно предоставляется доступ в Интернет через Wi-Fi, обеспечивается круглосуточное обслуживание и охрана, в отеле можно воспользоваться чайником и микроволновой печью.</p>\r\n', '82584169e53e005a0c690457dab91e55.jpg', '+7 495 369-95-57', 'udacha@hotel-hol.ru', 'Москва, улица Грузинский Вал дом 26 строение 2', 'Белорусская', 'https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=7bxYEyWdt_Ytpi0VSkKX1qPIx9aAwc_q&width=100%&height=250&lang=ru_RU&sourceType=constructor', '<p>Проезд на общественном транспорте: станция метро &laquo;Белорусская&raquo; кольцевая (выход к белорусскому вокзалу), далее перейти через улицу &quot;Грузинский Вал&quot; и через 30 метров по улице &quot;2-я Бресткая&quot; повернуть направо между домами, далее через двор до гостиницы &quot;Удача&quot;.</p>\r\n', 9, 0);
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
DELETE FROM `hotel2room`;
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
  `image` varchar(100) DEFAULT '0',
  `slide_image` varchar(100) DEFAULT '0',
  `orderBy` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.promo: ~3 rows (приблизительно)
DELETE FROM `promo`;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` (`id`, `title`, `description`, `start_ts`, `stop_ts`, `isActive`, `image`, `slide_image`, `orderBy`) VALUES
	(4, 'Акция 1', '<p>Описание акции 1</p>\r\n', '2016-03-11 00:00:00', '2016-04-19 23:59:59', 1, 'b252f62bce55ce279a9c30adcddabc41.jpg', 'eb65b9e27b06d70252c855e41ceedec6.jpg', 1),
	(5, 'Акция 2', '<p>Описание акции 2</p>\r\n', '2016-03-11 00:00:00', '2016-04-19 23:59:59', 1, '3883d0cde467c6410fef66adb144618c.jpg', '369524e19f72de008057e603443af8f8.jpg', 1),
	(6, 'Акция 3', '<p>Описание акции 3</p>\r\n', '2016-03-11 00:00:00', '2016-04-19 23:59:59', 0, 'ef472b00c4129a4f0f4af06b45097223.jpg', '0', 1);
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
DELETE FROM `rates`;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id`, `title`, `description`, `isDefault`, `isActive`, `start_ts`, `stop_ts`, `type`, `orderBy`) VALUES
	(1, 'Будни', '<p>Описание тарифа будни</p>\r\n', 1, 1, NULL, NULL, 0, 1),
	(2, 'Майские праздники 1', '<p>майские праздники 1</p>\r\n', NULL, NULL, '2016-05-01 00:00:00', '2016-05-03 23:59:59', 0, 2),
	(3, 'Майские праздники 2', '<p>Майские праздники 2</p>\r\n', NULL, 0, '2016-05-07 00:00:00', '2016-05-09 23:59:59', 0, 3);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rates2room
CREATE TABLE IF NOT EXISTS `rates2room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL DEFAULT '0',
  `tid` int(11) NOT NULL DEFAULT '0',
  `cost_hour` int(11) DEFAULT '0',
  `cost_day` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__hotel` (`hid`),
  KEY `FK__rooms` (`rid`),
  KEY `FK_rates2room_rates` (`tid`),
  CONSTRAINT `FK_rates2room_rates` FOREIGN KEY (`tid`) REFERENCES `rates` (`id`),
  CONSTRAINT `rates2room_ibfk_1` FOREIGN KEY (`hid`) REFERENCES `hotel` (`id`),
  CONSTRAINT `rates2room_ibfk_2` FOREIGN KEY (`rid`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=543 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='Связь гостиниц с категориями номеров';

-- Дамп данных таблицы hotel.rates2room: ~144 rows (приблизительно)
DELETE FROM `rates2room`;
/*!40000 ALTER TABLE `rates2room` DISABLE KEYS */;
INSERT INTO `rates2room` (`id`, `hid`, `rid`, `tid`, `cost_hour`, `cost_day`) VALUES
	(351, 2, 1, 2, 888, 777),
	(352, 2, 2, 2, NULL, NULL),
	(353, 2, 3, 2, 100, NULL),
	(354, 2, 4, 2, NULL, NULL),
	(355, 2, 5, 2, 700, 3500),
	(356, 2, 6, 2, NULL, NULL),
	(357, 4, 1, 2, NULL, NULL),
	(358, 4, 2, 2, NULL, NULL),
	(359, 4, 3, 2, NULL, NULL),
	(360, 4, 4, 2, NULL, NULL),
	(361, 4, 5, 2, 700, 3000),
	(362, 4, 6, 2, NULL, NULL),
	(363, 5, 1, 2, NULL, NULL),
	(364, 5, 2, 2, NULL, NULL),
	(365, 5, 3, 2, NULL, NULL),
	(366, 5, 4, 2, NULL, NULL),
	(367, 5, 5, 2, NULL, NULL),
	(368, 5, 6, 2, NULL, NULL),
	(369, 6, 1, 2, NULL, NULL),
	(370, 6, 2, 2, NULL, NULL),
	(371, 6, 3, 2, NULL, NULL),
	(372, 6, 4, 2, NULL, NULL),
	(373, 6, 5, 2, 700, 3000),
	(374, 6, 6, 2, NULL, NULL),
	(375, 7, 1, 2, NULL, NULL),
	(376, 7, 2, 2, NULL, NULL),
	(377, 7, 3, 2, NULL, NULL),
	(378, 7, 4, 2, 600, 3000),
	(379, 7, 5, 2, 700, 3500),
	(380, 7, 6, 2, 800, 4500),
	(381, 8, 1, 2, NULL, NULL),
	(382, 8, 2, 2, NULL, NULL),
	(383, 8, 3, 2, 600, 2500),
	(384, 8, 4, 2, 620, 2800),
	(385, 8, 5, 2, 650, 3000),
	(386, 8, 6, 2, NULL, NULL),
	(387, 9, 1, 2, NULL, NULL),
	(388, 9, 2, 2, NULL, NULL),
	(389, 9, 3, 2, NULL, NULL),
	(390, 9, 4, 2, 600, 2000),
	(391, 9, 5, 2, 700, 2200),
	(392, 9, 6, 2, 750, 2400),
	(393, 10, 1, 2, NULL, NULL),
	(394, 10, 2, 2, 600, 3000),
	(395, 10, 3, 2, NULL, NULL),
	(396, 10, 4, 2, 600, 4000),
	(397, 10, 5, 2, 700, 4500),
	(398, 10, 6, 2, 750, 5500),
	(399, 2, 1, 3, NULL, 999),
	(400, 2, 2, 3, NULL, NULL),
	(401, 2, 3, 3, NULL, NULL),
	(402, 2, 4, 3, NULL, NULL),
	(403, 2, 5, 3, 700, 3500),
	(404, 2, 6, 3, NULL, NULL),
	(405, 4, 1, 3, NULL, NULL),
	(406, 4, 2, 3, NULL, NULL),
	(407, 4, 3, 3, NULL, NULL),
	(408, 4, 4, 3, NULL, NULL),
	(409, 4, 5, 3, 700, 3000),
	(410, 4, 6, 3, NULL, NULL),
	(411, 5, 1, 3, NULL, NULL),
	(412, 5, 2, 3, NULL, NULL),
	(413, 5, 3, 3, NULL, NULL),
	(414, 5, 4, 3, NULL, NULL),
	(415, 5, 5, 3, NULL, NULL),
	(416, 5, 6, 3, NULL, NULL),
	(417, 6, 1, 3, NULL, NULL),
	(418, 6, 2, 3, NULL, NULL),
	(419, 6, 3, 3, NULL, NULL),
	(420, 6, 4, 3, NULL, 111),
	(421, 6, 5, 3, 700, 3000),
	(422, 6, 6, 3, NULL, NULL),
	(423, 7, 1, 3, NULL, NULL),
	(424, 7, 2, 3, NULL, NULL),
	(425, 7, 3, 3, NULL, NULL),
	(426, 7, 4, 3, 600, 3000),
	(427, 7, 5, 3, 700, 3500),
	(428, 7, 6, 3, 800, 4500),
	(429, 8, 1, 3, NULL, NULL),
	(430, 8, 2, 3, NULL, NULL),
	(431, 8, 3, 3, 600, 2500),
	(432, 8, 4, 3, 620, 2800),
	(433, 8, 5, 3, 650, 3000),
	(434, 8, 6, 3, NULL, NULL),
	(435, 9, 1, 3, NULL, NULL),
	(436, 9, 2, 3, NULL, NULL),
	(437, 9, 3, 3, NULL, NULL),
	(438, 9, 4, 3, 600, 2000),
	(439, 9, 5, 3, 700, 2200),
	(440, 9, 6, 3, 750, 2400),
	(441, 10, 1, 3, NULL, NULL),
	(442, 10, 2, 3, 600, 3000),
	(443, 10, 3, 3, NULL, NULL),
	(444, 10, 4, 3, 600, 4000),
	(445, 10, 5, 3, 700, 4500),
	(446, 10, 6, 3, 750, 5500),
	(495, 2, 1, 1, NULL, NULL),
	(496, 2, 2, 1, NULL, NULL),
	(497, 2, 3, 1, 500, 2450),
	(498, 2, 4, 1, 600, 3000),
	(499, 2, 5, 1, 700, 3500),
	(500, 2, 6, 1, NULL, NULL),
	(501, 4, 1, 1, NULL, NULL),
	(502, 4, 2, 1, NULL, NULL),
	(503, 4, 3, 1, 500, 2000),
	(504, 4, 4, 1, 600, 2500),
	(505, 4, 5, 1, 700, 3000),
	(506, 4, 6, 1, NULL, NULL),
	(507, 5, 1, 1, NULL, NULL),
	(508, 5, 2, 1, NULL, NULL),
	(509, 5, 3, 1, 500, 2200),
	(510, 5, 4, 1, 600, 2500),
	(511, 5, 5, 1, NULL, NULL),
	(512, 5, 6, 1, NULL, NULL),
	(513, 6, 1, 1, 400, 1700),
	(514, 6, 2, 1, 400, 1900),
	(515, 6, 3, 1, 500, 2200),
	(516, 6, 4, 1, 600, 2500),
	(517, 6, 5, 1, 700, 3000),
	(518, 6, 6, 1, NULL, NULL),
	(519, 7, 1, 1, NULL, NULL),
	(520, 7, 2, 1, NULL, NULL),
	(521, 7, 3, 1, NULL, NULL),
	(522, 7, 4, 1, 600, 3000),
	(523, 7, 5, 1, 700, 3500),
	(524, 7, 6, 1, 800, 4500),
	(525, 8, 1, 1, NULL, NULL),
	(526, 8, 2, 1, NULL, NULL),
	(527, 8, 3, 1, 600, 2500),
	(528, 8, 4, 1, 620, 2800),
	(529, 8, 5, 1, 650, 3000),
	(530, 8, 6, 1, NULL, NULL),
	(531, 9, 1, 1, NULL, NULL),
	(532, 9, 2, 1, NULL, NULL),
	(533, 9, 3, 1, NULL, NULL),
	(534, 9, 4, 1, 600, 2000),
	(535, 9, 5, 1, 700, 2200),
	(536, 9, 6, 1, 750, 2400),
	(537, 10, 1, 1, NULL, NULL),
	(538, 10, 2, 1, 600, 3000),
	(539, 10, 3, 1, NULL, NULL),
	(540, 10, 4, 1, 600, 4000),
	(541, 10, 5, 1, 700, 4500),
	(542, 10, 6, 1, 750, 5500);
/*!40000 ALTER TABLE `rates2room` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rates_details
CREATE TABLE IF NOT EXISTS `rates_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rates_tables_id` int(11) NOT NULL DEFAULT '0',
  `room_id` int(11) NOT NULL DEFAULT '0',
  `guest_count` int(11) NOT NULL DEFAULT '0',
  `cost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Цены для таблиц';

-- Дамп данных таблицы hotel.rates_details: ~0 rows (приблизительно)
DELETE FROM `rates_details`;
/*!40000 ALTER TABLE `rates_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates_details` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rates_tables
CREATE TABLE IF NOT EXISTS `rates_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rates_id` int(11) NOT NULL DEFAULT '0',
  `hotel_id` int(11) NOT NULL DEFAULT '0',
  `start_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stop_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Тарифные таблицы';

-- Дамп данных таблицы hotel.rates_tables: ~0 rows (приблизительно)
DELETE FROM `rates_tables`;
/*!40000 ALTER TABLE `rates_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `rates_tables` ENABLE KEYS */;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Дамп данных таблицы hotel.review: ~1 rows (приблизительно)
DELETE FROM `review`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.role: ~2 rows (приблизительно)
DELETE FROM `role`;
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

-- Дамп данных таблицы hotel.role2group: ~3 rows (приблизительно)
DELETE FROM `role2group`;
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
  `seats_count` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '0',
  `orderBy` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.rooms: ~6 rows (приблизительно)
DELETE FROM `rooms`;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `title`, `description`, `seats_count`, `image`, `isActive`, `orderBy`) VALUES
	(1, 'Одноместный стандарт', '<p>Одноместный стандарт</p>\r\n', 1, '2b685f3c02b19de4c604e24825913dcd.jpg', 1, 1),
	(2, 'Одноместный эконом', '<p>Одноместный эконом</p>\r\n', 0, 'acf06b9a1a1b31b34f373ff731eb4fa3.jpg', 1, 2),
	(3, 'Двухместный эконом', '<p>Двухместный эконом</p>\r\n', 0, '85b2a081b53e8bf0ff46ac4441164c2a.jpg', 1, 3),
	(4, 'Двухместный стандарт', '<p>Двухместный стандарт</p>\r\n', 0, '73d2f99eb7715a270c65b4a94c28cbdb.jpg', 1, 4),
	(5, 'Делюкс', '<h3>Делюкс</h3>\r\n', 0, '539dd547694cef9ecf38f087fa8ea070.jpg', 1, 5),
	(6, 'Люкс', '<h3>Люкс</h3>\r\n', 0, '39662f7dbab7b93b919e1677f25fb8f7.jpg', 1, 6);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.rooms2hotels
CREATE TABLE IF NOT EXISTS `rooms2hotels` (
  `hid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.rooms2hotels: ~2 rows (приблизительно)
DELETE FROM `rooms2hotels`;
/*!40000 ALTER TABLE `rooms2hotels` DISABLE KEYS */;
INSERT INTO `rooms2hotels` (`hid`, `rid`, `description`) VALUES
	(2, 4, '<p><span style="line-height: 20.8px;">Уютный и доступный по цене номер площадью 14 кв.м. В номере: кровать, тумбочка, телевизор с плоским экраном, вешалка для верхней одежды. Санузел с душевой кабиной в номере. Туалет - общий на 2 номера.</span></p>\r\n'),
	(2, 3, '<p>Удобный двухместный номер площадью 15 кв.м. В номере: кровать, тумбочка, телевизор с плоским экраном, столик, вешалка для верхней одежды. Санузел с туалетом и душевой кабиной в номере.</p>\r\n');
/*!40000 ALTER TABLE `rooms2hotels` ENABLE KEYS */;


-- Дамп структуры для таблица hotel.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '0',
  `value` varchar(500) NOT NULL DEFAULT '0',
  `sysname` varchar(70) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы hotel.settings: ~6 rows (приблизительно)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `title`, `value`, `sysname`) VALUES
	(1, 'Основной номер телефона', '+7 (499) 500-15-15', 'phone_base'),
	(2, 'E-mail', 'info@hotel-hol.ru', 'email'),
	(3, 'Группа Вконтакте', 'http://vk.com', 'vk_link'),
	(4, 'Канал на Youtube', 'http://youtube.com', 'youtube_link'),
	(5, 'Аккаунт в Facebook', 'http://facebook.com', 'fb_link'),
	(6, 'Яндекс карта', '<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Ht_Pb8pi5oUQOwoEgmPKm-gmCA3C12gb&width=100%&height=530&lang=ru_RU&sourceType=constructor"></script>', 'ya_map');
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
DELETE FROM `user2group`;
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
DELETE FROM `users`;
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

-- Дамп данных таблицы hotel.Users: ~2 rows (приблизительно)
DELETE FROM `Users`;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` (`ID`, `Username`, `Password`, `Email`, `Activated`, `Confirmation`, `RegDate`, `LastLogin`, `GroupID`) VALUES
	(1, 'Pembrock', '827ccb0eea8a706c4c34a16891f84e7b', 'pembrock@gmail.com', 1, '1', 0, 0, 1),
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
