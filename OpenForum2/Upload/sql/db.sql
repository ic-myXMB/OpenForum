SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `forum_categories` (
`category_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`category_title` VARCHAR(150),
`category_description` TEXT,
`category_create_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
`category_owner` VARCHAR (150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `forum_topics` (
`topic_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`category_id` INT NOT NULL,
`topic_title` VARCHAR(150),
`topic_description` TEXT,
`topic_create_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
`topic_owner` VARCHAR (150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `forum_posts` (
`post_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`topic_id` INT NOT NULL,
`category_id` INT NOT NULL,
`post_text` TEXT,
`post_create_time` DATETIME DEFAULT CURRENT_TIMESTAMP,
`post_owner` VARCHAR (150)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;