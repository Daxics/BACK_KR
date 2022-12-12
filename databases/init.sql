CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;
SET NAMES 'utf8';

USE appDB;


-- ---
-- Table 'users'
--
-- ---

CREATE TABLE  IF NOT EXISTS `users` (
	`id_user` INTEGER(40) AUTO_INCREMENT NOT NULL,
	`id_role` INTEGER(3) DEFAULT 2,
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
        `id_author` INTEGER(20),
        `source` VARCHAR(200),
        `disc` VARCHAR(1000),
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
	`count` VARCHAR(20) DEFAULT 0,
	PRIMARY KEY (`id_author`)
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
    `anime` BIT DEFAULT 0,
    `biography` BIT DEFAULT 0,
    `actions` BIT DEFAULT 0,
    `western` BIT DEFAULT 0,
    `military` BIT DEFAULT 0,
    PRIMARY KEY (`id_post`)
);

CREATE TABLE IF NOT EXISTS `tags_list` (
    `tag_title` VARCHAR(100) NOT NULL,
    `count` INTEGER(40) NOT NULL DEFAULT 0,
    PRIMARY KEY (`tag_title`)
);


-- ---
-- Table 'characters'
--
-- ---

CREATE TABLE IF NOT EXISTS `characters` (
    `id_post` INTEGER(40) NOT NULL,
    `Rin` BIT DEFAULT 0,
    `Ishtar` BIT DEFAULT 0,
    `Ereshkigal` BIT DEFAULT 0,
    `Saber` BIT DEFAULT 0,
    `Illya` BIT DEFAULT 0,
    PRIMARY KEY (`id_post`)
);

CREATE TABLE IF NOT EXISTS `characters_list` (
    `character_title` VARCHAR(100) NOT NULL,
    `count` INTEGER(40) NOT NULL DEFAULT 0,
    PRIMARY KEY (`character_title`)
);


-- ---
-- Table 'count_posts'
--
-- ---

CREATE TABLE IF NOT EXISTS `count_posts` (
    `id` INTEGER(1) NOT NULL AUTO_INCREMENT,
    `count` INTEGER(10) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
);



-- ---
-- posts count UPD
-- ---

DELIMITER $$
CREATE TRIGGER authors_count_DEL AFTER DELETE ON `posts`
    FOR EACH ROW BEGIN
    UPDATE `authors` SET count = count - 1 WHERE authors.id_author = OLD.id_author;
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
ALTER TABLE `users` ADD FOREIGN KEY (id_role) REFERENCES `roles` (`id_role`);
ALTER TABLE `posts` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
ALTER TABLE `posts` ADD FOREIGN KEY (id_author) REFERENCES `authors` (`id_author`) ON DELETE SET NULL;
ALTER TABLE `comments` ADD FOREIGN KEY (id_post) REFERENCES `posts` (`id_post`) ON DELETE CASCADE;
ALTER TABLE `comments` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
ALTER TABLE `tags` ADD FOREIGN KEY (id_post) REFERENCES `posts` (id_post) ON DELETE CASCADE;


-- -- ---
-- -- Table Properties
-- -- ---

ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `posts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `comments` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `comments` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `authors` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `characters` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `characters_list` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `roles` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `tags` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `tags_list` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `count_posts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---





INSERT INTO `authors` (`author`) VALUES
    ('Yang Do');
INSERT INTO `roles` (`role`) VALUES
    ('Admin');
INSERT INTO `roles` (`role`) VALUES
    ('RegUser');

INSERT INTO `count_posts` (id) VALUE
    (1);

INSERT INTO `tags_list` (tag_title, count) VALUE
    ('anime', 0);
INSERT INTO `tags_list` (tag_title, count) VALUE
    ('biography', 0);
INSERT INTO `tags_list` (tag_title, count) VALUE
    ('actions', 0);
INSERT INTO `tags_list` (tag_title, count) VALUE
    ('western', 0);
INSERT INTO `tags_list` (tag_title, count) VALUE
    ('military', 0);

INSERT INTO `characters_list` (character_title,count) VALUES
    ('Rin',0);
INSERT INTO `characters_list` (character_title,count) VALUES
    ('Ishtar',0);
INSERT INTO `characters_list` (character_title,count) VALUES
    ('Ereshkigal',0);
INSERT INTO `characters_list` (character_title,count) VALUES
    ('Saber',0);
INSERT INTO `characters_list` (character_title,count) VALUES
    ('Illya',0);

INSERT INTO `users` (`id_role`,`nickName`,`e_mail`,`password`) VALUES
    (1,'User','user@mail.cum','81dc9bdb52d04dc20036dbd8313ed055');


