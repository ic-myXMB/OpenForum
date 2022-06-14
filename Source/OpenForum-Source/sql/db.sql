CREATE TABLE IF NOT EXISTS `forum_topics` (
`topic_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`topic_title` VARCHAR(150),
`topic_description` TEXT,
`topic_create_time` DATETIME,
`topic_owner` VARCHAR (150)
);

CREATE TABLE IF NOT EXISTS `forum_posts` (
`post_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`topic_id` INT NOT NULL,
`post_text` TEXT,
`post_create_time` DATETIME,
`post_owner` VARCHAR (150)
);