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
	`id_user` INTEGER(40) AUTO_INCREMENT NOT NULL,
	`id_role` INTEGER(3) DEFAULT '1',
	`nickName` VARCHAR(100),
	`e_mail` VARCHAR(255),
	`password` VARCHAR(200),
	`posts_count` INTEGER(40) NOT NULL DEFAULT 0,
	`comments_count` INTEGER(40) NOT NULL DEFAULT 0,
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

CREATE TABLE IF NOT EXISTS `tags` (
    `id_post` INTEGER(40) NOT NULL ,
    `anime` BIT DEFAULT 0 NULL COMMENT 'Аниме',
    `biography` BIT DEFAULT 0 NULL COMMENT 'Биография',
    `actions` BIT DEFAULT 0 NULL COMMENT 'Боевик',
    `western` BIT DEFAULT 0 NULL COMMENT 'Вестерн',
    `military` BIT DEFAULT 0 NULL COMMENT 'Военный жанр',
    PRIMARY KEY (`id_post`)

);

-- ---
-- Table 'character'
--
-- ---

CREATE TABLE IF NOT EXISTS `character` (
    `id_post` INTEGER(40) NOT NULL,
    `rin` BIT DEFAULT 0 NULL COMMENT 'Аниме',
    `saber` BIT DEFAULT 0 NULL COMMENT 'Биография',
    `illya` BIT DEFAULT 0 NULL COMMENT 'Боевик',
    `sacura` BIT DEFAULT 0 NULL COMMENT 'Вестерн',
     PRIMARY KEY (`id_post`)
);


CREATE TABLE IF NOT EXISTS `count_posts` (
    `id` INTEGER(1) NOT NULL AUTO_INCREMENT,
    `count` INTEGER(10) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);


-- ---
-- posts_count count UPD
-- ---
DELIMITER $$
CREATE TRIGGER posts_count_UPD AFTER INSERT ON `posts`
    FOR EACH ROW BEGIN
    UPDATE `count_posts` SET count = count + 1 WHERE count_posts.id = 1;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER posts_count_DEL AFTER DELETE ON `posts`
    FOR EACH ROW BEGIN
    UPDATE `count_posts` SET count = count - 1 WHERE count_posts.id = 1;
END $$
DELIMITER ;


-- ---
-- users posts_count upd
-- ---
DELIMITER $$
CREATE TRIGGER user_posts_UPD AFTER INSERT ON `posts`
    FOR EACH ROW BEGIN
    UPDATE `users` SET posts_count = posts_count + 1 WHERE users.id_user = NEW.id_user;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER user_posts_DEL AFTER DELETE ON `posts`
    FOR EACH ROW BEGIN
    UPDATE `users` SET posts_count = posts_count - 1 WHERE users.id_user = OLD.id_user;
END $$
DELIMITER ;


-- ---
-- users comments_count upd
-- ---

DELIMITER $$
CREATE TRIGGER user_comments_UPD AFTER INSERT ON `comments`
    FOR EACH ROW BEGIN
    UPDATE `users` SET comments_count = comments_count + 1 WHERE users.id_user = NEW.id_user;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER user_comments_DEL AFTER DELETE ON `comments`
    FOR EACH ROW BEGIN
    UPDATE `users` SET comments_count = comments_count - 1 WHERE users.id_user = OLD.id_user;
END $$
DELIMITER ;


-- ---
-- Foreign Keys
-- ---
ALTER TABLE `tags` ADD FOREIGN KEY (id_post) REFERENCES `posts` (id_post) ON DELETE CASCADE;
ALTER TABLE `character` ADD FOREIGN KEY (id_post) REFERENCES `posts` (id_post) ON DELETE CASCADE;
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
INSERT INTO `roles` (`id_role`,`role`) VALUES
    (NULL,'RegUser');
INSERT INTO `count_posts` (id) VALUE
    (1);


INSERT INTO `users` (`id_user`,`id_role`,`nickName`,`e_mail`,`password`) VALUES
    (NULL,1,'User','user@mail.cum','81dc9bdb52d04dc20036dbd8313ed055');
INSERT INTO `posts` (`id_post`,`id_user`,`source`,`disc`,`img_name`,`img`) VALUES
(NULL,1,NULL,'sex instructor',NULL,NULL);


INSERT INTO `tags` (id_post, anime, biography, actions, western, military) VALUES
    (1,1,0,0,1,0);
INSERT INTO `character` (id_post, rin, saber, illya, sacura) VALUES
    (1,1,1,0,0);

INSERT INTO `comments` (`id_comment`,`id_post`,`id_user`,`text`) VALUES
    (NULL,1,1,'Yasosu bibu');



INSERT INTO `post_authors` (`id_post`,`id_author`) VALUES
    (1,1);
