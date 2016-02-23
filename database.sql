CREATE TABLE IF NOT EXISTS `rave_admin` (
  `admin_login` VARCHAR(200) NOT NULL,
  `admin_password` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`admin_login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rave_admin` (`admin_login`, `admin_password`) VALUES ('admin', '$2y$12$kq/VVk2YTVat8zrqkkoquuclihrmdoNZ3k/LC58uledg5uWU.6ugO');

CREATE TABLE IF NOT EXISTS `rave_photo` (
  `photo_id` INT(11) NOT NULL AUTO_INCREMENT,
  `photo_name` VARCHAR(250) NOT NULL,
  `photo_like` INT(11) NOT NULL DEFAULT 0,
  `photo_title` VARCHAR(250) NOT NULL,
  `photo_visit` INT(11) NOT NULL DEFAULT 0,
  `photo_subtitle` VARCHAR(250) NOT NULL,
  `photo_description` VARCHAR(1000) NOT NULL,
  `photo_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_comment` (
  `photo_id` INT(11) NOT NULL,
  `comment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `comment_ip` VARCHAR(128) NOT NULL,
  `comment_author` VARCHAR(200) NOT NULL,
  `comment_message` VARCHAR(1000) NOT NULL,
  `comment_publication` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`photo_id`) REFERENCES `rave_photo` (`photo_id`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_tag` (
  `tag_id` INT(11) NOT NULL AUTO_INCREMENT,
  `tag_name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_identify`(
  `tag_id` INT(11) NOT NULL,
  `photo_id` INT(11) NOT NULL,
  FOREIGN KEY (`tag_id`) REFERENCES `rave_tag` (`tag_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`photo_id`) REFERENCES `rave_photo` (`photo_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (`tag_id`, `photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_like` (
  `like_ip` VARCHAR(128) NOT NULL,
  `photo_id` INT(11) NOT NULL,
  FOREIGN KEY (`photo_id`) REFERENCES `rave_photo` (`photo_id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (`like_ip`, `photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_contact` (
  `contact_ip` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`contact_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rave_gallery` (
  `photo_id` INT(11) NOT NULL,
  PRIMARY KEY (`photo_id`),
  FOREIGN KEY (`photo_id`) REFERENCES `rave_photo` (`photo_id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;