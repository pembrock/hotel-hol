ALTER TABLE `hotel`
	ADD COLUMN `title_fr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(50) NULL DEFAULT NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(50) NULL DEFAULT NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_vn`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`,
	ADD COLUMN `address_fr` VARCHAR(200) NULL DEFAULT NULL AFTER `address_cn`,
	ADD COLUMN `address_es` VARCHAR(200) NULL DEFAULT NULL AFTER `address_fr`,
	ADD COLUMN `address_vn` VARCHAR(200) NULL DEFAULT NULL AFTER `address_es`,
	ADD COLUMN `address_tr` VARCHAR(200) NULL DEFAULT NULL AFTER `address_vn`,
	ADD COLUMN `subway_fr` VARCHAR(200) NULL DEFAULT NULL AFTER `subway_cn`,
	ADD COLUMN `subway_es` VARCHAR(200) NULL DEFAULT NULL AFTER `subway_fr`,
	ADD COLUMN `subway_vn` VARCHAR(200) NULL DEFAULT NULL AFTER `subway_es`,
	ADD COLUMN `subway_tr` VARCHAR(200) NULL DEFAULT NULL AFTER `subway_vn`,
	ADD COLUMN `address_description_fr` TEXT NULL AFTER `address_description_cn`,
	ADD COLUMN `address_description_es` TEXT NULL AFTER `address_description_fr`,
	ADD COLUMN `address_description_vn` TEXT NULL AFTER `address_description_es`,
	ADD COLUMN `address_description_tr` TEXT NULL AFTER `address_description_vn`,
	ADD COLUMN `meta_desc_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_desc_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_fr`,
	ADD COLUMN `meta_desc_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_es`,
	ADD COLUMN `meta_desc_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_vn`,
	ADD COLUMN `meta_key_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_cn`,
	ADD COLUMN `meta_key_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_fr`,
	ADD COLUMN `meta_key_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_es`,
	ADD COLUMN `meta_key_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_vn`;

	ALTER TABLE `rooms`
	CHANGE COLUMN `title_us` `title_us` VARCHAR(50) NULL AFTER `title_ru`,
	CHANGE COLUMN `title_cn` `title_cn` VARCHAR(50) NULL AFTER `title_us`,
	ADD COLUMN `title_fr` VARCHAR(50) NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(50) NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(50) NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(50) NULL AFTER `title_vn`,
	CHANGE COLUMN `description_ru` `description_ru` TEXT NOT NULL AFTER `title_tr`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`;

ALTER TABLE `additional_service`
	CHANGE COLUMN `title_us` `title_us` VARCHAR(50) NULL AFTER `title_ru`,
	CHANGE COLUMN `title_cn` `title_cn` VARCHAR(50) NULL AFTER `title_us`,
	ADD COLUMN `title_fr` VARCHAR(50) NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(50) NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(50) NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(50) NULL AFTER `title_vn`,
	CHANGE COLUMN `description_ru` `description_ru` TEXT NOT NULL AFTER `title_tr`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`;

ALTER TABLE `rates`
	CHANGE COLUMN `title_ru` `title_ru` VARCHAR(50) NOT NULL AFTER `id`,
	ADD COLUMN `title_fr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(50) NULL DEFAULT NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(50) NULL DEFAULT NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_vn`,
	CHANGE COLUMN `description_ru` `description_ru` TEXT NOT NULL AFTER `title_tr`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`;

