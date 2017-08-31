DROP TABLE IF EXISTS `#__donation`;

CREATE TABLE `#__donation` (
 `id`        INT(11) NOT NULL  AUTO_INCREMENT,
 `first_name` VARCHAR(25) NOT NULL ,
 `last_name`  VARCHAR(25) NOT NULL ,
 `email`      VARCHAR(25) NOT NULL ,
 `amount`     INT(10) NOT NULL ,
 `period`     VARCHAR(25) NOT NULL,
 `tracking_id` VARCHAR(100),
 `method`     VARCHAR (100),
 `status`     VARCHAR (100),
 `reference`  VARCHAR (100),
 PRIMARY KEY (`id`)
)

 ENGINE =MyISAM
 AUTO_INCREMENT = 0
 DEFAULT CHARSET =utf8;