CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;
set names 'utf8';

USE appDB;


-- ---
-- Table 'users'
--
-- ---

CREATE TABLE  IF NOT EXISTS `users` (
	`id_user` INTEGER(10) AUTO_INCREMENT NOT NULL,
	`id_role` INTEGER(3) DEFAULT '1',
	`nickName` VARCHAR(100),
	`e_mail` VARCHAR(255),
	`password` VARCHAR(200),
    `dateTime` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_user`)
);


-- ---
-- Table 'posts'
--
-- ---

CREATE TABLE IF NOT EXISTS `posts` (
	`id_post` INTEGER(20) AUTO_INCREMENT NOT NULL,
	`id_user` INTEGER(20),
	`source` VARCHAR(200),
	`disc` VARCHAR(200),
    `img_name` VARCHAR(20),
    `img` VARCHAR(200),
    `dateTime` DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id_post`)
);

-- ---
-- Table 'comments'
--
-- ---

CREATE TABLE IF NOT EXISTS `comments` (
	`id_comment` INTEGER(40) AUTO_INCREMENT NOT NULL,
	`id_post` INTEGER(20),
	`id_user` INTEGER(20),
	`text` VARCHAR(200),
	`dateTime` DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id_comment`)
);

-- ---
-- Table 'author'
--
-- ---

CREATE TABLE IF NOT EXISTS `authors` (
	`id_author` INTEGER(20) AUTO_INCREMENT NOT NULL,
	`author` VARCHAR(20),
	PRIMARY KEY (`id_author`)
);

-- ---
-- Table 'post_author'
--
-- ---

CREATE TABLE IF NOT EXISTS `post_authors` (
	`id_post` INTEGER(20) NOT NULL,
	`id_author` INTEGER(20) NOT NULL
);

-- ---
-- Table 'role'
--
-- ---

CREATE TABLE IF NOT EXISTS `roles` (
	`id_role` INTEGER(20) AUTO_INCREMENT NOT NULL,
	`role` VARCHAR(10),
	PRIMARY KEY (`id_role`)
);

-- ---
-- Table 'tags'
--
-- ---

CREATE TABLE IF NOT EXISTS tags (
    `post_id` BIGINT UNSIGNED NOT NULL UNIQUE,
    FOREIGN KEY (post_id) REFERENCES posts(id_post),
    `anime` BIT DEFAULT 0 NULL COMMENT 'Аниме',
    `biography` BIT DEFAULT 0 NULL COMMENT 'Биография',
    `actions` BIT DEFAULT 0 NULL COMMENT 'Боевик',
    `western` BIT DEFAULT 0 NULL COMMENT 'Вестерн',
    `military` BIT DEFAULT 0 NULL COMMENT 'Военный жанр'
);

-- ---
-- Table 'tags'
--
-- ---

CREATE TABLE IF NOT EXISTS authors (
    `post_id` BIGINT UNSIGNED NOT NULL UNIQUE,
    FOREIGN KEY (post_id) REFERENCES posts(id_post),
    `anime` BIT DEFAULT 0 NULL COMMENT 'Аниме',
    `biography` BIT DEFAULT 0 NULL COMMENT 'Биография',
    `actions` BIT DEFAULT 0 NULL COMMENT 'Боевик',
    `western` BIT DEFAULT 0 NULL COMMENT 'Вестерн',
    `military` BIT DEFAULT 0 NULL COMMENT 'Военный жанр'
);

CREATE TABLE IF NOT EXISTS character (
    `post_id` BIGINT UNSIGNED NOT NULL UNIQUE,
    FOREIGN KEY (post_id) REFERENCES posts(id_post),
    `anime` BIT DEFAULT 0 NULL COMMENT 'Аниме',
    `biography` BIT DEFAULT 0 NULL COMMENT 'Биография',
    `actions` BIT DEFAULT 0 NULL COMMENT 'Боевик',
    `western` BIT DEFAULT 0 NULL COMMENT 'Вестерн',
    `military` BIT DEFAULT 0 NULL COMMENT 'Военный жанр'
);

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `users` ADD FOREIGN KEY (id_role) REFERENCES `roles` (`id_role`);
ALTER TABLE `posts` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
ALTER TABLE `comments` ADD FOREIGN KEY (id_post) REFERENCES `posts` (`id_post`) ON DELETE CASCADE;
ALTER TABLE `comments` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id_user`);
ALTER TABLE `post_authors` ADD FOREIGN KEY (id_post) REFERENCES `posts` (`id_post`) ON DELETE CASCADE;
ALTER TABLE `post_authors` ADD FOREIGN KEY (id_author) REFERENCES `authors` (`id_author`) ON DELETE CASCADE;

-- -- ---
-- -- Table Properties
-- -- ---

-- ALTER TABLE `tags` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `user` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `post` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `comments` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `author` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `post_tags` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `post_author` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `role` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---





INSERT INTO `authors` (`id_author`,`author`) VALUES
    (NULL,'Yang Do');
INSERT INTO cherecter (`id_tag`,`regularTag`) VALUES
    (NULL,'Пейзаж');
INSERT INTO `roles` (`id_role`,`role`) VALUES
    (NULL,'RegUser');


INSERT INTO `users` (`id_user`,`id_role`,`nickName`,`e_mail`,`password`) VALUES
    (NULL,1,'User','user@mail.cum','81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `posts` (`id_post`,`id_user`,`source`,`disc`,`img_name`,`img`) VALUES
    (NULL,1,NULL,'sex instructor',NULL,NULL);


INSERT INTO `comments` (`id_comment`,`id_post`,`id_user`,`text`) VALUES
    (NULL,1,1,'Yasosu bibu');

INSERT INTO `post_tags` (`id_post`,`id_tag`) VALUES
    (1,1);
INSERT INTO `post_authors` (`id_post`,`id_author`) VALUES
    (1,1);