ALTER TABLE `promo`
	ADD COLUMN `title_fr` VARCHAR(255) NULL DEFAULT '0' AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(255) NULL DEFAULT '0' AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(255) NULL DEFAULT '0' AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(255) NULL DEFAULT '0' AFTER `title_vn`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`,
	ADD COLUMN `text_fr` TEXT NULL AFTER `text_cn`,
	ADD COLUMN `text_es` TEXT NULL AFTER `text_fr`,
	ADD COLUMN `text_vn` TEXT NULL AFTER `text_es`,
	ADD COLUMN `text_tr` TEXT NULL AFTER `text_vn`,
	ADD COLUMN `meta_desc_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_desc_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_fr`,
	ADD COLUMN `meta_desc_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_es`,
	ADD COLUMN `meta_desc_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_vn`,
	ADD COLUMN `meta_key_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_cn`,
	ADD COLUMN `meta_key_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_fr`,
	ADD COLUMN `meta_key_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_es`,
	ADD COLUMN `meta_key_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_vn`;

ALTER TABLE `information`
	CHANGE COLUMN `title_us` `title_us` VARCHAR(500) NULL AFTER `title_ru`,
	CHANGE COLUMN `title_cn` `title_cn` VARCHAR(500) NULL AFTER `title_us`,
	ADD COLUMN `title_fr` VARCHAR(500) NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(500) NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(500) NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(500) NULL AFTER `title_vn`,
	CHANGE COLUMN `description_us` `description_us` TEXT NULL AFTER `description_ru`,
	CHANGE COLUMN `description_cn` `description_cn` TEXT NULL AFTER `description_us`,
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`,
	CHANGE COLUMN `text_us` `text_us` TEXT NULL AFTER `text_ru`,
	CHANGE COLUMN `text_cn` `text_cn` TEXT NULL AFTER `text_us`,
	ADD COLUMN `text_fr` TEXT NULL AFTER `text_cn`,
	ADD COLUMN `text_es` TEXT NULL AFTER `text_fr`,
	ADD COLUMN `text_vn` TEXT NULL AFTER `text_es`,
	ADD COLUMN `text_tr` TEXT NULL AFTER `text_vn`,
	ADD COLUMN `meta_desc_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_desc_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_fr`,
	ADD COLUMN `meta_desc_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_es`,
	ADD COLUMN `meta_desc_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_vn`,
	ADD COLUMN `meta_key_fr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_cn`,
	ADD COLUMN `meta_key_es` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_fr`,
	ADD COLUMN `meta_key_vn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_es`,
	ADD COLUMN `meta_key_tr` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_vn`;

ALTER TABLE `attraction`
	ADD COLUMN `title_fr` VARCHAR(300) NULL DEFAULT NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(300) NULL DEFAULT NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(300) NULL DEFAULT NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(300) NULL DEFAULT NULL AFTER `title_vn`,
	ADD COLUMN `text_fr` TEXT NULL AFTER `text_cn`,
	ADD COLUMN `text_es` TEXT NULL AFTER `text_fr`,
	ADD COLUMN `text_vn` TEXT NULL AFTER `text_es`,
	ADD COLUMN `text_tr` TEXT NULL AFTER `text_vn`;

ALTER TABLE `menu`
	CHANGE COLUMN `title_us` `title_us` VARCHAR(150) NULL DEFAULT '0' AFTER `title_ru`,
	CHANGE COLUMN `title_cn` `title_cn` VARCHAR(150) NULL DEFAULT '0' AFTER `title_us`,
	ADD COLUMN `title_fr` VARCHAR(150) NULL DEFAULT '0' AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(150) NULL DEFAULT '0' AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(150) NULL DEFAULT '0' AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(150) NULL DEFAULT '0' AFTER `title_vn`;

ALTER TABLE `language`
	ADD COLUMN `currency` VARCHAR(50) NOT NULL AFTER `name`;

ALTER TABLE `rooms2hotels`
	ADD COLUMN `description_fr` TEXT NULL AFTER `description_cn`,
	ADD COLUMN `description_es` TEXT NULL AFTER `description_fr`,
	ADD COLUMN `description_vn` TEXT NULL AFTER `description_es`,
	ADD COLUMN `description_tr` TEXT NULL AFTER `description_vn`;

ALTER TABLE `blocks`
	CHANGE COLUMN `title_ru` `title_ru` VARCHAR(50) NOT NULL AFTER `id`,
	ADD COLUMN `title_fr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_cn`,
	ADD COLUMN `title_es` VARCHAR(50) NULL DEFAULT NULL AFTER `title_fr`,
	ADD COLUMN `title_vn` VARCHAR(50) NULL DEFAULT NULL AFTER `title_es`,
	ADD COLUMN `title_tr` VARCHAR(50) NULL DEFAULT NULL AFTER `title_vn`,
	CHANGE COLUMN `text_ru` `text_ru` TEXT NOT NULL AFTER `title_tr`,
	ADD COLUMN `text_fr` TEXT NULL AFTER `text_cn`,
	ADD COLUMN `text_es` TEXT NULL AFTER `text_fr`,
	ADD COLUMN `text_vn` TEXT NULL AFTER `text_es`,
	ADD COLUMN `text_tr` TEXT NULL AFTER `text_vn`;
