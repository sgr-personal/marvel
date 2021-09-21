ALTER TABLE `users` ADD `google_id` VARCHAR(255) NULL AFTER `status`;
ALTER TABLE `users` CHANGE `profile` `profile` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;

ALTER TABLE `orders` ADD `address_id` INT(11) NOT NULL AFTER `payment_method`;
