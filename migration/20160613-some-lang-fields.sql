ALTER TABLE `hotel`
	CHANGE COLUMN `meta_desc` `meta_desc_ru` VARCHAR(500) NULL DEFAULT NULL AFTER `online_link`,
	ADD COLUMN `meta_desc_us` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_ru`,
	ADD COLUMN `meta_desc_cn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_us`,
	CHANGE COLUMN `meta_key` `meta_key_ru` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_key_us` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_ru`,
	ADD COLUMN `meta_key_cn` VARCHAR(500) NULL DEFAULT NULL AFTER `meta_key_us`;

ALTER TABLE `promo`
	ADD COLUMN `meta_desc_ru` VARCHAR(500) NULL AFTER `orderBy`,
	ADD COLUMN `meta_desc_us` VARCHAR(500) NULL AFTER `meta_desc_ru`,
	ADD COLUMN `meta_desc_cn` VARCHAR(500) NULL AFTER `meta_desc_us`,
	ADD COLUMN `meta_key_ru` VARCHAR(500) NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_key_us` VARCHAR(500) NULL AFTER `meta_key_ru`,
	ADD COLUMN `meta_key_cn` VARCHAR(500) NULL AFTER `meta_key_us`;

ALTER TABLE `information`
	ADD COLUMN `meta_desc_ru` VARCHAR(500) NULL AFTER `logo`,
	ADD COLUMN `meta_desc_us` VARCHAR(500) NULL AFTER `meta_desc_ru`,
	ADD COLUMN `meta_desc_cn` VARCHAR(500) NULL AFTER `meta_desc_us`,
	ADD COLUMN `meta_key_ru` VARCHAR(500) NULL AFTER `meta_desc_cn`,
	ADD COLUMN `meta_key_us` VARCHAR(500) NULL AFTER `meta_key_ru`,
	ADD COLUMN `meta_key_cn` VARCHAR(500) NULL AFTER `meta_key_us`;
