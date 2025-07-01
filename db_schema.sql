-- user_consent table schema

CREATE TABLE `user_consent` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `guid` CHAR(36) NOT NULL,
  `consent_date` DATETIME NOT NULL,
  `version` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guid_unique` (`guid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
