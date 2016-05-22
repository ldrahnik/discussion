DROP TABLE IF EXISTS `comments`;
CREATE TABLE comments (
	dbId bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  author varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  text text COLLATE utf8mb4_unicode_ci NOT NULL,
  created datetime NOT NULL,
	PRIMARY KEY(dbId))
   DEFAULT CHARACTER SET utf8
   COLLATE utf8_unicode_ci
   ENGINE = InnoDB;
