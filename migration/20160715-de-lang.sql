ALTER TABLE `additional_service`
	ADD COLUMN `title_de` VARCHAR(50) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`;

ALTER TABLE `attraction`
	ADD COLUMN `title_de` VARCHAR(300) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `text_de` TEXT NULL AFTER `text_tr`;

ALTER TABLE `blocks`
	ADD COLUMN `title_de` VARCHAR(50) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `text_de` TEXT NULL AFTER `text_tr`;

ALTER TABLE `hotel`
	ADD COLUMN `title_de` VARCHAR(50) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`,
	ADD COLUMN `address_de` VARCHAR(200) NULL DEFAULT NULL AFTER `address_tr`,
	ADD COLUMN `subway_de` VARCHAR(200) NULL DEFAULT NULL AFTER `subway_tr`,
	ADD COLUMN `address_description_de` TEXT NULL AFTER `address_description_tr`,
	ADD COLUMN `meta_desc_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_tr`,
	ADD COLUMN `meta_key_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_tr`;

ALTER TABLE `information`
	ADD COLUMN `title_de` VARCHAR(500) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`,
	ADD COLUMN `text_de` TEXT NULL AFTER `text_tr`,
	ADD COLUMN `meta_desc_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_tr`,
	ADD COLUMN `meta_key_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_tr`;

INSERT INTO `hh`.`language` (`name`, `code`) VALUES ('Germany', 'de');

ALTER TABLE `menu`
	ADD COLUMN `title_de` VARCHAR(150) NULL DEFAULT '0' AFTER `title_tr`;

ALTER TABLE `promo`
	ADD COLUMN `title_de` VARCHAR(255) NULL DEFAULT '0' AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`,
	ADD COLUMN `text_de` TEXT NULL AFTER `text_tr`,
	ADD COLUMN `meta_desc_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_tr`,
	ADD COLUMN `meta_key_de` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_tr`;

ALTER TABLE `rates`
	ADD COLUMN `title_de` VARCHAR(50) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`;

ALTER TABLE `rooms`
	ADD COLUMN `title_de` VARCHAR(50) NULL DEFAULT NULL AFTER `title_tr`,
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`;

ALTER TABLE `rooms2hotels`
	ADD COLUMN `description_de` TEXT NULL AFTER `description_tr`;

ALTER TABLE `titles`
	ADD COLUMN `de` VARCHAR(500) NULL DEFAULT '0' AFTER `tr`;

