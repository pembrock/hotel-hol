CREATE TABLE `hotel2room` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`hid` INT(11) NOT NULL DEFAULT '0',
	`rid` INT(11) NOT NULL DEFAULT '0',
	`description` TEXT NOT NULL,
	`cost_hour` INT(11) NOT NULL,
	`cost_day` INT(11) NOT NULL,
	`isActive` INT(11) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `FK__hotel` (`hid`),
	INDEX `FK__rooms` (`rid`),
	CONSTRAINT `FK__hotel` FOREIGN KEY (`hid`) REFERENCES `hotel` (`id`),
	CONSTRAINT `FK__rooms` FOREIGN KEY (`rid`) REFERENCES `rooms` (`id`)
)
COMMENT='Связь гостиниц с категориями номеров'
ENGINE=InnoDB
;
