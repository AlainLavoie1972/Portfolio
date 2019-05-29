CREATE DATABASE everify;

GRANT ALL PRIVILEGES ON `everify`.* TO 'al'@'localhost' IDENTIFIED BY 'Crowley!72';
GRANT ALL PRIVILEGES ON `everify`.* TO 'al'@'127.0.0.1' IDENTIFIED BY 'Crowley!72';

USE everify;

CREATE TABLE `users` (
	`user_id` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	`username` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password`varchar(255) DEFAULT NULL,
	`hash` varchar(32) NOT NULL,
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` datetime default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
);